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

Route::get('/booking', function () {
    return view('users.booking');
});

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

Route::get('/services', [App\Http\Controllers\ServiceController::class, 'index']);
Route::get('/api/services', [App\Http\Controllers\ServiceController::class, 'getServices']);

// Test route untuk melihat data services
Route::get('/test-services', function() {
    $services = App\Models\Service::all();
    return response()->json($services);
});



Route::get('/barbers', function () {
    $barbers = App\Models\Barber::active()->orderBy('level', 'desc')->orderBy('rating', 'desc')->get();
    return view('barbershop.index', compact('barbers'));
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
        Route::post('/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    });
});

Route::get('/gallery', function () {
    return view('barbershop.index');
});

// Booking routes
Route::get('/booking', [App\Http\Controllers\BookingController::class, 'index'])->name('booking.index');
Route::post('/booking/available-barbers', [App\Http\Controllers\BookingController::class, 'getAvailableBarbers'])->name('booking.available-barbers');
Route::post('/booking/check-availability', [App\Http\Controllers\BookingController::class, 'checkAvailability'])->name('booking.check-availability');

// Test route for schedule system
Route::get('/test-schedule', function () {
    $allBarbers = App\Models\Barber::with('schedules')->get();
    return view('test-schedule', compact('allBarbers'));
})->name('test.schedule');
