@extends('layouts.app')

@section('title', 'Struk Booking - Sisbar Hairstudio')

@section('content')
<div class="min-h-screen bg-black pt-20">
    <!-- Background Image with Dark Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/bg-barber.jpg') }}');">
        <div class="absolute inset-0 bg-black/80"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 py-20">
        <div class="max-w-2xl mx-auto">
            <!-- Success Icon -->
            <div class="text-center mb-8">
                <div class="w-20 h-20 bg-green-500 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h1 class="text-4xl font-bold text-white mb-4">Booking Berhasil!</h1>
                <p class="text-gray-300 text-lg">Terima kasih telah mempercayakan perawatan rambut Anda kepada kami</p>
                <div class="flex justify-center mt-6">
                    <div class="w-24 h-1 bg-linear-to-r from-yellow-400 to-yellow-600 rounded-full"></div>
                </div>
            </div>

            <!-- Receipt Card -->
            <div id="receipt-card" class="bg-white rounded-3xl shadow-2xl p-8 mb-8 text-black">
                <!-- Header -->
                <div class="text-center border-b-2 border-dashed border-gray-300 pb-6 mb-6">
                    <div class="flex items-center justify-center mb-4">
                        <img src="{{ asset('images/logo-sisbar.png') }}" alt="Sisbar Hairstudio" class="h-12 w-auto object-contain mr-3" 
                             onerror="this.style.display='none';">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Sisbar Hairstudio</h2>
                            <p class="text-gray-600 text-sm">Professional Barbershop</p>
                        </div>
                    </div>
                    <p class="text-gray-600">Jl. Raya Barbershop No. 123</p>
                    <p class="text-gray-600">Telp: +62 812-3456-7890</p>
                </div>

                <!-- Receipt Details -->
                <div class="mb-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-800">STRUK BOOKING</h3>
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Booking ID</p>
                            <p class="font-bold text-lg" id="receipt-booking-id">#0000</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600">Tanggal Booking:</p>
                            <p class="font-semibold" id="receipt-date">-</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Waktu:</p>
                            <p class="font-semibold" id="receipt-time">-</p>
                        </div>
                        <div>
                            <p class="text-gray-600">Nama Pelanggan:</p>
                            <p class="font-semibold" id="receipt-customer">-</p>
                        </div>
                        <div>
                            <p class="text-gray-600">No. Telepon:</p>
                            <p class="font-semibold" id="receipt-phone">-</p>
                        </div>
                    </div>
                </div>

                <!-- Service Details -->
                <div class="border-t border-gray-200 pt-4 mb-6">
                    <h4 class="font-bold text-gray-800 mb-3">Detail Layanan</h4>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <p class="font-semibold" id="receipt-service">-</p>
                                <p class="text-sm text-gray-600">Kapster: <span id="receipt-barber">-</span></p>
                                <p class="text-sm text-gray-600">Durasi: <span id="receipt-duration">-</span> menit</p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-lg" id="receipt-price">Rp 0</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total -->
                <div class="border-t-2 border-dashed border-gray-300 pt-4 mb-6">
                    <div class="flex justify-between items-center">
                        <p class="text-xl font-bold text-gray-800">TOTAL PEMBAYARAN</p>
                        <p class="text-2xl font-bold text-green-600" id="receipt-total">Rp 0</p>
                    </div>
                </div>

                <!-- Status -->
                <div class="text-center mb-6">
                    <div class="inline-flex items-center px-4 py-2 bg-yellow-100 border border-yellow-300 rounded-full">
                        <div class="w-3 h-3 bg-yellow-500 rounded-full mr-2"></div>
                        <span class="text-yellow-800 font-semibold">Menunggu Konfirmasi</span>
                    </div>
                </div>

                <!-- Notes -->
                <div id="receipt-notes-section" class="hidden mb-6">
                    <h4 class="font-bold text-gray-800 mb-2">Catatan</h4>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3">
                        <p class="text-blue-800" id="receipt-notes">-</p>
                    </div>
                </div>

                <!-- Footer -->
                <div class="border-t border-gray-200 pt-4 text-center text-sm text-gray-600">
                    <p class="mb-2">Terima kasih atas kepercayaan Anda!</p>
                    <p class="mb-2">Kami akan menghubungi Anda untuk konfirmasi</p>
                    <p class="text-xs">Dicetak pada: <span id="receipt-print-time">-</span></p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center space-y-4">
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button onclick="printReceipt()" 
                            class="px-8 py-3 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-xl transition-colors">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak Struk
                    </button>
                    
                    <button onclick="downloadReceipt()" 
                            class="px-8 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-xl transition-colors">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download PDF
                    </button>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="/test-booking" 
                       class="inline-block px-8 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors">
                        Booking Lagi
                    </a>
                    
                    <a href="/booking-status" 
                       class="inline-block px-8 py-3 bg-purple-500 hover:bg-purple-600 text-white font-bold rounded-xl transition-colors">
                        Cek Status Booking
                    </a>
                    
                    <a href="/" 
                       class="inline-block px-8 py-3 bg-slate-600 hover:bg-slate-500 text-white font-bold rounded-xl transition-colors">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-slate-800 rounded-3xl shadow-2xl p-6 mt-8">
                <h3 class="text-xl font-bold text-white mb-4 text-center">Informasi Kontak</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h4 class="text-white font-semibold">WhatsApp</h4>
                        <p class="text-gray-300">+62 812-3456-7890</p>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-yellow-500 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-white font-semibold">Alamat</h4>
                        <p class="text-gray-300">Jl. Raya Barbershop No. 123</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    loadBookingData();
});

function loadBookingData() {
    // Get booking data from URL parameters or localStorage
    const urlParams = new URLSearchParams(window.location.search);
    const bookingId = urlParams.get('booking_id');
    
    if (bookingId) {
        // Try to fetch from server first
        fetch(`/booking/${bookingId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    displayBookingData(data.booking);
                } else {
                    // Fallback to localStorage
                    loadFromLocalStorage();
                }
            })
            .catch(error => {
                console.error('Error fetching booking:', error);
                // Fallback to localStorage
                loadFromLocalStorage();
            });
    } else {
        loadFromLocalStorage();
    }
}

function loadFromLocalStorage() {
    const bookingData = localStorage.getItem('lastBooking');
    if (bookingData) {
        const booking = JSON.parse(bookingData);
        displayBookingData(booking);
        // Clean up localStorage after use
        localStorage.removeItem('lastBooking');
    } else {
        // Show error if no data found
        alert('Data booking tidak ditemukan. Redirecting ke home...');
        window.location.href = '/';
    }
}

function displayBookingData(booking) {
    // Populate receipt with booking data
    document.getElementById('receipt-booking-id').textContent = '#' + booking.id;
    document.getElementById('receipt-date').textContent = booking.date || formatDate(booking.booking_date);
    document.getElementById('receipt-time').textContent = booking.time || booking.booking_time;
    document.getElementById('receipt-customer').textContent = booking.customer_name;
    document.getElementById('receipt-phone').textContent = booking.customer_phone || '-';
    document.getElementById('receipt-service').textContent = booking.service_name || booking.service?.name;
    document.getElementById('receipt-barber').textContent = booking.barber_name || booking.barber?.name;
    document.getElementById('receipt-duration').textContent = booking.service?.duration || '30';
    
    // Format price
    const price = booking.total_price || 0;
    const formattedPrice = 'Rp ' + price.toLocaleString('id-ID');
    document.getElementById('receipt-price').textContent = formattedPrice;
    document.getElementById('receipt-total').textContent = formattedPrice;
    
    // Show notes if available
    if (booking.notes) {
        document.getElementById('receipt-notes').textContent = booking.notes;
        document.getElementById('receipt-notes-section').classList.remove('hidden');
    }
    
    // Set print time
    document.getElementById('receipt-print-time').textContent = new Date().toLocaleString('id-ID');
}

function formatDate(dateString) {
    if (!dateString) return '-';
    const date = new Date(dateString);
    return date.toLocaleDateString('id-ID', {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

function printReceipt() {
    // Hide action buttons for printing
    const actionButtons = document.querySelectorAll('.text-center.space-y-4, .bg-slate-800');
    actionButtons.forEach(btn => btn.style.display = 'none');
    
    // Print the page
    window.print();
    
    // Show action buttons again after printing
    setTimeout(() => {
        actionButtons.forEach(btn => btn.style.display = 'block');
    }, 1000);
}

function downloadReceipt() {
    // Simple implementation - you can enhance this with libraries like jsPDF
    const receiptContent = document.getElementById('receipt-card').innerHTML;
    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
            <head>
                <title>Struk Booking - Sisbar Hairstudio</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    .receipt-card { max-width: 600px; margin: 0 auto; }
                </style>
            </head>
            <body>
                <div class="receipt-card">${receiptContent}</div>
                <script>
                    window.onload = function() {
                        window.print();
                        window.close();
                    }
                </script>
            </body>
        </html>
    `);
    printWindow.document.close();
}
</script>

<style>
@media print {
    body * {
        visibility: hidden;
    }
    #receipt-card, #receipt-card * {
        visibility: visible;
    }
    #receipt-card {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
    }
    .text-center.space-y-4,
    .bg-slate-800 {
        display: none !important;
    }
}
</style>
@endsection