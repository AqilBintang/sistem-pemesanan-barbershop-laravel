<!-- Hero Section - Siap Untuk Transformasi -->
<section class="relative min-h-screen text-white pt-16 flex items-center overflow-hidden hero-background">
    <!-- Animated Background Pattern -->
    <div class="absolute inset-0 barbershop-pattern"></div>
    
    <!-- Barbershop Interior Simulation -->
    <div class="absolute inset-0 opacity-8">
        <!-- Barber Chairs -->
        <div class="absolute bottom-0 left-1/4 w-16 h-32 bg-accent/30 rounded-t-full barber-chair"></div>
        <div class="absolute bottom-0 left-1/2 w-16 h-32 bg-accent/20 rounded-t-full barber-chair"></div>
        <div class="absolute bottom-0 right-1/4 w-16 h-32 bg-accent/25 rounded-t-full barber-chair"></div>
        
        <!-- Mirrors with Reflection Effect -->
        <div class="absolute top-1/4 left-1/4 w-12 h-20 border-2 border-accent/20 rounded-lg mirror-reflection"></div>
        <div class="absolute top-1/4 left-1/2 w-12 h-20 border-2 border-accent/15 rounded-lg mirror-reflection"></div>
        <div class="absolute top-1/4 right-1/4 w-12 h-20 border-2 border-accent/20 rounded-lg mirror-reflection"></div>
        
        <!-- Ceiling Lights with Beam Effect -->
        <div class="absolute top-10 left-1/3 w-8 h-8 bg-accent/30 rounded-full ceiling-light"></div>
        <div class="absolute top-10 right-1/3 w-8 h-8 bg-accent/25 rounded-full ceiling-light" style="animation-delay: 0.5s;"></div>
        
        <!-- Additional Barbershop Elements -->
        <div class="absolute top-1/3 left-10 w-4 h-12 bg-accent/15 rounded-full barber-pole"></div> <!-- Animated Pole -->
        <div class="absolute top-1/2 right-16 w-6 h-6 bg-accent/20 rounded-full animate-pulse"></div> <!-- Clock -->
        <div class="absolute bottom-1/4 left-16 w-8 h-4 bg-accent/10 rounded mirror-reflection"></div> <!-- Counter -->
        
        <!-- Vintage Barbershop Sign -->
        <div class="absolute top-20 left-1/2 transform -translate-x-1/2 text-xs text-accent/20 font-bold animate-pulse">
            BARBERSHOP
        </div>
    </div>
    
    <!-- Floating Elements -->
    <div class="absolute inset-0 opacity-15">
        <!-- Barbershop Tools -->
        <div class="absolute top-1/4 left-1/3 text-6xl text-accent/30 animate-float parallax-element tool-shimmer">✂️</div>
        <div class="absolute bottom-1/3 right-1/4 text-5xl text-accent/25 animate-float-delayed parallax-element tool-shimmer">💇‍♂️</div>
        <div class="absolute top-1/2 right-10 text-4xl text-accent/20 animate-float parallax-element tool-shimmer">🪒</div>
        <div class="absolute top-3/4 left-1/5 text-3xl text-accent/15 animate-float-delayed parallax-element tool-shimmer">🧴</div>
        <div class="absolute top-1/6 right-1/3 text-4xl text-accent/20 animate-float parallax-element tool-shimmer">🪮</div>
        
        <!-- Geometric Accents -->
        <div class="absolute top-10 left-10 w-32 h-32 border-2 border-accent/30 rounded-full animate-pulse parallax-element"></div>
        <div class="absolute top-32 right-20 w-24 h-24 border border-accent/20 rounded-full animate-bounce parallax-element"></div>
        <div class="absolute bottom-20 left-1/4 w-16 h-16 bg-accent/15 rounded-full animate-pulse parallax-element"></div>
        <div class="absolute bottom-32 right-1/3 w-20 h-20 border border-accent/25 rounded-full parallax-element"></div>
        
        <!-- Rotating Elements -->
        <div class="absolute top-20 right-1/3 w-8 h-8 bg-accent/25 rotate-45 animate-spin-slow parallax-element"></div>
        <div class="absolute bottom-40 left-20 w-12 h-12 bg-accent/20 rotate-12 animate-pulse parallax-element"></div>
        <div class="absolute top-1/2 left-10 w-6 h-6 bg-accent/30 rotate-45 animate-spin-slow parallax-element" style="animation-delay: 2s;"></div>
    </div>
    
    <!-- Dynamic Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-black/90 via-black/70 to-black/85 z-10"></div>
    
    <!-- Spotlight Effect -->
    <div class="absolute inset-0 z-5">
        <div class="absolute top-1/4 left-1/2 w-96 h-96 bg-accent/5 rounded-full blur-3xl spotlight"></div>
        <div class="absolute bottom-1/4 right-1/4 w-64 h-64 bg-accent/3 rounded-full blur-2xl spotlight" style="animation-delay: 2s;"></div>
    </div>
    
    <!-- Floating Particles -->
    <div class="absolute inset-0 z-5 pointer-events-none">
        <div class="absolute bottom-0 left-1/4 w-2 h-2 bg-accent/20 rounded-full floating-particle"></div>
        <div class="absolute bottom-0 left-1/2 w-1.5 h-1.5 bg-accent/15 rounded-full floating-particle"></div>
        <div class="absolute bottom-0 right-1/3 w-2.5 h-2.5 bg-accent/10 rounded-full floating-particle"></div>
        <div class="absolute bottom-0 right-1/4 w-1 h-1 bg-accent/25 rounded-full floating-particle"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-20">
        <div class="max-w-2xl">
            <div class="mb-6 animate-fade-in-up">
                <span class="bg-accent text-black px-4 py-2 rounded-full text-sm font-semibold">
                    Tentang Kami
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight animate-fade-in-up animation-delay-200">
                Siap Untuk Transformasi?
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90 leading-relaxed animate-fade-in-up animation-delay-400">
                Booking sekarang dan rasakan pengalaman barbershop premium yang berbeda
            </p>
            <button data-navigate="booking" class="bg-accent text-black px-8 py-4 rounded-lg font-semibold text-lg hover:bg-yellow-400 transition-all transform hover:scale-105 pulse-accent animate-fade-in-up animation-delay-600">
                Book Appointment
            </button>
        </div>
    </div>
</section>

<!-- About Section dengan Gambar Barbershop -->
<section class="relative py-20 bg-black text-white scroll-animate overflow-hidden">
    <!-- Luxury Background System -->
    <div class="absolute inset-0">
        <!-- Animated Gradient Base -->
        <div class="absolute inset-0 bg-gradient-to-br from-black via-gray-900 to-black animate-gradient-shift"></div>
        
        <!-- Premium Pattern Overlay -->
        <div class="absolute inset-0 opacity-10">
            <!-- Large Luxury Elements -->
            <div class="absolute top-10 right-10 w-80 h-80 border-2 border-accent/30 rounded-full animate-spin-slow"></div>
            <div class="absolute bottom-10 left-10 w-64 h-64 bg-accent/10 rounded-full blur-3xl spotlight"></div>
            
            <!-- Floating Luxury Icons -->
            <div class="absolute top-1/4 left-1/6 text-9xl text-accent/20 animate-float transform rotate-12">💎</div>
            <div class="absolute bottom-1/4 right-1/6 text-8xl text-accent/15 animate-float-delayed transform -rotate-12">👑</div>
            <div class="absolute top-1/2 right-1/4 text-7xl text-accent/20 animate-float">🏆</div>
            
            <!-- Barbershop Tools -->
            <div class="absolute top-1/3 left-1/3 text-6xl text-accent/25 animate-float tool-shimmer">✂️</div>
            <div class="absolute bottom-1/3 right-1/3 text-5xl text-accent/20 animate-float-delayed tool-shimmer">🪒</div>
        </div>
        
        <!-- Dynamic Light Rays -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/4 w-1 h-full bg-gradient-to-b from-accent/20 via-transparent to-accent/20 animate-pulse"></div>
            <div class="absolute top-0 right-1/3 w-1 h-full bg-gradient-to-b from-accent/15 via-transparent to-accent/15 animate-pulse" style="animation-delay: 1s;"></div>
        </div>
        
        <!-- Floating Particles -->
        <div class="absolute inset-0">
            <div class="absolute top-1/4 left-1/2 w-4 h-4 bg-accent/30 rounded-full floating-particle"></div>
            <div class="absolute top-1/2 left-1/4 w-3 h-3 bg-accent/25 rounded-full floating-particle"></div>
            <div class="absolute top-3/4 right-1/3 w-5 h-5 bg-accent/20 rounded-full floating-particle"></div>
        </div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <!-- Enhanced Image Section -->
            <div class="relative group">
                <!-- Premium Glow Effect -->
                <div class="absolute -inset-6 bg-gradient-to-r from-accent/30 via-accent/20 to-accent/30 rounded-3xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                
                <!-- Luxury Frame -->
                <div class="relative bg-gradient-to-br from-gray-800 via-black to-gray-900 rounded-3xl overflow-hidden shadow-2xl border-2 border-accent/30 group-hover:border-accent/50 transition-colors duration-500">
                    <!-- Premium Interior Showcase -->
                    <div class="aspect-[4/3] relative">
                        <!-- Exclusive Rating Badge -->
                        <div class="absolute top-6 left-6 bg-gradient-to-r from-accent to-yellow-400 text-black px-4 py-2 rounded-full text-sm font-bold flex items-center z-20 animate-bounce shadow-lg">
                            <span class="text-yellow-800 mr-2 text-lg">⭐</span>
                            <span>4.9/5 Premium Rating</span>
                        </div>

                        <!-- Luxury Barbershop Interior -->
                        <div class="absolute inset-0 bg-gradient-to-br from-gray-700 via-gray-800 to-black">
                            <!-- Premium Barber Stations -->
                            <div class="absolute bottom-6 left-10 w-16 h-20 bg-accent/40 rounded-t-xl animate-pulse shadow-lg"></div>
                            <div class="absolute bottom-6 right-10 w-16 h-20 bg-accent/35 rounded-t-xl animate-pulse shadow-lg" style="animation-delay: 0.5s;"></div>
                            
                            <!-- Luxury Mirrors -->
                            <div class="absolute top-10 left-10 w-12 h-16 border-3 border-accent/40 rounded-lg mirror-reflection shadow-xl"></div>
                            <div class="absolute top-10 right-10 w-12 h-16 border-3 border-accent/35 rounded-lg mirror-reflection shadow-xl"></div>
                            
                            <!-- Premium Lighting -->
                            <div class="absolute top-6 left-1/2 transform -translate-x-1/2 w-8 h-8 bg-accent/50 rounded-full ceiling-light shadow-lg"></div>
                            <div class="absolute top-6 left-1/3 w-6 h-6 bg-accent/40 rounded-full ceiling-light shadow-md" style="animation-delay: 0.3s;"></div>
                            <div class="absolute top-6 right-1/3 w-6 h-6 bg-accent/40 rounded-full ceiling-light shadow-md" style="animation-delay: 0.6s;"></div>
                            
                            <!-- Luxury Tools Display -->
                            <div class="absolute top-1/3 left-1/3 text-3xl text-accent/50 animate-float tool-shimmer">✂️</div>
                            <div class="absolute bottom-1/3 right-1/3 text-2xl text-accent/40 animate-float-delayed tool-shimmer">🪒</div>
                            <div class="absolute top-1/2 left-1/6 text-xl text-accent/35 animate-float tool-shimmer">🧴</div>
                            
                            <!-- Center Luxury Display -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center bg-black/30 backdrop-blur-sm rounded-xl p-4 border border-accent/20">
                                    <div class="text-5xl mb-3 animate-bounce">🏪</div>
                                    <p class="text-accent font-bold text-lg">Premium Interior</p>
                                    <p class="text-gray-300 text-sm">Luxury Experience</p>
                                </div>
                            </div>
                        </div>

                        <!-- Enhanced Shine Effect -->
                        <div class="absolute inset-0 bg-gradient-to-r from-transparent via-accent/10 to-transparent -skew-x-12 animate-shine"></div>
                        
                        <!-- Premium Border Glow -->
                        <div class="absolute inset-0 rounded-3xl border border-accent/20 animate-pulse"></div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Content Section -->
            <div class="space-y-8">
                <div class="animate-slide-in-right">
                    <span class="bg-gradient-to-r from-accent to-yellow-400 text-black px-6 py-3 rounded-full text-sm font-bold animate-pulse shadow-lg">
                        ✨ Tentang Kami ✨
                    </span>
                </div>
                
                <h2 class="text-5xl md:text-7xl font-bold mb-8 animate-slide-in-right stagger-1 leading-tight">
                    <span class="bg-gradient-to-r from-white via-accent to-white bg-clip-text text-transparent animate-shimmer">
                        Pangling Hairstudio
                    </span>
                </h2>
                
                <p class="text-xl md:text-2xl text-gray-300 mb-10 leading-relaxed animate-slide-in-right stagger-2">
                    <span class="text-accent font-semibold">Pangling Hairstudio</span> adalah barbershop premium yang menghadirkan pengalaman grooming terbaik untuk pria modern. 
                    <span class="text-white font-medium">Dengan tim kapster profesional dan peralatan modern, kami berkomitmen memberikan hasil terbaik untuk setiap pelanggan.</span>
                </p>

                <!-- Premium Features List -->
                <div class="space-y-6 mb-10">
                    <div class="flex items-center animate-slide-in-right stagger-3 group cursor-pointer">
                        <div class="w-12 h-12 bg-gradient-to-r from-accent to-yellow-400 rounded-full flex items-center justify-center mr-6 group-hover:scale-110 transition-transform shadow-lg">
                            <span class="text-black text-lg font-bold">✓</span>
                        </div>
                        <span class="text-xl group-hover:text-accent transition-colors font-medium">Tim kapster profesional dan berpengalaman</span>
                    </div>
                    <div class="flex items-center animate-slide-in-right stagger-4 group cursor-pointer">
                        <div class="w-12 h-12 bg-gradient-to-r from-accent to-yellow-400 rounded-full flex items-center justify-center mr-6 group-hover:scale-110 transition-transform shadow-lg">
                            <span class="text-black text-lg font-bold">✓</span>
                        </div>
                        <span class="text-xl group-hover:text-accent transition-colors font-medium">Peralatan modern dan berkualitas tinggi</span>
                    </div>
                    <div class="flex items-center animate-slide-in-right stagger-1 group cursor-pointer">
                        <div class="w-12 h-12 bg-gradient-to-r from-accent to-yellow-400 rounded-full flex items-center justify-center mr-6 group-hover:scale-110 transition-transform shadow-lg">
                            <span class="text-black text-lg font-bold">✓</span>
                        </div>
                        <span class="text-xl group-hover:text-accent transition-colors font-medium">Atmosfer premium dan nyaman</span>
                    </div>
                    <div class="flex items-center animate-slide-in-right stagger-2 group cursor-pointer">
                        <div class="w-12 h-12 bg-gradient-to-r from-accent to-yellow-400 rounded-full flex items-center justify-center mr-6 group-hover:scale-110 transition-transform shadow-lg">
                            <span class="text-black text-lg font-bold">✓</span>
                        </div>
                        <span class="text-xl group-hover:text-accent transition-colors font-medium">Produk perawatan rambut berkualitas</span>
                    </div>
                </div>

                <!-- Premium CTA Button -->
                <button data-navigate="barbers" class="group relative bg-gradient-to-r from-accent to-yellow-400 text-black px-10 py-5 rounded-xl font-bold text-lg hover:from-yellow-400 hover:to-accent transition-all transform hover:scale-105 pulse-accent animate-slide-in-right stagger-3 shadow-xl">
                    <span class="relative z-10">Kenali Tim Kami</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-accent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Mengapa Pilih Kami Section -->
<section class="relative py-20 bg-gradient-to-br from-gray-900 via-black to-gray-900 text-white scroll-animate overflow-hidden">
    <!-- Luxury Background System -->
    <div class="absolute inset-0">
        <!-- Dynamic Gradient Base -->
        <div class="absolute inset-0 bg-gradient-to-br from-black via-gray-900 to-black animate-gradient-shift"></div>
        
        <!-- Premium Geometric Elements -->
        <div class="absolute inset-0 opacity-15">
            <!-- Large Luxury Shapes -->
            <div class="absolute top-10 left-10 w-96 h-96 border-2 border-accent/30 rounded-full animate-spin-slow"></div>
            <div class="absolute bottom-10 right-10 w-80 h-80 bg-accent/10 rounded-full blur-3xl spotlight"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] border border-accent/20 rounded-full animate-pulse"></div>
            
            <!-- Floating Premium Icons -->
            <div class="absolute top-1/4 right-1/6 text-9xl text-accent/25 animate-float transform rotate-12">💎</div>
            <div class="absolute bottom-1/4 left-1/6 text-8xl text-accent/20 animate-float-delayed transform -rotate-12">🏆</div>
            <div class="absolute top-3/4 right-1/3 text-7xl text-accent/25 animate-float">⭐</div>
            <div class="absolute top-1/6 left-1/3 text-6xl text-accent/20 animate-float-delayed">👑</div>
        </div>
        
        <!-- Dynamic Light Beams -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/6 w-2 h-full bg-gradient-to-b from-accent/30 via-transparent to-accent/30 animate-pulse"></div>
            <div class="absolute top-0 right-1/4 w-2 h-full bg-gradient-to-b from-accent/25 via-transparent to-accent/25 animate-pulse" style="animation-delay: 1s;"></div>
            <div class="absolute top-0 left-1/2 w-1 h-full bg-gradient-to-b from-accent/20 via-transparent to-accent/20 animate-pulse" style="animation-delay: 2s;"></div>
        </div>
        
        <!-- Floating Luxury Particles -->
        <div class="absolute inset-0">
            <div class="absolute top-1/4 left-1/3 w-6 h-6 bg-accent/40 rounded-full floating-particle"></div>
            <div class="absolute top-1/2 right-1/4 w-4 h-4 bg-accent/35 rounded-full floating-particle"></div>
            <div class="absolute top-3/4 left-1/4 w-8 h-8 bg-accent/30 rounded-full floating-particle"></div>
            <div class="absolute top-1/6 right-1/3 w-5 h-5 bg-accent/25 rounded-full floating-particle"></div>
        </div>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Premium Header -->
        <div class="text-center mb-20">
            <div class="mb-8 animate-fade-in-up">
                <span class="bg-gradient-to-r from-accent via-yellow-400 to-accent text-black px-8 py-4 rounded-full text-lg font-bold animate-pulse shadow-xl">
                    ✨ Keunggulan Eksklusif ✨
                </span>
            </div>
            <h2 class="text-5xl md:text-8xl font-bold mb-8 animate-fade-in-up animation-delay-200 leading-tight">
                <span class="bg-gradient-to-r from-white via-accent to-white bg-clip-text text-transparent animate-shimmer">
                    Mengapa Pilih Kami?
                </span>
            </h2>
            <p class="text-xl md:text-3xl text-gray-300 max-w-4xl mx-auto leading-relaxed animate-fade-in-up animation-delay-400">
                Kami memahami kebutuhan Anda dan memberikan <span class="text-accent font-bold">solusi terbaik</span> untuk pengalaman barbershop yang <span class="text-white font-semibold">sempurna dan eksklusif</span>
            </p>
        </div>

        <!-- Premium Feature Cards -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Feature 1 - Premium -->
            <div class="group relative">
                <!-- Luxury Glow Effect -->
                <div class="absolute -inset-4 bg-gradient-to-r from-accent/40 via-accent/30 to-accent/40 rounded-3xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                
                <div class="relative bg-gradient-to-br from-gray-800 via-black to-gray-900 p-10 rounded-3xl shadow-2xl hover:shadow-accent/20 transition-all duration-700 text-center scroll-animate hover:transform hover:scale-105 border-2 border-accent/30 group-hover:border-accent/60">
                    <!-- Premium Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-accent/10 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    
                    <div class="relative z-10">
                        <!-- Luxury Icon Container -->
                        <div class="w-28 h-28 bg-gradient-to-br from-accent via-yellow-400 to-accent rounded-full flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-500 shadow-xl">
                            <div class="w-20 h-20 bg-black rounded-full flex items-center justify-center animate-pulse">
                                <span class="text-accent text-4xl">⏰</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold mb-6 text-white group-hover:text-accent transition-colors">Tidak Perlu Antri Lama</h3>
                        <p class="text-gray-300 leading-relaxed text-lg group-hover:text-white transition-colors">
                            Booking online membuat Anda tidak perlu menunggu lama di barbershop. <span class="text-accent font-semibold">Waktu Anda berharga!</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 2 - Premium -->
            <div class="group relative" style="animation-delay: 0.1s;">
                <div class="absolute -inset-4 bg-gradient-to-r from-accent/40 via-accent/30 to-accent/40 rounded-3xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                
                <div class="relative bg-gradient-to-br from-gray-800 via-black to-gray-900 p-10 rounded-3xl shadow-2xl hover:shadow-accent/20 transition-all duration-700 text-center scroll-animate hover:transform hover:scale-105 border-2 border-accent/30 group-hover:border-accent/60">
                    <div class="absolute inset-0 bg-gradient-to-br from-accent/10 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    
                    <div class="relative z-10">
                        <div class="w-28 h-28 bg-gradient-to-br from-accent via-yellow-400 to-accent rounded-full flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-500 shadow-xl">
                            <div class="w-20 h-20 bg-black rounded-full flex items-center justify-center animate-pulse" style="animation-delay: 0.2s;">
                                <span class="text-accent text-4xl">📅</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold mb-6 text-white group-hover:text-accent transition-colors">Booking Mudah & Cepat</h3>
                        <p class="text-gray-300 leading-relaxed text-lg group-hover:text-white transition-colors">
                            Pesan jadwal Anda kapan saja di mana saja dengan mudah. <span class="text-accent font-semibold">Fleksibilitas maksimal!</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 3 - Premium -->
            <div class="group relative" style="animation-delay: 0.2s;">
                <div class="absolute -inset-4 bg-gradient-to-r from-accent/40 via-accent/30 to-accent/40 rounded-3xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                
                <div class="relative bg-gradient-to-br from-gray-800 via-black to-gray-900 p-10 rounded-3xl shadow-2xl hover:shadow-accent/20 transition-all duration-700 text-center scroll-animate hover:transform hover:scale-105 border-2 border-accent/30 group-hover:border-accent/60">
                    <div class="absolute inset-0 bg-gradient-to-br from-accent/10 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    
                    <div class="relative z-10">
                        <div class="w-28 h-28 bg-gradient-to-br from-accent via-yellow-400 to-accent rounded-full flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-500 shadow-xl">
                            <div class="w-20 h-20 bg-black rounded-full flex items-center justify-center animate-pulse" style="animation-delay: 0.4s;">
                                <span class="text-accent text-4xl">💰</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold mb-6 text-white group-hover:text-accent transition-colors">Harga Jelas & Transparan</h3>
                        <p class="text-gray-300 leading-relaxed text-lg group-hover:text-white transition-colors">
                            Lihat harga layanan dengan jelas sebelum booking. <span class="text-accent font-semibold">Tanpa biaya tersembunyi!</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 4 - Premium -->
            <div class="group relative" style="animation-delay: 0.3s;">
                <div class="absolute -inset-4 bg-gradient-to-r from-accent/40 via-accent/30 to-accent/40 rounded-3xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                
                <div class="relative bg-gradient-to-br from-gray-800 via-black to-gray-900 p-10 rounded-3xl shadow-2xl hover:shadow-accent/20 transition-all duration-700 text-center scroll-animate hover:transform hover:scale-105 border-2 border-accent/30 group-hover:border-accent/60">
                    <div class="absolute inset-0 bg-gradient-to-br from-accent/10 to-transparent rounded-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                    
                    <div class="relative z-10">
                        <div class="w-28 h-28 bg-gradient-to-br from-accent via-yellow-400 to-accent rounded-full flex items-center justify-center mx-auto mb-8 group-hover:scale-110 transition-transform duration-500 shadow-xl">
                            <div class="w-20 h-20 bg-black rounded-full flex items-center justify-center animate-pulse" style="animation-delay: 0.6s;">
                                <span class="text-accent text-4xl">👨‍💼</span>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold mb-6 text-white group-hover:text-accent transition-colors">Pilih Kapster Favorit</h3>
                        <p class="text-gray-300 leading-relaxed text-lg group-hover:text-white transition-colors">
                            Kebebasan memilih kapster sesuai preferensi Anda. <span class="text-accent font-semibold">Personalisasi terbaik!</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Premium Stats Section -->
        <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-8 animate-fade-in-up animation-delay-800">
            <div class="text-center group">
                <div class="text-4xl md:text-6xl font-bold text-accent mb-3 group-hover:scale-110 transition-transform">98%</div>
                <div class="text-lg text-gray-400 group-hover:text-white transition-colors">Kepuasan Pelanggan</div>
            </div>
            <div class="text-center group">
                <div class="text-4xl md:text-6xl font-bold text-accent mb-3 group-hover:scale-110 transition-transform">24/7</div>
                <div class="text-lg text-gray-400 group-hover:text-white transition-colors">Online Booking</div>
            </div>
            <div class="text-center group">
                <div class="text-4xl md:text-6xl font-bold text-accent mb-3 group-hover:scale-110 transition-transform">100+</div>
                <div class="text-lg text-gray-400 group-hover:text-white transition-colors">Gaya Rambut</div>
            </div>
            <div class="text-center group">
                <div class="text-4xl md:text-6xl font-bold text-accent mb-3 group-hover:scale-110 transition-transform">5★</div>
                <div class="text-lg text-gray-400 group-hover:text-white transition-colors">Rating Premium</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section - Transformasi Gaya Rambut -->
<section class="relative py-20 bg-black text-white overflow-hidden scroll-animate">
    <!-- Dynamic Background -->
    <div class="absolute inset-0">
        <!-- Animated Gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-black via-gray-900 to-black animate-gradient-shift"></div>
        
        <!-- Barbershop Elements Background -->
        <div class="absolute inset-0 opacity-10">
            <!-- Large Scissors -->
            <div class="absolute top-10 left-10 text-9xl text-accent/20 animate-float transform rotate-12">✂️</div>
            <div class="absolute bottom-10 right-10 text-8xl text-accent/15 animate-float-delayed transform -rotate-12">🪒</div>
            
            <!-- Geometric Patterns -->
            <div class="absolute top-1/4 right-1/4 w-64 h-64 border-2 border-accent/20 rounded-full animate-spin-slow"></div>
            <div class="absolute bottom-1/4 left-1/4 w-48 h-48 bg-accent/10 rounded-full blur-xl animate-pulse"></div>
            
            <!-- Barber Pole Pattern -->
            <div class="absolute top-1/2 left-10 w-8 h-32 bg-accent/20 rounded-full barber-pole"></div>
            <div class="absolute top-1/3 right-20 w-6 h-24 bg-accent/15 rounded-full barber-pole" style="animation-delay: 1s;"></div>
        </div>
        
        <!-- Spotlight Effects -->
        <div class="absolute inset-0">
            <div class="absolute top-1/4 left-1/3 w-96 h-96 bg-accent/5 rounded-full blur-3xl spotlight"></div>
            <div class="absolute bottom-1/4 right-1/3 w-80 h-80 bg-accent/3 rounded-full blur-2xl spotlight" style="animation-delay: 2s;"></div>
        </div>
        
        <!-- Floating Particles -->
        <div class="absolute inset-0">
            <div class="absolute top-1/4 left-1/2 w-3 h-3 bg-accent/30 rounded-full floating-particle"></div>
            <div class="absolute top-1/2 left-1/4 w-2 h-2 bg-accent/25 rounded-full floating-particle"></div>
            <div class="absolute top-3/4 right-1/3 w-4 h-4 bg-accent/20 rounded-full floating-particle"></div>
        </div>
    </div>

    <div class="container mx-auto px-4 text-center relative z-10">
        <div class="mb-8 animate-fade-in-up">
            <span class="bg-gradient-to-r from-accent to-yellow-400 text-black px-6 py-3 rounded-full text-sm font-bold animate-pulse">
                Premium Men's Grooming
            </span>
        </div>
        
        <h2 class="text-4xl md:text-7xl font-bold mb-8 leading-tight animate-fade-in-up animation-delay-200">
            Transformasi Gaya Rambut<br>
            <span class="bg-gradient-to-r from-accent via-yellow-400 to-accent bg-clip-text text-transparent animate-shimmer">
                Anda Dimulai di Sini
            </span>
        </h2>
        
        <p class="text-xl md:text-2xl mb-12 opacity-90 max-w-4xl mx-auto leading-relaxed animate-fade-in-up animation-delay-400">
            Pangling Hairstudio menghadirkan pengalaman premium barbershop dengan booking online yang mudah dan cepat. 
            <span class="text-accent font-semibold">Wujudkan gaya impian Anda bersama kami!</span>
        </p>

        <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16 animate-fade-in-up animation-delay-600">
            <button data-navigate="booking" class="group relative bg-accent text-black px-10 py-5 rounded-xl font-bold text-lg hover:bg-yellow-400 transition-all transform hover:scale-105 min-w-[220px] pulse-accent">
                <span class="relative z-10">Book Sekarang</span>
                <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-accent rounded-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </button>
            <button data-navigate="services" class="group relative border-2 border-accent text-accent px-10 py-5 rounded-xl font-bold text-lg hover:bg-accent hover:text-black transition-all min-w-[220px] overflow-hidden">
                <span class="relative z-10">Lihat Layanan</span>
                <div class="absolute inset-0 bg-accent transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300"></div>
            </button>
        </div>

        <!-- Enhanced Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16 animate-fade-in-up animation-delay-800">
            <div class="text-center group">
                <div class="text-3xl md:text-4xl font-bold text-accent mb-2 group-hover:scale-110 transition-transform">500+</div>
                <div class="text-sm text-gray-400 group-hover:text-white transition-colors">Pelanggan Puas</div>
            </div>
            <div class="text-center group">
                <div class="text-3xl md:text-4xl font-bold text-accent mb-2 group-hover:scale-110 transition-transform">4.9</div>
                <div class="text-sm text-gray-400 group-hover:text-white transition-colors">Rating Bintang</div>
            </div>
            <div class="text-center group">
                <div class="text-3xl md:text-4xl font-bold text-accent mb-2 group-hover:scale-110 transition-transform">6</div>
                <div class="text-sm text-gray-400 group-hover:text-white transition-colors">Kapster Ahli</div>
            </div>
            <div class="text-center group">
                <div class="text-3xl md:text-4xl font-bold text-accent mb-2 group-hover:scale-110 transition-transform">3+</div>
                <div class="text-sm text-gray-400 group-hover:text-white transition-colors">Tahun Pengalaman</div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="flex justify-center animate-fade-in-up animation-delay-1000">
            <div class="w-6 h-10 border-2 border-accent/50 rounded-full flex justify-center group hover:border-accent transition-colors">
                <div class="w-1 h-3 bg-accent/70 rounded-full mt-2 animate-bounce group-hover:bg-accent"></div>
            </div>
        </div>
    </div>
</section>

<!-- Footer Section -->
<footer class="bg-gray-900 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Brand Section -->
            <div>
                <div class="flex items-center mb-6">
                    <div class="w-8 h-8 bg-accent rounded flex items-center justify-center mr-3">
                        <span class="text-black font-bold text-sm">P</span>
                    </div>
                    <span class="text-xl font-bold">Pangling Hairstudio</span>
                </div>
                <p class="text-gray-400 mb-6 leading-relaxed">
                    Premium barbershop untuk pria modern
                </p>
            </div>

            <!-- Navigation -->
            <div>
                <h3 class="text-lg font-bold mb-6">Navigasi</h3>
                <ul class="space-y-3">
                    <li><a href="#" data-navigate="home" class="text-gray-400 hover:text-accent transition-colors">Home</a></li>
                    <li><a href="#" data-navigate="services" class="text-gray-400 hover:text-accent transition-colors">Layanan</a></li>
                    <li><a href="#" data-navigate="barbers" class="text-gray-400 hover:text-accent transition-colors">Kapster</a></li>
                    <li><a href="#" data-navigate="booking" class="text-gray-400 hover:text-accent transition-colors">Booking</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-lg font-bold mb-6">Kontak</h3>
                <div class="space-y-3 text-gray-400">
                    <p>Email: info@panglinghairstudio.com</p>
                    <p>Telepon: +62 812 3456 7890</p>
                    <p>Alamat: Jl. Premium No. 123, Jakarta</p>
                </div>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-12 pt-8 text-center">
            <p class="text-gray-400">
                © {{ date('Y') }} <span class="text-accent font-semibold">Pangling Hairstudio</span>. All rights reserved.
            </p>
        </div>
    </div>
</footer>

<!-- AOS Animation Library -->
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        easing: 'ease-in-out',
        once: true,
        mirror: false
    });
</script>