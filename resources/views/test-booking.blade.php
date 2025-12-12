@extends('layouts.app')

@section('title', 'Test Booking - Sisbar Hairstudio')

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
                <h1 class="text-5xl font-bold text-white mb-6">Test Booking System</h1>
                <p class="text-gray-300 text-xl">Testing booking tanpa authentication</p>
                <div class="flex justify-center mt-8">
                    <div class="w-32 h-1 bg-linear-to-r from-yellow-400 to-yellow-600 rounded-full"></div>
                </div>
            </div>

            <!-- Test Info -->
            <div class="bg-blue-500/10 border border-blue-500/30 rounded-xl p-6 mb-8">
                <h3 class="text-blue-400 font-semibold mb-2">🧪 Mode Testing</h3>
                <p class="text-gray-300 text-sm">
                    Ini adalah halaman test booking tanpa perlu login. 
                    Data user akan menggunakan default test user.
                </p>
            </div>

            <!-- Progress Indicator -->
            <div class="bg-slate-800 rounded-2xl p-4 mb-6">
                <!-- Desktop Progress -->
                <div class="hidden md:flex items-center justify-between">
                    <div class="flex items-center space-x-2 lg:space-x-4">
                        <div id="progress-1" class="flex items-center">
                            <div class="w-8 h-8 bg-yellow-500 text-black rounded-full flex items-center justify-center font-bold text-sm">1</div>
                            <span class="ml-2 text-white text-sm hidden lg:block">Tanggal</span>
                        </div>
                        <div class="w-4 lg:w-8 h-0.5 bg-gray-600" id="line-1"></div>
                        <div id="progress-2" class="flex items-center">
                            <div class="w-8 h-8 bg-gray-600 text-gray-400 rounded-full flex items-center justify-center font-bold text-sm">2</div>
                            <span class="ml-2 text-gray-400 text-sm hidden lg:block">Kapster</span>
                        </div>
                        <div class="w-4 lg:w-8 h-0.5 bg-gray-600" id="line-2"></div>
                        <div id="progress-3" class="flex items-center">
                            <div class="w-8 h-8 bg-gray-600 text-gray-400 rounded-full flex items-center justify-center font-bold text-sm">3</div>
                            <span class="ml-2 text-gray-400 text-sm hidden lg:block">Waktu</span>
                        </div>
                        <div class="w-4 lg:w-8 h-0.5 bg-gray-600" id="line-3"></div>
                        <div id="progress-4" class="flex items-center">
                            <div class="w-8 h-8 bg-gray-600 text-gray-400 rounded-full flex items-center justify-center font-bold text-sm">4</div>
                            <span class="ml-2 text-gray-400 text-sm hidden lg:block">Layanan</span>
                        </div>
                        <div class="w-4 lg:w-8 h-0.5 bg-gray-600" id="line-4"></div>
                        <div id="progress-5" class="flex items-center">
                            <div class="w-8 h-8 bg-gray-600 text-gray-400 rounded-full flex items-center justify-center font-bold text-sm">5</div>
                            <span class="ml-2 text-gray-400 text-sm hidden lg:block">Data</span>
                        </div>
                        <div class="w-4 lg:w-8 h-0.5 bg-gray-600" id="line-5"></div>
                        <div id="progress-6" class="flex items-center">
                            <div class="w-8 h-8 bg-gray-600 text-gray-400 rounded-full flex items-center justify-center font-bold text-sm">6</div>
                            <span class="ml-2 text-gray-400 text-sm hidden lg:block">Konfirmasi</span>
                        </div>
                    </div>
                </div>
                
                <!-- Mobile Progress -->
                <div class="md:hidden">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-white font-semibold">Step <span id="mobile-current-step">1</span> dari 6</span>
                        <span class="text-gray-400 text-sm" id="mobile-step-name">Pilih Tanggal</span>
                    </div>
                    <div class="w-full bg-gray-600 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full transition-all duration-300" id="mobile-progress-bar" style="width: 16.67%"></div>
                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="bg-slate-800 rounded-3xl shadow-2xl p-8 mb-8">
                <form id="booking-form" class="space-y-6">
                    @csrf
                    
                    <!-- Step 1: Date Selection -->
                    <div id="step-1">
                        <h2 class="text-2xl font-bold text-white mb-6">1. Pilih Tanggal</h2>
                        <div class="flex flex-col md:flex-row gap-4 items-end">
                            <div class="flex-1">
                                <label for="booking-date" class="block text-sm font-medium text-gray-300 mb-2">Tanggal Appointment</label>
                                <input type="date" id="booking-date" name="booking_date" required
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                                       min="{{ date('Y-m-d') }}">
                            </div>
                            <button type="button" onclick="searchAvailableBarbers()" 
                                    class="px-8 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors">
                                Cari Kapster
                            </button>
                        </div>
                    </div>

                    <!-- Step 2: Barber Selection -->
                    <div id="step-2" class="hidden">
                        <h2 class="text-2xl font-bold text-white mb-6">2. Pilih Kapster</h2>
                        <div id="barbers-list" class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Barbers will be populated here -->
                        </div>
                    </div>

                    <!-- Step 3: Time Selection -->
                    <div id="step-3" class="hidden">
                        <h2 class="text-2xl font-bold text-white mb-6">3. Pilih Waktu</h2>
                        <div id="time-slots" class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 mb-6">
                            <!-- Time slots will be populated here -->
                        </div>
                    </div>

                    <!-- Step 4: Service Selection -->
                    <div id="step-4" class="hidden">
                        <h2 class="text-2xl font-bold text-white mb-6">4. Pilih Layanan</h2>
                        <div id="services-list" class="space-y-3 mb-6">
                            <!-- Services will be populated here -->
                        </div>
                    </div>

                    <!-- Step 5: Customer Information -->
                    <div id="step-5" class="hidden">
                        <h2 class="text-2xl font-bold text-white mb-6">5. Informasi Pelanggan</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="customer-name" class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap *</label>
                                <input type="text" id="customer-name" name="customer_name" required
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                                       placeholder="Masukkan nama lengkap"
                                       value="Test User">
                            </div>
                            <div>
                                <label for="customer-phone" class="block text-sm font-medium text-gray-300 mb-2">Nomor Telepon *</label>
                                <input type="tel" id="customer-phone" name="customer_phone" required
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                                       placeholder="08xxxxxxxxxx">
                            </div>
                            <div class="md:col-span-2">
                                <label for="customer-email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                                <input type="email" id="customer-email" name="customer_email"
                                       class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                                       placeholder="email@example.com"
                                       value="test@gmail.com">
                                <p class="text-gray-400 text-xs mt-1">Email test user</p>
                            </div>
                            <div class="md:col-span-2">
                                <label for="notes" class="block text-sm font-medium text-gray-300 mb-2">Catatan (Opsional)</label>
                                <textarea id="notes" name="notes" rows="3"
                                          class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white focus:ring-2 focus:ring-yellow-400 focus:border-yellow-400"
                                          placeholder="Catatan khusus untuk kapster..."></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Step 6: Confirmation -->
                    <div id="step-6" class="hidden">
                        <h2 class="text-2xl font-bold text-white mb-6">6. Konfirmasi Booking</h2>
                        <div class="bg-slate-700 rounded-xl p-6 mb-6">
                            <div id="booking-summary" class="space-y-3 text-gray-300">
                                <!-- Booking summary will be populated here -->
                            </div>
                        </div>
                        <button type="submit" 
                                class="w-full px-8 py-4 bg-yellow-500 hover:bg-yellow-600 text-black font-bold rounded-xl transition-colors">
                            Konfirmasi Booking (Test)
                        </button>
                    </div>

                    <!-- Navigation Buttons -->
                    <div id="navigation-buttons" class="flex justify-between pt-6">
                        <button type="button" id="prev-btn" onclick="previousStep()" 
                                class="px-6 py-3 bg-slate-600 hover:bg-slate-500 text-white font-medium rounded-xl transition-colors hidden">
                            Sebelumnya
                        </button>
                        <button type="button" id="next-btn" onclick="nextStep()" 
                                class="px-6 py-3 bg-yellow-500 hover:bg-yellow-600 text-black font-medium rounded-xl transition-colors hidden">
                            Selanjutnya
                        </button>
                        <button type="button" id="confirm-btn" onclick="goToConfirmation()" 
                                class="px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-medium rounded-xl transition-colors hidden">
                            Lanjut ke Konfirmasi
                        </button>
                    </div>
                </form>
            </div>

            <!-- Back to Home -->
            <div class="text-center">
                <a href="/" 
                   class="inline-block px-8 py-3 bg-slate-600 hover:bg-slate-500 text-white font-bold rounded-xl transition-colors mr-4">
                    Kembali ke Beranda
                </a>
                <a href="/test-login" 
                   class="inline-block px-8 py-3 bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-xl transition-colors">
                    Test Login System
                </a>
            </div>
        </div>
    </div>
</div>

<script>
let currentStep = 1;
let selectedBarber = null;
let selectedTime = null;
let selectedService = null;
let bookingData = {};

// Initialize
document.getElementById('booking-date').min = new Date().toISOString().split('T')[0];

async function searchAvailableBarbers() {
    const dateInput = document.getElementById('booking-date');
    const date = dateInput.value;
    
    if (!date) {
        alert('Silakan pilih tanggal terlebih dahulu');
        return;
    }

    try {
        const response = await fetch('/test-booking/available-barbers', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ date: date })
        });

        const data = await response.json();

        if (data.success && data.barbers.length > 0) {
            populateBarbers(data.barbers);
            showStep(2);
        } else {
            alert('Tidak ada kapster tersedia pada tanggal tersebut');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat mencari kapster. Silakan coba lagi.');
    }
}

function populateBarbers(barbers) {
    const barbersList = document.getElementById('barbers-list');
    barbersList.innerHTML = '';
    
    barbers.forEach(barber => {
        const barberCard = document.createElement('div');
        barberCard.className = 'bg-slate-700 rounded-2xl p-6 border border-slate-600 hover:border-yellow-400 transition-colors cursor-pointer';
        barberCard.onclick = () => selectBarber(barber);
        
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
            ${barber.schedule ? `<p class="text-yellow-400 text-sm">Jam kerja: ${barber.schedule}</p>` : ''}
        `;
        
        barbersList.appendChild(barberCard);
    });
}

async function selectBarber(barber) {
    selectedBarber = barber;
    bookingData.barber_id = barber.id;
    
    // Highlight selected barber
    document.querySelectorAll('#barbers-list > div').forEach(card => {
        card.classList.remove('border-yellow-400', 'bg-slate-600');
        card.classList.add('border-slate-600');
    });
    event.currentTarget.classList.add('border-yellow-400', 'bg-slate-600');
    
    // Load time slots
    await loadTimeSlots();
    showStep(3);
}

async function loadTimeSlots() {
    const date = document.getElementById('booking-date').value;
    
    try {
        const response = await fetch('/test-booking/time-slots', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ 
                barber_id: selectedBarber.id,
                date: date 
            })
        });

        const data = await response.json();
        
        if (data.success) {
            populateTimeSlots(data.time_slots);
        }
    } catch (error) {
        console.error('Error loading time slots:', error);
    }
}

function populateTimeSlots(timeSlots) {
    const timeSlotsContainer = document.getElementById('time-slots');
    timeSlotsContainer.innerHTML = '';
    
    if (timeSlots.length === 0) {
        timeSlotsContainer.innerHTML = '<p class="text-gray-300 col-span-full text-center">Tidak ada waktu yang tersedia untuk hari ini.</p>';
        return;
    }
    
    timeSlots.forEach(slot => {
        const timeButton = document.createElement('button');
        timeButton.type = 'button';
        timeButton.className = 'px-4 py-3 bg-slate-700 border border-slate-600 rounded-xl text-white hover:border-yellow-400 hover:bg-slate-600 transition-colors';
        timeButton.textContent = slot.display;
        timeButton.onclick = () => selectTime(slot);
        
        timeSlotsContainer.appendChild(timeButton);
    });
}

function selectTime(timeSlot) {
    selectedTime = timeSlot;
    bookingData.booking_time = timeSlot.time;
    
    // Highlight selected time
    document.querySelectorAll('#time-slots button').forEach(btn => {
        btn.classList.remove('border-yellow-400', 'bg-slate-600');
        btn.classList.add('border-slate-600');
    });
    event.currentTarget.classList.add('border-yellow-400', 'bg-slate-600');
    
    // Load services
    loadServices();
    showStep(4);
}

async function loadServices() {
    try {
        const response = await fetch('/test-booking/services');
        const data = await response.json();
        
        if (data.success) {
            populateServices(data.services);
        }
    } catch (error) {
        console.error('Error loading services:', error);
    }
}

function populateServices(services) {
    const servicesList = document.getElementById('services-list');
    servicesList.innerHTML = '';
    
    services.forEach(service => {
        const serviceCard = document.createElement('div');
        serviceCard.className = 'bg-slate-700 border border-slate-600 rounded-xl p-4 hover:border-yellow-400 transition-colors cursor-pointer';
        serviceCard.onclick = () => selectService(service);
        
        serviceCard.innerHTML = `
            <div class="flex justify-between items-center">
                <div>
                    <h4 class="text-white font-semibold">${service.name}</h4>
                    <p class="text-gray-400 text-sm">${service.duration} menit</p>
                </div>
                <div class="text-right">
                    <p class="text-yellow-400 font-bold">${service.formatted_price}</p>
                </div>
            </div>
        `;
        
        servicesList.appendChild(serviceCard);
    });
}

function selectService(service) {
    selectedService = service;
    bookingData.service_id = service.id;
    bookingData.total_price = service.price;
    
    // Highlight selected service
    document.querySelectorAll('#services-list > div').forEach(card => {
        card.classList.remove('border-yellow-400', 'bg-slate-600');
        card.classList.add('border-slate-600');
    });
    event.currentTarget.classList.add('border-yellow-400', 'bg-slate-600');
    
    showStep(5);
}

function showStep(step) {
    console.log('Showing step:', step);
    
    // Hide all steps
    for (let i = 1; i <= 6; i++) {
        document.getElementById(`step-${i}`).classList.add('hidden');
    }
    
    // Show current step
    document.getElementById(`step-${step}`).classList.remove('hidden');
    currentStep = step;
    
    // Update progress indicator
    updateProgressIndicator(step);
    
    // Update navigation buttons
    updateNavigationButtons();
    
    // If step 6, populate summary
    if (step === 6) {
        populateBookingSummary();
    }
    
    // Scroll to top of form
    document.getElementById('booking-form').scrollIntoView({ behavior: 'smooth' });
}

function updateProgressIndicator(step) {
    const stepNames = ['', 'Pilih Tanggal', 'Pilih Kapster', 'Pilih Waktu', 'Pilih Layanan', 'Isi Data', 'Konfirmasi'];
    
    // Update desktop progress
    for (let i = 1; i <= 6; i++) {
        const progressElement = document.getElementById(`progress-${i}`);
        if (progressElement) {
            const circle = progressElement.querySelector('div');
            const text = progressElement.querySelector('span');
            const line = document.getElementById(`line-${i}`);
            
            if (i <= step) {
                // Active/completed step
                circle.className = 'w-8 h-8 bg-yellow-500 text-black rounded-full flex items-center justify-center font-bold text-sm';
                if (text) text.className = 'ml-2 text-white text-sm hidden lg:block';
                if (line && i < step) {
                    line.className = 'w-4 lg:w-8 h-0.5 bg-yellow-500';
                }
            } else {
                // Inactive step
                circle.className = 'w-8 h-8 bg-gray-600 text-gray-400 rounded-full flex items-center justify-center font-bold text-sm';
                if (text) text.className = 'ml-2 text-gray-400 text-sm hidden lg:block';
                if (line) {
                    line.className = 'w-4 lg:w-8 h-0.5 bg-gray-600';
                }
            }
        }
    }
    
    // Update mobile progress
    const mobileCurrentStep = document.getElementById('mobile-current-step');
    const mobileStepName = document.getElementById('mobile-step-name');
    const mobileProgressBar = document.getElementById('mobile-progress-bar');
    
    if (mobileCurrentStep) mobileCurrentStep.textContent = step;
    if (mobileStepName) mobileStepName.textContent = stepNames[step];
    if (mobileProgressBar) {
        const percentage = (step / 6) * 100;
        mobileProgressBar.style.width = percentage + '%';
    }
}

function updateNavigationButtons() {
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const confirmBtn = document.getElementById('confirm-btn');
    
    prevBtn.classList.toggle('hidden', currentStep === 1);
    nextBtn.classList.toggle('hidden', currentStep >= 5);
    confirmBtn.classList.toggle('hidden', currentStep !== 5);
}

function previousStep() {
    if (currentStep > 1) {
        showStep(currentStep - 1);
    }
}

function nextStep() {
    if (currentStep < 6) {
        showStep(currentStep + 1);
    }
}

function goToConfirmation() {
    // Validate required fields in step 5
    const customerName = document.getElementById('customer-name').value;
    const customerPhone = document.getElementById('customer-phone').value;
    
    if (!customerName.trim()) {
        alert('Nama lengkap harus diisi');
        return;
    }
    
    if (!customerPhone.trim()) {
        alert('Nomor telepon harus diisi');
        return;
    }
    
    // Go to confirmation step
    showStep(6);
}

function populateBookingSummary() {
    const date = document.getElementById('booking-date').value;
    const summary = document.getElementById('booking-summary');
    
    summary.innerHTML = `
        <div class="grid grid-cols-2 gap-4">
            <div><strong>Tanggal:</strong></div>
            <div>${new Date(date).toLocaleDateString('id-ID')}</div>
            
            <div><strong>Waktu:</strong></div>
            <div>${selectedTime.display}</div>
            
            <div><strong>Kapster:</strong></div>
            <div>${selectedBarber.name} (${selectedBarber.level})</div>
            
            <div><strong>Layanan:</strong></div>
            <div>${selectedService.name}</div>
            
            <div><strong>Durasi:</strong></div>
            <div>${selectedService.duration} menit</div>
            
            <div><strong>Total Harga:</strong></div>
            <div class="text-yellow-400 font-bold">${selectedService.formatted_price}</div>
        </div>
    `;
}

// Form submission
document.getElementById('booking-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData.entries());
    
    // Add selected data
    Object.assign(data, bookingData);
    
    try {
        const response = await fetch('/test-booking/store', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();
        
        if (result.success) {
            // Store booking data for receipt
            localStorage.setItem('lastBooking', JSON.stringify(result.booking));
            
            // Redirect to receipt page
            window.location.href = '/booking-receipt?booking_id=' + result.booking_id;
        } else {
            alert(result.message || 'Terjadi kesalahan saat membuat booking.');
        }
    } catch (error) {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat membuat booking. Silakan coba lagi.');
    }
});
</script>
@endsection