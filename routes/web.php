<?php

use Illuminate\Support\Facades\Route;

// Main route - New Figma Design
Route::get('/', function () {
    return view('barbershop.index');
});

// Original routes (backup)
Route::get('/old-dashboard', function () {
    return view('users.dashboard');
});

Route::get('/layanan', function () {
    return view('users.layanan');
});

// Route::get('/booking', function () {
//     return view('users.booking');
// }); // Commented out - conflicts with new booking system

Route::get('/history', function () {
    return view('users.history');
});

Route::get('/profile', function () {
    return view('users.profile');
});

// New Barbershop SPA routes
Route::get('/barbershop', function () {
    return view('barbershop.index');
});

Route::get('/services', [App\Http\Controllers\ServiceController::class, 'index'])->name('services');
Route::get('/api/services', [App\Http\Controllers\ServiceController::class, 'getServices']);

// Test route untuk melihat data services
Route::get('/test-services', function() {
    $services = App\Models\Service::all();
    return response()->json($services);
});



Route::get('/barbers', function () {
    $barbers = App\Models\Barber::with('schedules')->active()->orderBy('level', 'desc')->orderBy('rating', 'desc')->get();
    return view('barbershop.barbers', compact('barbers'));
})->name('barbers');

Route::get('/confirmation', function () {
    return view('barbershop.index');
});

Route::get('/notifications', function () {
    return view('barbershop.index');
});

// Admin routes
Route::prefix('admin')->group(function () {
    // Public routes (no middleware)
    Route::get('/', [App\Http\Controllers\AdminController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.post');
    
    // Protected routes (require admin middleware)
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/services', [App\Http\Controllers\AdminController::class, 'services'])->name('admin.services');
        Route::post('/services', [App\Http\Controllers\AdminController::class, 'storeService'])->name('admin.services.store');
        Route::get('/services/{id}/edit', [App\Http\Controllers\AdminController::class, 'editService'])->name('admin.services.edit');
        Route::put('/services/{id}', [App\Http\Controllers\AdminController::class, 'updateService'])->name('admin.services.update');
        Route::delete('/services/{id}', [App\Http\Controllers\AdminController::class, 'destroyService'])->name('admin.services.destroy');
        Route::get('/barbers', [App\Http\Controllers\AdminController::class, 'barbers'])->name('admin.barbers');
        Route::post('/barbers', [App\Http\Controllers\AdminController::class, 'storeBarber'])->name('admin.barbers.store');
        Route::get('/barbers/{id}/edit', [App\Http\Controllers\AdminController::class, 'editBarber'])->name('admin.barbers.edit');
        Route::put('/barbers/{id}', [App\Http\Controllers\AdminController::class, 'updateBarber'])->name('admin.barbers.update');
        Route::delete('/barbers/{id}', [App\Http\Controllers\AdminController::class, 'destroyBarber'])->name('admin.barbers.destroy');
        Route::get('/bookings', [App\Http\Controllers\AdminController::class, 'bookings'])->name('admin.bookings');
        Route::get('/bookings/{id}/receipt', function($id) {
            $booking = App\Models\Booking::with(['barber', 'service'])->findOrFail($id);
            return view('booking.receipt', compact('booking'));
        })->name('admin.bookings.receipt');
        Route::put('/bookings/{id}/status', [App\Http\Controllers\AdminController::class, 'updateBookingStatus'])->name('admin.bookings.status');
        Route::delete('/bookings/{id}', [App\Http\Controllers\AdminController::class, 'deleteBooking'])->name('admin.bookings.destroy');
        Route::post('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    });
});

Route::get('/gallery', function () {
    return view('barbershop.index');
});

// Authentication routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::get('/auth/google', [App\Http\Controllers\AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [App\Http\Controllers\AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Test login routes (remove in production)
Route::get('/test-login', [App\Http\Controllers\AuthController::class, 'showTestLogin'])->name('auth.test-login');
Route::post('/test-login', [App\Http\Controllers\AuthController::class, 'testLogin'])->name('auth.test-login');

// Booking routes (protected by authentication)
Route::middleware('auth.user')->group(function () {
    Route::get('/booking', [App\Http\Controllers\BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking/available-barbers', [App\Http\Controllers\BookingController::class, 'getAvailableBarbers'])->name('booking.available-barbers');
    Route::post('/booking/time-slots', [App\Http\Controllers\BookingController::class, 'getTimeSlots'])->name('booking.time-slots');
    Route::get('/booking/services', [App\Http\Controllers\BookingController::class, 'getServices'])->name('booking.services');
    Route::post('/booking/store', [App\Http\Controllers\BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{id}', [App\Http\Controllers\BookingController::class, 'show'])->name('booking.show');
    Route::get('/booking-confirmation', function () {
        return view('booking.confirmation');
    })->name('booking.confirmation');
    Route::post('/booking/check-availability', [App\Http\Controllers\BookingController::class, 'checkAvailability'])->name('booking.check-availability');
    Route::get('/booking-status', function () {
        return view('booking.status');
    })->name('booking.status');
    Route::post('/booking/check-status', [App\Http\Controllers\BookingController::class, 'checkStatus'])->name('booking.check-status');
});

// Test route for schedule system
Route::get('/test-schedule', function () {
    $allBarbers = App\Models\Barber::with('schedules')->get();
    return view('test-schedule', compact('allBarbers'));
})->name('test.schedule');

// Temporary routes for testing without authentication
Route::get('/test-booking', [App\Http\Controllers\BookingController::class, 'index'])->name('test.booking');
Route::post('/test-booking/available-barbers', [App\Http\Controllers\BookingController::class, 'getAvailableBarbers'])->name('test.booking.available-barbers');
Route::post('/test-booking/time-slots', [App\Http\Controllers\BookingController::class, 'getTimeSlots'])->name('test.booking.time-slots');
Route::get('/test-booking/services', [App\Http\Controllers\BookingController::class, 'getServices'])->name('test.booking.services');
Route::post('/test-booking/store', [App\Http\Controllers\BookingController::class, 'store'])->name('test.booking.store');
Route::post('/test-booking/generate-qris', [App\Http\Controllers\BookingController::class, 'generateQRIS'])->name('test.booking.generate-qris');

// Payment Gateway Webhooks (no CSRF protection needed)
Route::post('/gopay/webhook', [App\Http\Controllers\GopayWebhookController::class, 'handleWebhook'])->name('gopay.webhook');
Route::post('/gopay/check-status', [App\Http\Controllers\GopayWebhookController::class, 'checkPaymentStatus'])->name('gopay.check-status');

Route::post('/midtrans/notification', [App\Http\Controllers\MidtransWebhookController::class, 'handleNotification'])->name('midtrans.notification');
Route::post('/midtrans/check-status', [App\Http\Controllers\MidtransWebhookController::class, 'checkPaymentStatus'])->name('midtrans.check-status');

// Booking receipt page (accessible without auth for testing)
Route::get('/booking-receipt', function () {
    return view('booking.receipt');
})->name('booking.receipt');




