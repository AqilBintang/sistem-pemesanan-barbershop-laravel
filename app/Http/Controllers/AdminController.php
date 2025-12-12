<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Service;
use App\Models\Barber;
use App\Models\BarberSchedule;
use App\Models\Booking;

class AdminController extends Controller
{
    public function showLogin()
    {
        // Redirect to dashboard if already logged in
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // Redirect to dashboard if already logged in
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Simple hardcoded admin credentials for demo
        if ($request->username === 'admin' && $request->password === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang di Admin Panel!');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput($request->only('username'));
    }

    public function dashboard()
    {
        $stats = [
            'total_services' => Service::count(),
            'total_barbers' => Barber::count(),
            'active_services' => Service::active()->count(),
            'active_barbers' => Barber::active()->count(),
            'total_bookings' => Booking::count(),
            'pending_bookings' => Booking::where('status', 'pending')->count(),
            'today_bookings' => Booking::whereDate('booking_date', today())->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }

    public function services()
    {
        $services = Service::orderBy('created_at', 'desc')->get();

        return view('admin.services', compact('services'));
    }

    public function barbers()
    {
        $barbers = Barber::with('schedules')->orderBy('created_at', 'desc')->get();

        return view('admin.barbers', compact('barbers'));
    }

    public function storeService(Request $request)
    {
        try {
            // Debug: Log request data
            \Log::info('Store Service Request:', [
                'has_file' => $request->hasFile('image'),
                'all_data' => $request->all(),
                'files' => $request->allFiles()
            ]);

            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'duration' => 'required|integer|min:1',
                'type' => 'required|in:ekonomis,populer,premium,paket',
                'features' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $features = null;
            if ($request->features) {
                $features = array_map('trim', explode(',', $request->features));
            }

            $imagePath = null;
            if ($request->hasFile('image')) {
                // Create services directory if it doesn't exist
                if (!Storage::disk('public')->exists('services')) {
                    Storage::disk('public')->makeDirectory('services');
                }
                
                $file = $request->file('image');
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $imagePath = $file->storeAs('services', $filename, 'public');
                
                \Log::info('Image uploaded:', ['path' => $imagePath, 'filename' => $filename]);
            } else {
                \Log::info('No image file uploaded');
            }

            $service = Service::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'duration' => $request->duration,
                'type' => $request->type,
                'features' => $features,
                'image' => $imagePath,
                'is_active' => true,
            ]);

            \Log::info('Service created:', ['id' => $service->id, 'image' => $service->image]);

            return redirect()->route('admin.services')->with('success', 'Layanan berhasil ditambahkan!');
        } catch (\Exception $e) {
            \Log::error('Store Service Error:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan layanan: ' . $e->getMessage()])->withInput();
        }
    }

    public function editService($id)
    {
        $service = Service::findOrFail($id);
        $services = Service::orderBy('created_at', 'desc')->get();

        return view('admin.services', compact('services', 'service'));
    }

    public function updateService(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'duration' => 'required|integer|min:1',
                'type' => 'required|in:ekonomis,populer,premium,paket',
                'features' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $service = Service::findOrFail($id);

            $features = null;
            if ($request->features) {
                $features = array_map('trim', explode(',', $request->features));
            }

            $imagePath = $service->image;
            if ($request->hasFile('image')) {
                // Create services directory if it doesn't exist
                if (!\Storage::disk('public')->exists('services')) {
                    \Storage::disk('public')->makeDirectory('services');
                }
                
                // Delete old image if exists
                if ($service->image && \Storage::disk('public')->exists($service->image)) {
                    \Storage::disk('public')->delete($service->image);
                }
                
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $imagePath = $file->storeAs('services', $filename, 'public');
            }

            $service->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'duration' => $request->duration,
                'type' => $request->type,
                'features' => $features,
                'image' => $imagePath,
            ]);

            return redirect()->route('admin.services')->with('success', 'Layanan berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui layanan: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroyService($id)
    {
        try {
            $service = Service::findOrFail($id);
            
            // Delete image if exists
            if ($service->image && \Storage::disk('public')->exists($service->image)) {
                \Storage::disk('public')->delete($service->image);
            }

            $service->delete();

            return redirect()->route('admin.services')->with('success', 'Layanan berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus layanan: ' . $e->getMessage()]);
        }
    }

    public function storeBarber(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'experience' => 'required|string|max:255',
                'specialty' => 'required|string|max:255',
                'bio' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'rating' => 'nullable|numeric|min:0|max:5',
                'level' => 'required|in:junior,professional,senior,master,specialist,creative',
                'schedule' => 'nullable|string',
                'skills' => 'nullable|string',
                'schedules' => 'nullable|array',
                'schedules.*.day' => 'required_with:schedules|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
                'schedules.*.start_time' => 'required_with:schedules|date_format:H:i',
                'schedules.*.end_time' => 'required_with:schedules|date_format:H:i|after:schedules.*.start_time',
            ]);

            $photoPath = null;
            if ($request->hasFile('photo')) {
                // Create barbers directory if it doesn't exist
                if (!Storage::disk('public')->exists('barbers')) {
                    Storage::disk('public')->makeDirectory('barbers');
                }
                
                $file = $request->file('photo');
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $photoPath = $file->storeAs('barbers', $filename, 'public');
            }

            $skills = null;
            if ($request->skills) {
                $skills = array_map('trim', explode(',', $request->skills));
            }

            $barber = Barber::create([
                'name' => $request->name,
                'experience' => $request->experience,
                'specialty' => $request->specialty,
                'bio' => $request->bio,
                'photo' => $photoPath,
                'rating' => $request->rating ?? 5.0,
                'level' => $request->level,
                'schedule' => $request->schedule,
                'skills' => $skills,
                'is_active' => true,
            ]);

            // Create schedules if provided
            if ($request->schedules) {
                foreach ($request->schedules as $scheduleData) {
                    if (!empty($scheduleData['day']) && !empty($scheduleData['start_time']) && !empty($scheduleData['end_time'])) {
                        BarberSchedule::create([
                            'barber_id' => $barber->id,
                            'day_of_week' => $scheduleData['day'],
                            'start_time' => $scheduleData['start_time'],
                            'end_time' => $scheduleData['end_time'],
                            'is_available' => true,
                        ]);
                    }
                }
            }

            return redirect()->route('admin.barbers')->with('success', 'Kapster berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menambahkan kapster: ' . $e->getMessage()])->withInput();
        }
    }

    public function editBarber($id)
    {
        $barber = Barber::with('schedules')->findOrFail($id);
        $barbers = Barber::with('schedules')->orderBy('created_at', 'desc')->get();

        return view('admin.barbers', compact('barbers', 'barber'));
    }

    public function updateBarber(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'experience' => 'required|string|max:255',
                'specialty' => 'required|string|max:255',
                'bio' => 'nullable|string',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'rating' => 'nullable|numeric|min:0|max:5',
                'level' => 'required|in:junior,professional,senior,master,specialist,creative',
                'schedule' => 'nullable|string',
                'skills' => 'nullable|string',
                'schedules' => 'nullable|array',
                'schedules.*.day' => 'required_with:schedules|in:monday,tuesday,wednesday,thursday,friday,saturday,sunday',
                'schedules.*.start_time' => 'required_with:schedules|date_format:H:i',
                'schedules.*.end_time' => 'required_with:schedules|date_format:H:i|after:schedules.*.start_time',
            ]);

            $barber = Barber::findOrFail($id);

            $photoPath = $barber->photo;
            if ($request->hasFile('photo')) {
                // Create barbers directory if it doesn't exist
                if (!Storage::disk('public')->exists('barbers')) {
                    Storage::disk('public')->makeDirectory('barbers');
                }
                
                // Delete old photo if exists
                if ($barber->photo && Storage::disk('public')->exists($barber->photo)) {
                    Storage::disk('public')->delete($barber->photo);
                }
                
                $file = $request->file('photo');
                $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $photoPath = $file->storeAs('barbers', $filename, 'public');
            }

            $skills = null;
            if ($request->skills) {
                $skills = array_map('trim', explode(',', $request->skills));
            }

            $barber->update([
                'name' => $request->name,
                'experience' => $request->experience,
                'specialty' => $request->specialty,
                'bio' => $request->bio,
                'photo' => $photoPath,
                'rating' => $request->rating ?? $barber->rating,
                'level' => $request->level,
                'schedule' => $request->schedule,
                'skills' => $skills,
            ]);

            // Update schedules
            if ($request->schedules) {
                // Delete existing schedules
                $barber->schedules()->delete();
                
                // Create new schedules
                foreach ($request->schedules as $scheduleData) {
                    if (!empty($scheduleData['day']) && !empty($scheduleData['start_time']) && !empty($scheduleData['end_time'])) {
                        BarberSchedule::create([
                            'barber_id' => $barber->id,
                            'day_of_week' => $scheduleData['day'],
                            'start_time' => $scheduleData['start_time'],
                            'end_time' => $scheduleData['end_time'],
                            'is_available' => true,
                        ]);
                    }
                }
            }

            return redirect()->route('admin.barbers')->with('success', 'Kapster berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal memperbarui kapster: ' . $e->getMessage()])->withInput();
        }
    }

    public function destroyBarber($id)
    {
        try {
            $barber = Barber::findOrFail($id);
            
            // Delete photo if exists
            if ($barber->photo && Storage::disk('public')->exists($barber->photo)) {
                Storage::disk('public')->delete($barber->photo);
            }

            $barber->delete();

            return redirect()->route('admin.barbers')->with('success', 'Kapster berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Gagal menghapus kapster: ' . $e->getMessage()]);
        }
    }

    // Booking Management
    public function bookings()
    {
        $bookings = Booking::with(['barber', 'service'])
            ->orderBy('booking_date', 'desc')
            ->orderBy('booking_time', 'desc')
            ->paginate(20);
        
        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
            'cancelled' => Booking::where('status', 'cancelled')->count(),
            'today' => Booking::whereDate('booking_date', today())->count(),
        ];

        return view('admin.bookings', compact('bookings', 'stats'));
    }

    public function updateBookingStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $booking = Booking::findOrFail($id);
        $booking->status = $request->status;
        $booking->save();

        return response()->json([
            'success' => true,
            'message' => 'Status booking berhasil diupdate',
            'status' => $booking->status_display
        ]);
    }

    public function deleteBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return response()->json([
            'success' => true,
            'message' => 'Booking berhasil dihapus'
        ]);
    }
}