<nav class="bg-black shadow-lg fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" data-navigate="home" class="flex items-center space-x-3 navbar-logo-container">
                    <img src="{{ asset('images/logo-sisbar.png') }}" alt="Sisbar Hairstudio" class="h-10 w-auto object-contain filter brightness-0 invert" 
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <span class="text-accent font-bold text-lg hidden">Sisbar Hairstudio</span>
                    <span class="text-white font-bold text-lg hover:text-accent transition-colors duration-300 ml-3">Sisbar Hairstudio</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:block">
                <div class="flex items-center space-x-8">
                    <a href="#" data-navigate="home" data-nav-item="home" 
                       class="nav-link text-white hover:text-accent transition-colors font-medium">
                        Home
                    </a>
                    <a href="#" data-navigate="services" data-nav-item="services"
                       class="nav-link text-white hover:text-accent transition-colors font-medium">
                        Layanan
                    </a>
                    <a href="#" data-navigate="barbers" data-nav-item="barbers"
                       class="nav-link text-white hover:text-accent transition-colors font-medium">
                        Kapster
                    </a>
                    <a href="#" data-navigate="booking" data-nav-item="booking"
                       class="nav-link text-white hover:text-accent transition-colors font-medium">
                        Booking
                    </a>
                </div>
            </div>

            <!-- Book Now Button & Profile -->
            <div class="hidden md:flex items-center space-x-4">
                <button data-navigate="booking" class="bg-accent text-black px-6 py-2 rounded-lg font-semibold hover:bg-yellow-400 transition-colors">
                    Book Now
                </button>
                
                <!-- Profile Icon -->
                <div class="relative group">
                    <div class="cursor-pointer hover:scale-110 transition-transform duration-200 profile-icon">
                        <!-- Simple User Icon -->
                        <svg class="w-7 h-7 text-accent hover:text-yellow-400 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    
                    <!-- Profile Dropdown -->
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-200 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="py-2">
                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-900">Halo, User!</p>
                                <p class="text-xs text-gray-500">user@example.com</p>
                            </div>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Profil Saya
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Riwayat Booking
                            </a>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Pengaturan
                            </a>
                            <div class="border-t border-gray-100 mt-2">
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden">
                <button type="button" id="mobile-menu-button" class="text-white hover:text-accent focus:outline-none focus:text-accent">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div id="mobile-menu" class="md:hidden hidden">
        <div class="px-4 pt-2 pb-3 space-y-1 bg-black border-t border-gray-800">
            <a href="#" data-navigate="home" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Home</a>
            <a href="#" data-navigate="services" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Layanan</a>
            <a href="#" data-navigate="barbers" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Kapster</a>
            <a href="#" data-navigate="booking" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Booking</a>
            <a href="#" data-navigate="notifications" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Notifikasi</a>
            <a href="#" data-navigate="admin" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Admin</a>
            
            <!-- Mobile Profile Section -->
            <div class="border-t border-gray-700 pt-4 mt-4">
                <div class="flex items-center px-3 py-2">
                    <div class="mr-3">
                        <!-- Simple User Icon for Mobile -->
                        <svg class="w-6 h-6 text-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-white text-sm font-medium">Halo, User!</p>
                        <p class="text-gray-400 text-xs">user@example.com</p>
                    </div>
                </div>
                <a href="#" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Profil Saya</a>
                <a href="#" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Riwayat Booking</a>
                <a href="#" class="text-red-400 hover:text-red-300 block px-3 py-2 rounded-md text-base font-medium">Logout</a>
            </div>
            
            <div class="pt-4">
                <button data-navigate="booking" class="w-full bg-accent text-black px-4 py-2 rounded-lg font-semibold hover:bg-yellow-400 transition-colors">
                    Book Now
                </button>
            </div>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
});
</script>