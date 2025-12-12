@extends('layouts.barbershop')

@section('title', 'Booking Appointment - Sisbar Hairstudio')

@section('content')
<div class="min-h-screen bg-black pt-20">
    <!-- Background Image with Dark Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/bg-barber.jpg') }}');">
        <div class="absolute inset-0 bg-black/80"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 py-20">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-12">
                <h1 class="text-5xl font-bold text-white mb-6">Booking Appointment</h1>
                <p class="text-gray-300 text-xl">Pilih tanggal untuk melihat kapster yang tersedia</p>
                <div class="flex justify-center mt-8">
                    <div class="w-32 h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full"></div>
                </div>
            </div>

            <!-- Date Selection -->
            <div class="bg-slate-800 rounded-3xl shadow-2xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-white mb-6">Pilih Tanggal</h2>
                <div class="flex flex-col md:flex-row gap-4 items-end">
                    <div class="flex-1">
                        <label for="booking-date" class="block text-sm font-medium text-gray-300 mb-2">Tanggal Appointment</label>
                        <input type="date" id="booking-date" 
                               class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                               min="{{ date('Y-m-d') }}">
                    </div>
                    <button onclick="searchAvailableBarbers()" 
                            class="px-8 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors">
                        Cari Kapster
                    </button>
                </div>
            </div>

            <!-- Loading State -->
            <div id="loading" class="hidden text-center py-8">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-yellow-400"></div>
                <p class="text-gray-300 mt-2">Mencari kapster yang tersedia...</p>
            </div>

            <!-- Results -->
            <div id="results" class="hidden">
                <div class="bg-slate-800 rounded-3xl shadow-2xl p-8">
                    <h2 class="text-2xl font-bold text-white mb-6">Kapster Tersedia</h2>
                    <div id="selected-date-info" class="mb-6 p-4 bg-yellow-500/10 border border-yellow-500/30 rounded-xl">
                        <p class="text-yellow-400 font-medium"></p>
                    </div>
                    <div id="barbers-list" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Barbers will be populated here -->
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
                    <h3 class="text-xl font-bold text-white mb-2">Tidak Ada Kapster Tersedia</h3>
                    <p class="text-gray-300">Maaf, tidak ada kapster yang tersedia pada tanggal yang dipilih. Silakan pilih tanggal lain.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
async function searchAvailableBarbers() {
    const dateInput = document.getElementById('booking-date');
    const date = dateInput.value;
    
    if (!date) {
        alert('Silakan pilih tanggal terlebih dahulu');
        return;
    }

    // Show loading
    document.getElementById('loading').classList.remove('hidden');
    document.getElementById('results').classList.add('hidden');
    document.getElementById('no-results').classList.add('hidden');

    try {
        const response = await fetch('{{ route("booking.available-barbers") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ date: date })
        });

        const data = await response.json();
        
        // Hide loading
        document.getElementById('loading').classList.add('hidden');

        if (data.success && data.barbers.length > 0) {
            // Show results
            document.getElementById('selected-date-info').querySelector('p').textContent = 
                `Kapster tersedia pada ${data.day_name}, ${new Date(data.date).toLocaleDateString('id-ID')}`;
            
            const barbersList = document.getElementById('barbers-list');
            barbersList.innerHTML = '';
            
            data.barbers.forEach(barber => {
                const barberCard = document.createElement('div');
                barberCard.className = 'bg-slate-700 rounded-2xl p-6 border border-slate-600 hover:border-yellow-400 transition-colors';
                barberCard.innerHTML = `
                    <div class="flex items-center mb-4">
                        ${barber.photo ? 
                            `<img src="${barber.photo}" alt="${barber.name}" class="w-16 h-16 rounded-full object-cover mr-4">` :
                            `<div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>`
                        }
                        <div>
                            <h3 class="text-lg font-bold text-white">${barber.name}</h3>
                            <p class="text-yellow-400 text-sm">${barber.level}</p>
                            <div class="flex items-center mt-1">
                                <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                <span class="text-gray-300 text-sm">${barber.rating}</span>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-300 text-sm mb-3">${barber.specialty}</p>
                    ${barber.schedule ? `<p class="text-yellow-400 text-sm mb-4">Jam kerja: ${barber.schedule}</p>` : ''}
                    <button onclick="selectBarber(${barber.id}, '${barber.name}')" 
                            class="w-full bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-2 px-4 rounded-xl transition-colors">
                        Pilih Kapster
                    </button>
                `;
                barbersList.appendChild(barberCard);
            });
            
            document.getElementById('results').classList.remove('hidden');
        } else {
            // Show no results
            document.getElementById('no-results').classList.remove('hidden');
        }
    } catch (error) {
        console.error('Error:', error);
        document.getElementById('loading').classList.add('hidden');
        alert('Terjadi kesalahan saat mencari kapster. Silakan coba lagi.');
    }
}

function selectBarber(barberId, barberName) {
    const date = document.getElementById('booking-date').value;
    alert(`Anda memilih ${barberName} untuk tanggal ${new Date(date).toLocaleDateString('id-ID')}.\n\nFitur booking lengkap akan segera tersedia!`);
}

// Set minimum date to today
document.getElementById('booking-date').min = new Date().toISOString().split('T')[0];
</script>
@endsection