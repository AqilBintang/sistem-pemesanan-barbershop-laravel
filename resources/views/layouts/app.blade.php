<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pangling Barbershop')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --dark: #1c1c1c;
            --green: #28a745;
            --green-dark: #1e7e34;
            --green-light: #40c057;
            --light: #f8f9fa;
        }

        /* Navbar utama */
        .navbar {
            background-color: var(--dark) !important;
            border-bottom: 2px solid var(--green);
        }

        /* Branding */
        .navbar-brand span {
            color: var(--green);
            font-weight: 700;
            font-size: 1.2rem;
        }

        /* Link menu */
        .nav-link {
            color: var(--light) !important;
            font-weight: 500;
            transition: 0.3s;
            text-align: center;
        }

        /* Warna link saat hover atau aktif */
        .nav-link:hover,
        .nav-link.active {
            color: var(--green) !important;
            text-shadow: 0 0 6px rgba(40, 167, 69, 0.6);
        }

        /* Navbar text biasa */
        .navbar-text {
            color: var(--light);
            font-weight: 500;
        }

        /* Icon default */
        .bi-person-circle,
        .bi-box-arrow-in-right {
            color: var(--light) !important;
            transition: 0.3s;
        }

        /* Icon saat link di hover */
        .nav-link:hover .bi-person-circle,
        .nav-link:hover .bi-box-arrow-in-right {
            color: var(--green) !important;
            text-shadow: 0 0 8px rgba(40, 167, 69, 0.7);
        }

        /* Icon saat link aktif */
        .nav-link.active .bi-person-circle,
        .nav-link.active .bi-box-arrow-in-right {
            color: var(--green) !important;
            text-shadow: 0 0 8px rgba(40, 167, 69, 0.7);
        }

        /* Navbar toggler (mobile) */
        .navbar-toggler {
            border-color: var(--green);
        }

        .navbar-toggler-icon {
            background-image: none;
            position: relative;
        }

        .navbar-toggler-icon::before {
            content: "\2630";
            color: var(--green);
            font-size: 1.5rem;
        }

        /* Header styles */
        .hero-section {
            background: linear-gradient(135deg, var(--green-dark) 0%, var(--green) 100%);
            color: white;
            padding: 80px 0;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .hero-subtitle {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .btn-custom {
            background-color: var(--light);
            color: var(--green-dark);
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 25px;
            transition: all 0.3s;
        }

        .btn-custom:hover {
            background-color: var(--green-light);
            color: white;
            transform: translateY(-2px);
        }

        /* Footer styles */
        .footer {
            background-color: var(--dark);
            border-top: 2px solid var(--green);
        }

        .text-green {
            color: var(--green) !important;
        }

        /* Center navbar text */
        .navbar-nav .nav-link {
            text-align: center;
        }

        /* Body padding for fixed navbar */
        body {
            padding-top: 0;
            overflow-x: hidden;
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Ensure sections don't overlap with fixed navbar */
        .hero-section {
            margin-top: 0;
        }

        /* Add padding to other sections */
        section:not(.hero-section) {
            scroll-margin-top: 80px;
        }

        /* Services section */
        .services-section {
            padding: 60px 0;
        }

        .service-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .service-card:hover {
            transform: translateY(-5px);
        }

        .service-icon {
            font-size: 3rem;
            color: var(--green);
            margin-bottom: 1rem;
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm fixed-top">
        <div class="container">
            <!-- Logo dan nama Quba -->
            <a class="navbar-brand fw-bold d-flex align-items-center" href="/">
                <img src="{{ asset('image/logoo.png') }}" alt="Logo" class="me-2" style="width:55px; height:55px;" onerror="this.style.display='none'">
                <span>Pangling Barbershop</span>
            </a>

            <!-- Toggle menu mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUser"
                aria-controls="navbarUser" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menu utama -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarUser">
                <ul class="navbar-nav mb-2 mb-lg-0 text-center align-items-center">
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Dashboard</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ request()->is('layanan*') ? 'active' : '' }}" href="/layanan">Layanan</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ request()->is('booking*') ? 'active' : '' }}" href="/booking">Pesanan</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link {{ request()->is('history*') ? 'active' : '' }}" href="/history">History</a>
                    </li>
                </ul>
            </div>

            <!-- Area kanan (profil / login) -->
            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <li class="nav-item me-3">
                    <span class="navbar-text">Halo, User 👋</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center {{ request()->is('profile*') ? 'active' : '' }}" href="/profile">
                        <i class="bi bi-person-circle fs-4"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer text-white text-center py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="text-green">Pangling Barbershop</h5>
                    <p class="small mb-0">Tempat terbaik untuk perawatan rambut dan jenggot Anda</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="text-green">Kontak</h6>
                    <p class="small mb-1"><i class="bi bi-telephone"></i> +62 123 456 789</p>
                    <p class="small mb-0"><i class="bi bi-envelope"></i> info@Panglingbarbershop.com</p>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="text-green">Jam Operasional</h6>
                    <p class="small mb-1">Senin - Sabtu: 09:00 - 21:00</p>
                    <p class="small mb-0">Minggu: 10:00 - 18:00</p>
                </div>
            </div>
            <hr class="my-3" style="border-color: var(--green);">
            <p class="mb-0 small">© {{ date('Y') }} <span class="text-green fw-bold">Pangling Barbershop</span>. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
            once: true,
            mirror: false
        });
    </script>
    @stack('scripts')
</body>
</html>