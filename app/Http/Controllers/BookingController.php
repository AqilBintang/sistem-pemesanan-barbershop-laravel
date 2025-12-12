<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barber;
use App\Models\BarberSchedule;
use App\Models\Booking;
use App\Models\Service;
use App\Services\QRISService;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        // Check if this is test booking route
        if (request()->is('test-booking')) {
            return view('test-booking');
        }
        
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
            'payment_method' => 'required|in:cash,qris',
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

            // Handle QRIS payment
            $paymentReference = null;
            $paymentDate = null;
            $status = 'pending';
            $paymentStatus = 'pending';

            if ($request->payment_method === 'qris') {
                // Generate QRIS payment
                $qrisPayment = QRISService::generatePaymentCode(
                    $service->price, 
                    time(),
                    $request->customer_name
                );
                $paymentReference = $qrisPayment['payment_reference'];
                
                // For GoPay dynamic QRIS, keep as pending until webhook confirms payment
                // For static QRIS, mark as paid immediately for demo
                if (config('app.qris_type') === 'gopay') {
                    $status = 'pending';
                    $paymentStatus = 'pending';
                    $paymentDate = null;
                } else {
                    // Demo mode - mark as paid immediately
                    $status = 'confirmed';
                    $paymentStatus = 'paid';
                    $paymentDate = now();
                }
            }

            // Create booking (handle both authenticated and test users)
            $booking = Booking::create([
                'customer_name' => $request->customer_name ?: (auth()->check() ? auth()->user()->name : 'Test User'),
                'customer_phone' => $request->customer_phone,
                'customer_email' => $request->customer_email ?: (auth()->check() ? auth()->user()->email : 'test@gmail.com'),
                'barber_id' => $request->barber_id,
                'service_id' => $request->service_id,
                'booking_date' => $request->booking_date,
                'booking_time' => $request->booking_time,
                'notes' => $request->notes,
                'total_price' => $service->price,
                'payment_method' => $request->payment_method,
                'payment_status' => $paymentStatus,
                'payment_reference' => $paymentReference,
                'payment_date' => $paymentDate,
                'status' => $status
            ]);

            $message = $request->payment_method === 'qris' 
                ? 'Pembayaran berhasil! Booking Anda telah dikonfirmasi.' 
                : 'Booking berhasil dibuat! Kami akan menghubungi Anda untuk konfirmasi.';

            return response()->json([
                'success' => true,
                'message' => $message,
                'booking_id' => $booking->id,
                'booking' => [
                    'id' => $booking->id,
                    'customer_name' => $booking->customer_name,
                    'customer_phone' => $booking->customer_phone,
                    'customer_email' => $booking->customer_email,
                    'barber_name' => $booking->barber->name,
                    'service_name' => $booking->service->name,
                    'date' => $booking->formatted_date,
                    'time' => $booking->formatted_time,
                    'total_price' => $booking->total_price,
                    'payment_method' => $booking->payment_method_display,
                    'payment_status' => $booking->payment_status_display,
                    'payment_reference' => $booking->payment_reference,
                    'status' => $booking->status_display,
                    'notes' => $booking->notes,
                    'booking_date' => $booking->booking_date,
                    'booking_time' => $booking->booking_time,
                    'service' => [
                        'name' => $booking->service->name,
                        'duration' => $booking->service->duration,
                        'price' => $booking->service->price
                    ],
                    'barber' => [
                        'name' => $booking->barber->name,
                        'level' => $booking->barber->level_display
                    ]
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

    public function generateQRIS(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'booking_id' => 'required|string',
            'customer_name' => 'nullable|string'
        ]);

        try {
            $qrisPayment = QRISService::generatePaymentCode(
                $request->amount, 
                $request->booking_id,
                $request->customer_name
            );
            
            $qrImageUrl = QRISService::getQRCodeImageUrl(
                $qrisPayment['qr_code'],
                $qrisPayment['qr_code_url'] ?? null
            );

            return response()->json([
                'success' => true,
                'qr_code_url' => $qrImageUrl,
                'payment_reference' => $qrisPayment['payment_reference'],
                'amount' => $qrisPayment['amount'],
                'expires_at' => $qrisPayment['expires_at']->format('Y-m-d H:i:s'),
                'type' => $qrisPayment['type'] ?? 'static'
            ]);

        } catch (\Exception $e) {
            Log::error('QRIS Generation Error', [
                'message' => $e->getMessage(),
                'request' => $request->all()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Gagal generate QRIS code. Silakan coba lagi.'
            ], 500);
        }
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
