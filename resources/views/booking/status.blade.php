@extends('layouts.app')

@section('title', 'Cek Status Booking - Sisbar Hairstudio')

@section('content')
<div class="min-h-screen bg-black pt-20">
    <!-- Background Image with Dark Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/bg-barber.jpg') }}');">
        <div class="absolute inset-0 bg-black/80"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 py-20">
        <div class="max-w-2xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-white mb-6">Cek Status Booking</h1>
                <p class="text-gray-300 text-xl">Masukkan nomor telepon untuk melihat status booking Anda</p>
                <div class="flex justify-center mt-8">
                    <div class="w-32 h-1 bg-linear-to-r from-yellow-400 to-yellow-600 rounded-full"></div>
                </div>
            </div>

            <!-- Search Form -->
            <div class="bg-slate-800 rounded-3xl shadow-2xl p-8 mb-8">
                <div class="text-center mb-6">
                    <p class="text-gray-300">Menampilkan booking untuk: <span class="text-yellow-400 font-semibold">{{ auth()->user()->email }}</span></p>
                </div>
                
                <form id="status-form" class="space-y-6">
                    @csrf
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-300 mb-2">Filter berdasarkan Nomor Telepon (Opsional)</label>
                        <input type="tel" id="phone" name="phone"
                               class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                               placeholder="08xxxxxxxxxx">
                    </div>
                    <div>
                        <label for="booking_id" class="block text-sm font-medium text-gray-300 mb-2">ID Booking Spesifik (Opsional)</label>
                        <input type="number" id="booking_id" name="booking_id"
                               class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                               placeholder="Masukkan ID booking jika ada">
                    </div>
                    <button type="submit" 
                            class="w-full px-8 py-4 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors">
                        Cari Booking
                    </button>
                </form>
                
                <div class="mt-4 text-center">
                    <button onclick="loadAllBookings()" 
                            class="px-6 py-2 bg-blue-500 hover:bg-blue-600 text-white font-medium rounded-xl transition-colors">
                        Tampilkan Semua Booking Saya
                    </button>
                </div>
            </div>

            <!-- Loading State -->
            <div id="loading" class="hidden text-center py-8">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-yellow-400"></div>
                <p class="text-gray-300 mt-2">Mencari booking Anda...</p>
            </div>

            <!-- Results -->
            <div id="results" class="hidden">
                <div class="bg-slate-800 rounded-3xl shadow-2xl p-8">
                    <h2 class="text-2xl font-bold text-white mb-6">Booking Anda</h2>
                    <div id="bookings-list" class="space-y-4">
                        <!-- Bookings will be populated here -->
                    </div>
                </div>
            </div>

            <!-- No Results -->
            <div id="no-results" class="hidden">
                <div class="bg-slate-800 rounded-3xl shadow-2xl p-8 text-center">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Booking Tidak Ditemukan</h3>
                    <p class="text-gray-300 mb-6">Tidak ditemukan booking dengan nomor telepon yang Anda masukkan.</p>
                    <a href="{{ route('booking.index') }}" 
                       class="inline-block px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors">
                        Buat Booking Baru
                    </a>
                </div>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-8">
                <a href="/" 
                   class="inline-block px-8 py-3 bg-slate-600 hover:bg-slate-500 text-white font-bold rounded-xl transition-colors">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('status-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    showLoading();
    hideResults();
    hideNoResults();
    
    try {
        const response = await fetch('{{ route("booking.check-status") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        hideLoading();
        
        if (result.success && result.bookings.length > 0) {
            displayBookings(result.bookings);
            showResults();
        } else {
            showNoResults();
        }
    } catch (error) {
        console.error('Error:', error);
        hideLoading();
        alert('Terjadi kesalahan saat mencari booking. Silakan coba lagi.');
    }
});

function displayBookings(bookings) {
    const bookingsList = document.getElementById('bookings-list');
    bookingsList.innerHTML = '';
    
    bookings.forEach(booking => {
        const statusColors = {
            'yellow': 'bg-yellow-500',
            'blue': 'bg-blue-500',
            'green': 'bg-green-500',
            'red': 'bg-red-500',
            'gray': 'bg-gray-500'
        };
        
        const bookingCard = document.createElement('div');
        bookingCard.className = 'bg-slate-700 rounded-2xl p-6 border border-slate-600';
        
        bookingCard.innerHTML = `
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h3 class="text-lg font-bold text-white">Booking #${booking.id}</h3>
                    <p class="text-gray-300">${booking.customer_name}</p>
                </div>
                <span class="px-3 py-1 ${statusColors[booking.status_color] || 'bg-gray-500'} text-white text-sm rounded-full">
                    ${booking.status}
                </span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-gray-400 text-sm">Tanggal & Waktu</p>
                    <p class="text-white font-semibold">${booking.date} - ${booking.time}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Kapster</p>
                    <p class="text-white font-semibold">${booking.barber_name}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Layanan</p>
                    <p class="text-white font-semibold">${booking.service_name}</p>
                </div>
                <div>
                    <p class="text-gray-400 text-sm">Total Harga</p>
                    <p class="text-yellow-400 font-bold">Rp ${booking.total_price.toLocaleString('id-ID')}</p>
                </div>
            </div>
            
            ${booking.notes ? `
                <div class="border-t border-slate-600 pt-4">
                    <p class="text-gray-400 text-sm">Catatan</p>
                    <p class="text-gray-300">${booking.notes}</p>
                </div>
            ` : ''}
        `;
        
        bookingsList.appendChild(bookingCard);
    });
}

function showLoading() {
    document.getElementById('loading').classList.remove('hidden');
}

function hideLoading() {
    document.getElementById('loading').classList.add('hidden');
}

function showResults() {
    document.getElementById('results').classList.remove('hidden');
}

function hideResults() {
    document.getElementById('results').classList.add('hidden');
}

function showNoResults() {
    document.getElementById('no-results').classList.remove('hidden');
}

function hideNoResults() {
    document.getElementById('no-results').classList.add('hidden');
}

function loadAllBookings() {
    showLoading();
    hideResults();
    hideNoResults();
    
    fetch('{{ route("booking.check-status") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({})
    })
    .then(response => response.json())
    .then(result => {
        hideLoading();
        
        if (result.success && result.bookings.length > 0) {
            displayBookings(result.bookings);
            showResults();
        } else {
            showNoResults();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        hideLoading();
        alert('Terjadi kesalahan saat memuat booking. Silakan coba lagi.');
    });
}

// Auto load all bookings when page loads
document.addEventListener('DOMContentLoaded', function() {
    loadAllBookings();
});
</script>
@endsection