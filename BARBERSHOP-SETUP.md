# Panduan Setup Barbershop App

## Deskripsi
Aplikasi barbershop ini adalah adaptasi dari kode React yang Anda berikan ke dalam proyek Laravel dengan menggunakan Tailwind CSS dan JavaScript vanilla. Aplikasi ini menggunakan konsep Single Page Application (SPA) dengan navigasi JavaScript.

## Fitur yang Diimplementasikan

### 1. **Landing Page** (`/barbershop` atau `/`)
- Hero section dengan call-to-action
- Preview layanan unggulan
- Informasi mengapa memilih barbershop
- Section CTA untuk booking

### 2. **Service List Page** (`/services`)
- Grid layanan dengan detail harga dan durasi
- Kategori layanan (Basic, Premium, Paket Lengkap, dll.)
- Informasi tambahan (jam operasional, metode pembayaran)

### 3. **Barber Profile Page** (`/barbers`)
- Profil barber dengan rating dan keahlian
- Jadwal ketersediaan barber
- Spesialisasi masing-masing barber

### 4. **Booking Page** (`/booking`)
- Form booking lengkap dengan validasi
- Pilihan layanan dan barber
- Pemilihan tanggal dan waktu
- Metode pembayaran

### 5. **Confirmation Page** (`/confirmation`)
- Detail booking yang telah dibuat
- Informasi langkah selanjutnya
- Kontak untuk bantuan

### 6. **Notifications** (`/notifications`)
- Sistem notifikasi dengan filter
- Pengaturan preferensi notifikasi
- Berbagai jenis notifikasi (booking, reminder, promo)

### 7. **Admin Dashboard** (`/admin`)
- Dashboard admin dengan statistik
- Manajemen booking harian
- Status barber
- Laporan pendapatan

## Struktur File

```
resources/
├── css/
│   └── app.css                 # Tailwind CSS dengan custom variables
├── js/
│   ├── app.js                  # JavaScript utama untuk navigasi SPA
│   └── bootstrap.js            # Axios setup
└── views/
    ├── layouts/
    │   └── barbershop.blade.php # Layout utama
    ├── components/
    │   ├── navbar.blade.php
    │   ├── landing-page.blade.php
    │   ├── service-list.blade.php
    │   ├── barber-profile.blade.php
    │   ├── booking-page.blade.php
    │   ├── confirmation-page.blade.php
    │   ├── notification-template.blade.php
    │   └── admin-dashboard.blade.php
    └── barbershop/
        └── index.blade.php      # View utama SPA
```

## Cara Menggunakan

### 1. **Instalasi Dependencies**
```bash
npm install
npm run dev
```

### 2. **Akses Aplikasi**
- Buka browser dan akses: `http://localhost:8000/barbershop`
- Atau gunakan route lain: `/services`, `/barbers`, `/booking`, dll.

### 3. **Navigasi**
- Gunakan navbar untuk navigasi antar halaman
- Quick navigation di pojok kanan bawah untuk demo
- Semua navigasi menggunakan JavaScript tanpa reload halaman

### 4. **Fitur Booking**
1. Pilih layanan di halaman Services
2. Pilih barber di halaman Barbers  
3. Isi form booking di halaman Booking
4. Lihat konfirmasi di halaman Confirmation

## Kustomisasi

### 1. **Warna dan Tema**
Edit file `resources/css/app.css` untuk mengubah:
- `--accent`: Warna aksen utama (default: #D4AF37 - emas)
- `--background`: Warna background
- `--foreground`: Warna teks

### 2. **Data Layanan dan Barber**
Edit komponen terkait untuk mengubah:
- `service-list.blade.php`: Data layanan dan harga
- `barber-profile.blade.php`: Data barber dan keahlian

### 3. **Navigasi**
Edit `resources/js/app.js` untuk menambah/mengubah halaman:
- Tambah case baru di method `showPage()`
- Update navbar di `navbar.blade.php`

## Integrasi dengan Backend

### 1. **Form Booking**
Saat ini form booking menyimpan data di localStorage. Untuk integrasi dengan database:

```javascript
// Di booking-page.blade.php, ubah form submission:
form.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(form);
    
    try {
        const response = await axios.post('/api/bookings', formData);
        // Handle success
        localStorage.setItem('bookingData', JSON.stringify(response.data));
        window.barbershopApp.navigateTo('confirmation');
    } catch (error) {
        // Handle error
        console.error('Booking failed:', error);
    }
});
```

### 2. **API Routes**
Tambahkan di `routes/api.php`:
```php
Route::post('/bookings', [BookingController::class, 'store']);
Route::get('/services', [ServiceController::class, 'index']);
Route::get('/barbers', [BarberController::class, 'index']);
```

### 3. **Database Models**
Buat model untuk:
- `Booking`: Menyimpan data booking
- `Service`: Data layanan
- `Barber`: Data barber
- `Customer`: Data pelanggan

## Fitur Tambahan yang Bisa Dikembangkan

1. **Authentication**: Login/register pelanggan
2. **Payment Gateway**: Integrasi pembayaran online
3. **Real-time Notifications**: WebSocket untuk notifikasi real-time
4. **Calendar Integration**: Sinkronisasi dengan Google Calendar
5. **Review System**: Sistem rating dan review pelanggan
6. **Inventory Management**: Manajemen produk dan stok
7. **Staff Management**: Manajemen jadwal dan gaji barber
8. **Analytics**: Dashboard analytics yang lebih detail

## Troubleshooting

### 1. **CSS tidak muncul**
```bash
npm run dev
# atau
npm run build
```

### 2. **JavaScript error**
- Pastikan semua file JavaScript sudah di-load
- Check console browser untuk error details

### 3. **Navigasi tidak bekerja**
- Pastikan `window.barbershopApp` sudah terinisialisasi
- Check apakah semua data-attribute sudah benar

## Dukungan Browser
- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+

## Lisensi
Aplikasi ini dibuat untuk keperluan pembelajaran dan dapat dimodifikasi sesuai kebutuhan.