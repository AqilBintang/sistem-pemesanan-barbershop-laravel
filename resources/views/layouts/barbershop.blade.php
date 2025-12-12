<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sisbar Hairstudio')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo-sisbar.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/logo-sisbar.png') }}">
    
    <!-- Google Fonts - Elegant Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="min-h-screen bg-background">
    @include('components.navbar')

    <!-- Page Content -->
    <main>
        <!-- Landing Page -->
        <div data-page="home" style="display: {{ request()->is('/') ? 'block' : 'none' }}">
            @include('components.landing-page')
        </div>

        <!-- Services Page -->
        <div data-page="services" style="display: {{ request()->is('services*') ? 'block' : 'none' }}">
            @php
                $services = \App\Models\Service::where('is_active', true)->orderBy('type')->orderBy('price')->get();
            @endphp
            @include('components.service-list-dynamic', ['services' => $services])
        </div>

        <!-- Barbers Page -->
        <div data-page="barbers" style="display: {{ request()->is('barbers*') ? 'block' : 'none' }}">
            @include('components.barber-profile')
        </div>

        <!-- Booking Page -->
        <div data-page="booking" style="display: {{ request()->is('booking*') ? 'block' : 'none' }}">
            @include('components.booking-page')
        </div>

        <!-- Confirmation Page -->
        <div data-page="confirmation" style="display: {{ request()->is('confirmation*') ? 'block' : 'none' }}">
            @include('components.confirmation-page')
        </div>

        <!-- Notifications Page -->
        <div data-page="notifications" style="display: {{ request()->is('notifications*') ? 'block' : 'none' }}">
            @include('components.notification-template')
        </div>

        <!-- Gallery Page -->
        <div data-page="gallery" style="display: {{ request()->is('gallery*') ? 'block' : 'none' }}">
            @include('components.gallery-section')
        </div>

        <!-- Admin Dashboard -->
        <div data-page="admin" style="display: {{ request()->is('admin*') ? 'block' : 'none' }}">
            @include('components.admin-dashboard')
        </div>

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>