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
        // Quick navigation removed per user request
    }

    navigateTo(page) {
        this.currentPage = page;
        this.showPage(page);
        
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

        // Special observer for yellow stripe with different threshold
        const stripeObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate');
                }
            });
        }, {
            threshold: 0.3,
            rootMargin: '0px 0px -100px 0px'
        });

        // Observe yellow stripe elements
        setTimeout(() => {
            document.querySelectorAll('.yellow-stripe-scroll').forEach(stripe => {
                stripeObserver.observe(stripe);
            });
        }, 100);

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