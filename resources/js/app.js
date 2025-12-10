import './bootstrap';

// Barbershop App Navigation System
class BarbershopApp {
    constructor() {
        this.currentPage = 'home';
        this.selectedService = '';
        this.selectedBarber = '';
        this.init();
    }

    init() {
        this.setupNavigation();
        this.setupQuickNavigation();
        this.setupScrollAnimations();
        this.showPage(this.currentPage);
    }

    setupNavigation() {
        // Setup main navigation
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-navigate]')) {
                e.preventDefault();
                const page = e.target.getAttribute('data-navigate');
                this.navigateTo(page);
            }
        });

        // Setup service selection
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-select-service]')) {
                e.preventDefault();
                const serviceId = e.target.getAttribute('data-select-service');
                this.selectService(serviceId);
            }
        });

        // Setup barber selection
        document.addEventListener('click', (e) => {
            if (e.target.matches('[data-select-barber]')) {
                e.preventDefault();
                const barberId = e.target.getAttribute('data-select-barber');
                this.selectBarber(barberId);
            }
        });
    }

    setupQuickNavigation() {
        // Create quick navigation if it doesn't exist
        if (!document.getElementById('quick-nav')) {
            this.createQuickNavigation();
        }
    }

    createQuickNavigation() {
        const quickNav = document.createElement('div');
        quickNav.id = 'quick-nav';
        quickNav.className = 'quick-nav-container';
        quickNav.innerHTML = `
            <div class="quick-nav-toggle" id="quick-nav-toggle">
                <span class="text-accent text-xl">⚡</span>
            </div>
            <div class="quick-nav-menu" id="quick-nav-menu">
                <p class="text-white text-sm mb-3 font-semibold">Quick Navigation</p>
                <button data-navigate="home" class="nav-btn quick-nav-item">
                    <span>🏠</span> Home
                </button>
                <button data-navigate="services" class="nav-btn quick-nav-item">
                    <span>✂️</span> Services
                </button>
                <button data-navigate="barbers" class="nav-btn quick-nav-item">
                    <span>👨‍💼</span> Barbers
                </button>
                <button data-navigate="booking" class="nav-btn quick-nav-item">
                    <span>📅</span> Booking
                </button>
                <button data-navigate="confirmation" class="nav-btn quick-nav-item">
                    <span>✅</span> Confirmation
                </button>
                <button data-navigate="notifications" class="nav-btn quick-nav-item">
                    <span>🔔</span> Notifications
                </button>
                <button data-navigate="admin" class="nav-btn quick-nav-item">
                    <span>🎛️</span> Admin
                </button>
            </div>
        `;
        document.body.appendChild(quickNav);

        // Setup toggle functionality
        const toggle = document.getElementById('quick-nav-toggle');
        const menu = document.getElementById('quick-nav-menu');
        let isOpen = false;

        toggle.addEventListener('click', () => {
            isOpen = !isOpen;
            if (isOpen) {
                menu.classList.add('show');
                toggle.innerHTML = '<span class="text-accent text-xl">✕</span>';
            } else {
                menu.classList.remove('show');
                toggle.innerHTML = '<span class="text-accent text-xl">⚡</span>';
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!quickNav.contains(e.target) && isOpen) {
                isOpen = false;
                menu.classList.remove('show');
                toggle.innerHTML = '<span class="text-accent text-xl">⚡</span>';
            }
        });
    }

    navigateTo(page) {
        this.currentPage = page;
        this.showPage(page);
        this.updateQuickNavigation();
        
        // Smooth scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
        
        // Update URL without page reload
        history.pushState({ page }, '', `/${page === 'home' ? '' : page}`);
    }

    selectService(serviceId) {
        this.selectedService = serviceId;
        console.log('Selected service:', serviceId);
    }

    selectBarber(barberId) {
        this.selectedBarber = barberId;
        console.log('Selected barber:', barberId);
    }

    showPage(page) {
        // Hide all pages
        document.querySelectorAll('[data-page]').forEach(el => {
            el.style.display = 'none';
        });

        // Show current page
        const currentPageEl = document.querySelector(`[data-page="${page}"]`);
        if (currentPageEl) {
            currentPageEl.style.display = 'block';
        }

        // Update navbar active state
        document.querySelectorAll('[data-nav-item]').forEach(el => {
            el.classList.remove('active');
        });
        
        const activeNavItem = document.querySelector(`[data-nav-item="${page}"]`);
        if (activeNavItem) {
            activeNavItem.classList.add('active');
        }
    }

    updateQuickNavigation() {
        document.querySelectorAll('#quick-nav .nav-btn').forEach(btn => {
            const page = btn.getAttribute('data-navigate');
            if (page === this.currentPage) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
    }

    setupScrollAnimations() {
        // Add scroll animation class to elements
        const animateElements = document.querySelectorAll('.scroll-animate');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        animateElements.forEach(el => observer.observe(el));

        // Add scroll animation classes to sections
        setTimeout(() => {
            document.querySelectorAll('section:not(:first-child)').forEach(section => {
                section.classList.add('scroll-animate');
                observer.observe(section);
            });
        }, 100);

        // Parallax effect for hero background elements
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const parallaxElements = document.querySelectorAll('.parallax-element');
            
            parallaxElements.forEach((element, index) => {
                const speed = 0.5 + (index * 0.1);
                const yPos = -(scrolled * speed);
                element.style.transform = `translateY(${yPos}px)`;
            });
        });
    }
}

// Initialize app when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    if (!window.barbershopApp) {
        window.barbershopApp = new BarbershopApp();
    }
});

// Handle browser back/forward buttons
window.addEventListener('popstate', (e) => {
    if (e.state && e.state.page && window.barbershopApp) {
        window.barbershopApp.navigateTo(e.state.page);
    }
});