<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pangling Barbershop')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
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
            @include('components.service-list')
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

        <!-- Admin Dashboard -->
        <div data-page="admin" style="display: {{ request()->is('admin*') ? 'block' : 'none' }}">
            @include('components.admin-dashboard')
        </div>

        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>