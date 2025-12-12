<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;
use App\Models\BarberSchedule;
use App\Models\Booking;
use App\Models\Service;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking.index');
    }

    public function getAvailableBarbers(Request $request)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today'
        ]);

        $date = $request->date;
        $barbers = Barber::getAvailableForDate($date);

        return response()->json([
            'success' => true,
            'date' => $date,
            'day_name' => Carbon::parse($date)->locale('id')->dayName,
            'barbers' => $barbers->map(function($barber) use ($date) {
                $dayOfWeek = strtolower(Carbon::parse($date)->format('l'));
                $schedule = $barber->schedules()->where('day_of_week', $dayOfWeek)->first();
                
                return [
                    'id' => $barber->id,
                    'name' => $barber->name,
                    'level' => $barber->level_display,
                    'photo' => $barber->photo ? asset('storage/' . $barber->photo) : null,
                    'rating' => $barber->formatted_rating,
                    'specialty' => $barber->specialty,
                    'schedule' => $schedule ? $schedule->formatted_time : null,
                ];
            })
        ]);
    }

    public function getTimeSlots(Request $request)
    {
        $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'date' => 'required|date|after_or_equal:today'
        ]);

        $timeSlots = Booking::getAvailableTimeSlots($request->barber_id, $request->date);

        return response()->json([
            'success' => true,
            'time_slots' => $timeSlots
        ]);
    }

    public function getServices()
    {
        $services = Service::where('is_active', true)->orderBy('price')->get();

        return response()->json([
            'success' => true,
            'services' => $services->map(function($service) {
                return [
                    'id' => $service->id,
                    'name' => $service->name,
                    'price' => $service->price,
                    'duration' => $service->duration,
                    'formatted_price' => 'Rp ' . number_format($service->price, 0, ',', '.')
                ];
            })
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'barber_id' => 'required|exists:barbers,id',
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required|date_format:H:i',
            'notes' => 'nullable|string|max:500'
        ]);

        try {
            // Check if the time slot is still available
            $existingBooking = Booking::where('barber_id', $request->barber_id)
                ->where('booking_date', $request->booking_date)
                ->where('booking_time', $request->booking_time)
                ->whereIn('status', ['pending', 'confirmed'])
                ->first();

            if ($existingBooking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Maaf, waktu tersebut sudah dibooking. Silakan pilih waktu lain.'
                ], 422);
            }

            // Get service price
            $service = Service::findOrFail($request->service_id);

            // Create booking with authenticated user data
            $booking = Booking::create([
                'customer_name' => $request->customer_name ?: auth()->user()->name,
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email ?: auth()->user()->email,
                'barber_id' => $request->barber_id,
                'service_id' => $request->service_id,
                'booking_date' => $request->booking_date,
                'booking_time' => $request->booking_time,
                'notes' => $request->notes,
                'total_price' => $service->price,
                'status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Booking berhasil dibuat! Kami akan menghubungi Anda untuk konfirmasi.',
                'booking_id' => $booking->id,
                'redirect_url' => route('booking.confirmation', ['booking_id' => $booking->id]),
                'booking' => [
                    'id' => $booking->id,
                    'customer_name' => $booking->customer_name,
                    'barber_name' => $booking->barber->name,
                    'service_name' => $booking->service->name,
                    'date' => $booking->formatted_date,
                    'time' => $booking->formatted_time,
                    'total_price' => $booking->total_price,
                    'status' => $booking->status_display
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat booking. Silakan coba lagi.'
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $booking = Booking::with(['barber', 'service'])->findOrFail($id);

            return response()->json([
                'success' => true,
                'booking' => [
                    'id' => $booking->id,
                    'customer_name' => $booking->customer_name,
                    'customer_phone' => $booking->customer_phone,
                    'customer_email' => $booking->customer_email,
                    'barber' => [
                        'name' => $booking->barber->name,
                        'level' => $booking->barber->level_display,
                        'photo' => $booking->barber->photo ? asset('storage/' . $booking->barber->photo) : null
                    ],
                    'service' => [
                        'name' => $booking->service->name,
                        'duration' => $booking->service->duration
                    ],
                    'date' => $booking->formatted_date,
                    'time' => $booking->formatted_time,
                    'total_price' => $booking->total_price,
                    'status' => $booking->status_display,
                    'status_color' => $booking->status_color,
                    'notes' => $booking->notes
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Booking tidak ditemukan.'
            ], 404);
        }
    }

    public function checkAvailability(Request $request)
    {
        $request->validate([
            'barber_id' => 'required|exists:barbers,id',
            'date' => 'required|date|after_or_equal:today'
        ]);

        $barber = Barber::findOrFail($request->barber_id);
        $isAvailable = $barber->isAvailableOnDate($request->date);

        return response()->json([
            'success' => true,
            'available' => $isAvailable,
            'barber' => $barber->name,
            'date' => $request->date
        ]);
    }

    public function checkStatus(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|string',
            'booking_id' => 'nullable|integer'
        ]);

        $query = Booking::with(['barber', 'service']);

        // Filter by authenticated user's email
        $query->where('customer_email', auth()->user()->email);

        if ($request->booking_id) {
            $query->where('id', $request->booking_id);
        }

        if ($request->phone) {
            $query->where('customer_phone', $request->phone);
        }

        $bookings = $query->orderBy('booking_date', 'desc')
            ->orderBy('booking_time', 'desc')
            ->limit(10)
            ->get();

        if ($bookings->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ditemukan booking untuk akun Anda.'
            ]);
        }

        return response()->json([
            'success' => true,
            'bookings' => $bookings->map(function($booking) {
                return [
                    'id' => $booking->id,
                    'customer_name' => $booking->customer_name,
                    'barber_name' => $booking->barber->name,
                    'service_name' => $booking->service->name,
                    'date' => $booking->formatted_date,
                    'time' => $booking->formatted_time,
                    'total_price' => $booking->total_price,
                    'status' => $booking->status_display,
                    'status_color' => $booking->status_color,
                    'notes' => $booking->notes
                ];
            })
        ]);
    }
}
