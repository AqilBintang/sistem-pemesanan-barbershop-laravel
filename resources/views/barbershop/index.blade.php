@extends('layouts.barbershop')

@section('title', 'Pangling Barbershop - Modern Booking System')

@section('content')
    <!-- Content will be handled by JavaScript navigation -->
@endsection

@push('scripts')
<script>
// Initialize the barbershop app and make it globally available
document.addEventListener('DOMContentLoaded', function() {
    window.barbershopApp = new BarbershopApp();
    
    // Set initial page based on current URL
    const path = window.location.pathname;
    let initialPage = 'home';
    
    if (path.includes('/services')) initialPage = 'services';
    else if (path.includes('/barbers')) initialPage = 'barbers';
    else if (path.includes('/booking')) initialPage = 'booking';
    else if (path.includes('/confirmation')) initialPage = 'confirmation';
    else if (path.includes('/notifications')) initialPage = 'notifications';
    else if (path.includes('/admin')) initialPage = 'admin';
    
    window.barbershopApp.navigateTo(initialPage);
});
</script>
@endpush