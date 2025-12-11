<nav class="bg-black shadow-lg fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="/" data-navigate="home" class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-accent rounded flex items-center justify-center">
                        <span class="text-black font-bold text-sm">P</span>
                    </div>
                    <span class="text-white font-bold text-lg">Pangling Hairstudio</span>
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
                    <a href="#" data-navigate="gallery" data-nav-item="gallery"
                       class="nav-link text-white hover:text-accent transition-colors font-medium">
                        Gallery
                    </a>
                    <a href="#" data-navigate="booking" data-nav-item="booking"
                       class="nav-link text-white hover:text-accent transition-colors font-medium">
                        Booking
                    </a>
                </div>
            </div>

            <!-- Book Now Button -->
            <div class="hidden md:block">
                <button data-navigate="booking" class="bg-accent text-black px-6 py-2 rounded-lg font-semibold hover:bg-yellow-400 transition-colors">
                    Book Now
                </button>
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
            <a href="#" data-navigate="gallery" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Gallery</a>
            <a href="#" data-navigate="booking" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Booking</a>
            <a href="#" data-navigate="notifications" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Notifikasi</a>
            <a href="#" data-navigate="admin" class="text-white hover:text-accent block px-3 py-2 rounded-md text-base font-medium">Admin</a>
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