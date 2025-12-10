# 📋 Pembagian Tugas Tim - Pangling Barbershop

## 👥 Anggota Tim & Tugas

### 🎯 **Developer A - Frontend Specialist**
**Fokus: Tampilan & User Experience**

#### 📝 Tugas Minggu 1:
1. **Edit Halaman Utama**
   - File: `resources/views/users/dashboard.blade.php`
   - Tugas: Ubah teks welcome message
   - Tugas: Tambah section "Testimoni Pelanggan"

2. **Perbaiki Responsive Design**
   - File: `resources/views/layouts/app.blade.php`
   - Tugas: Pastikan navbar bagus di mobile
   - Tugas: Test semua halaman di berbagai ukuran layar

#### 📂 File yang Akan Dikerjakan:
- `resources/views/users/dashboard.blade.php`
- `resources/views/layouts/app.blade.php` (bagian CSS)
- `public/css/` (jika perlu file CSS terpisah)

---

### 🎯 **Developer B - Content Manager**
**Fokus: Konten & Halaman Informasi**

#### 📝 Tugas Minggu 1:
1. **Lengkapi Halaman Layanan**
   - File: `resources/views/users/layanan.blade.php`
   - Tugas: Tambah deskripsi detail setiap layanan
   - Tugas: Tambah gambar untuk setiap layanan

2. **Buat Halaman Baru**
   - Buat: `resources/views/users/tentang.blade.php`
   - Buat: `resources/views/users/kontak.blade.php`
   - Update: `routes/web.php` untuk route baru

#### 📂 File yang Akan Dikerjakan:
- `resources/views/users/layanan.blade.php`
- `resources/views/users/tentang.blade.php` (baru)
- `resources/views/users/kontak.blade.php` (baru)
- `routes/web.php`

---

### 🎯 **Developer C - Form & Interaction**
**Fokus: Form Booking & User Interaction**

#### 📝 Tugas Minggu 1:
1. **Perbaiki Form Booking**
   - File: `resources/views/users/booking.blade.php`
   - Tugas: Tambah validasi JavaScript
   - Tugas: Buat form lebih user-friendly

2. **Buat Halaman Konfirmasi**
   - Buat: `resources/views/users/konfirmasi.blade.php`
   - Tugas: Halaman setelah submit booking
   - Update: `routes/web.php`

#### 📂 File yang Akan Dikerjakan:
- `resources/views/users/booking.blade.php`
- `resources/views/users/konfirmasi.blade.php` (baru)
- `routes/web.php`
- `public/js/` (untuk JavaScript)

---

### 🎯 **Developer D - Backend Preparation**
**Fokus: Persiapan Logic & Database**

#### 📝 Tugas Minggu 1:
1. **Buat Controller Dasar**
   - Buat: `app/Http/Controllers/BookingController.php`
   - Buat: `app/Http/Controllers/LayananController.php`
   - Tugas: Controller sederhana untuk handle halaman

2. **Persiapan Database**
   - Buat: `database/migrations/create_bookings_table.php`
   - Buat: `database/migrations/create_services_table.php`
   - Tugas: Struktur tabel untuk booking dan layanan

#### 📂 File yang Akan Dikerjakan:
- `app/Http/Controllers/BookingController.php` (baru)
- `app/Http/Controllers/LayananController.php` (baru)
- `database/migrations/` (file baru)
- `routes/web.php`

---

## 📚 Tutorial Spesifik per Tugas

### 🎨 **Untuk Developer A - Edit Tampilan**

#### 1. Mengubah Teks di Halaman Utama
```html
<!-- File: resources/views/users/dashboard.blade.php -->
<!-- Cari baris ini (sekitar baris 25): -->
<h1 class="hero-title text-white">Selamat Datang di Pangling Barbershop</h1>

<!-- Ubah jadi: -->
<h1 class="hero-title text-white">Selamat Datang di Pangling Barbershop - Tempat Terbaik untuk Gaya Rambut Anda</h1>
```

#### 2. Menambah Section Testimoni
```html
<!-- Tambahkan sebelum CTA Section di dashboard.blade.php -->
<!-- Testimoni Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold mb-3">Apa Kata Pelanggan Kami?</h2>
                <p class="text-muted">Testimoni dari pelanggan yang puas</p>
            </div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="mb-3">
                            <img src="{{ asset('images/customer1.jpg') }}" alt="Customer" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <h5 class="fw-bold">Budi Santoso</h5>
                        <p class="text-muted small">"Pelayanan sangat memuaskan, barbernya profesional dan hasilnya sesuai keinginan!"</p>
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tambah testimoni lainnya dengan pola yang sama -->
        </div>
    </div>
</section>
```

### 📝 **Untuk Developer B - Buat Halaman Baru**

#### 1. Buat Halaman Tentang Kami
```php
<!-- File baru: resources/views/users/tentang.blade.php -->
@extends('layouts.app')

@section('title', 'Tentang Kami - Pangling Barbershop')

@section('content')
<!-- Page Header -->
<section class="py-5 bg-success text-white">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="fw-bold mb-3">Tentang Kami</h1>
                <p class="lead">Mengenal lebih dekat Pangling Barbershop</p>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-right">
                <h2 class="fw-bold mb-4">Cerita Kami</h2>
                <p class="mb-4">
                    Pangling Barbershop didirikan pada tahun 2020 dengan visi menjadi tempat terbaik 
                    untuk perawatan rambut dan jenggot pria. Kami berkomitmen memberikan pelayanan 
                    berkualitas tinggi dengan harga yang terjangkau.
                </p>
                <p class="mb-4">
                    Dengan tim barber profesional yang berpengalaman lebih dari 5 tahun, kami siap 
                    memberikan gaya rambut yang sesuai dengan kepribadian dan bentuk wajah Anda.
                </p>
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <img src="{{ asset('images/about-us.jpg') }}" alt="About Us" class="img-fluid rounded shadow">
            </div>
        </div>
    </div>
</section>
@endsection
```

#### 2. Tambah Route di web.php
```php
<!-- File: routes/web.php -->
<!-- Tambahkan di akhir file: -->

Route::get('/tentang', function () {
    return view('users.tentang');
});

Route::get('/kontak', function () {
    return view('users.kontak');
});
```

#### 3. Tambah Link di Navbar
```html
<!-- File: resources/views/layouts/app.blade.php -->
<!-- Cari bagian menu navbar, tambahkan: -->
<li class="nav-item mx-2">
    <a class="nav-link {{ request()->is('tentang*') ? 'active' : '' }}" href="/tentang">Tentang</a>
</li>
<li class="nav-item mx-2">
    <a class="nav-link {{ request()->is('kontak*') ? 'active' : '' }}" href="/kontak">Kontak</a>
</li>
```

### 📋 **Untuk Developer C - Perbaiki Form**

#### 1. Tambah Validasi JavaScript
```html
<!-- File: resources/views/users/booking.blade.php -->
<!-- Tambahkan sebelum @endsection -->

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const submitBtn = document.querySelector('button[type="submit"]');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Validasi form
        const nama = document.getElementById('nama').value;
        const phone = document.getElementById('phone').value;
        const tanggal = document.getElementById('tanggal').value;
        const layanan = document.getElementById('layanan').value;
        
        if (!nama || !phone || !tanggal || !layanan) {
            alert('Mohon lengkapi semua field yang wajib diisi!');
            return;
        }
        
        // Jika validasi berhasil
        submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Memproses...';
        submitBtn.disabled = true;
        
        // Simulasi submit (nanti diganti dengan real submit)
        setTimeout(() => {
            alert('Booking berhasil! Kami akan menghubungi Anda segera.');
            form.reset();
            submitBtn.innerHTML = '<i class="bi bi-calendar-check me-2"></i>Konfirmasi Booking';
            submitBtn.disabled = false;
        }, 2000);
    });
});
</script>
@endpush
```

### 🔧 **Untuk Developer D - Buat Controller**

#### 1. Buat BookingController
```bash
# Jalankan command ini di terminal:
php artisan make:controller BookingController
```

```php
<?php
// File: app/Http/Controllers/BookingController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        return view('users.booking');
    }
    
    public function store(Request $request)
    {
        // Nanti diisi logic untuk simpan booking
        return redirect()->back()->with('success', 'Booking berhasil!');
    }
    
    public function history()
    {
        return view('users.history');
    }
}
```

#### 2. Update Routes
```php
<!-- File: routes/web.php -->
<!-- Ganti route lama dengan: -->

use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('users.dashboard');
});

Route::get('/layanan', function () {
    return view('users.layanan');
});

Route::get('/booking', [BookingController::class, 'index']);
Route::post('/booking', [BookingController::class, 'store']);
Route::get('/history', [BookingController::class, 'history']);

Route::get('/profile', function () {
    return view('users.profile');
});
```

---

## 📅 Timeline Pengerjaan

### **Minggu 1: Setup & Tugas Dasar**
- **Hari 1-2**: Setup project, baca tutorial
- **Hari 3-4**: Kerjakan tugas masing-masing
- **Hari 5**: Review & testing bersama
- **Hari 6-7**: Perbaikan & finalisasi

### **Minggu 2: Integrasi & Testing**
- **Hari 1-3**: Gabungkan semua perubahan
- **Hari 4-5**: Testing menyeluruh
- **Hari 6-7**: Bug fixing & polish

---

## 🚨 Aturan Penting

### ❌ **JANGAN:**
1. Edit file yang sama bersamaan
2. Push langsung ke branch main
3. Hapus code orang lain tanpa konfirmasi
4. Lupa commit & push perubahan

### ✅ **LAKUKAN:**
1. Koordinasi sebelum edit file
2. Selalu buat branch baru
3. Test sebelum push
4. Komunikasi di group WhatsApp

---

## 📞 **Kontak & Bantuan**

### 🆘 **Jika Stuck:**
1. Coba Google error messagenya
2. Tanya di group WhatsApp
3. Buat issue di GitHub
4. Contact team lead: @AqilBintang

### 📱 **Channel Komunikasi:**
- **Daily Update**: WhatsApp Group
- **Code Review**: GitHub Pull Request
- **Bug Report**: GitHub Issues
- **Meeting**: Zoom/Google Meet (Jumat sore)

---

**Semangat coding tim! 🚀**