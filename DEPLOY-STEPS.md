# 🚀 Langkah Deploy ke InfinityFree - Step by Step

## 📋 Checklist Persiapan

### ✅ **Step 1: Daftar InfinityFree**
1. Kunjungi: https://infinityfree.net
2. Klik "Create Account"
3. Isi form pendaftaran
4. Verifikasi email
5. Login ke control panel

### ✅ **Step 2: Buat Hosting Account**
1. Di dashboard InfinityFree, klik "Create Account"
2. Pilih subdomain gratis (contoh: sisbar-hairstudio.infinityfreeapp.com)
3. Tunggu aktivasi (biasanya 1-5 menit)
4. Catat URL website Anda

### ✅ **Step 3: Setup Database**
1. Di control panel, klik "MySQL Databases"
2. Klik "Create Database"
3. Buat database dengan nama: `sisbar_db`
4. Catat informasi database:
   - Database Name: `if0_xxxxxxxx_sisbar_db`
   - Username: `if0_xxxxxxxx`
   - Password: `[password yang Anda buat]`
   - Hostname: `sql200.infinityfree.com`

## 📁 **Step 4: Persiapan Files**

### A. Update .env File
1. Copy file `.env.infinityfree` ke `.env`
2. Update dengan informasi database Anda:
```env
APP_URL=https://your-actual-subdomain.infinityfreeapp.com
DB_DATABASE=if0_xxxxxxxx_sisbar_db
DB_USERNAME=if0_xxxxxxxx
DB_PASSWORD=your_actual_password
GOOGLE_REDIRECT_URL=https://your-actual-subdomain.infinityfreeapp.com/auth/google/callback
```

### B. Optimize Laravel
Jalankan di komputer Anda:
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm run build
```

## 📤 **Step 5: Upload Files**

### A. Struktur Upload
1. Buka "File Manager" di InfinityFree
2. Masuk ke folder `htdocs`
3. Upload SEMUA file Laravel KECUALI folder `public`
4. Upload ISI folder `public` langsung ke `htdocs`

### B. Struktur Akhir di Server:
```
htdocs/
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
├── .htaccess
├── migrate.php
├── optimize.php
├── index.php (dari folder public)
├── css/ (dari folder public)
├── js/ (dari folder public)
├── images/ (dari folder public)
└── build/ (dari folder public)
```

### C. Edit index.php
Di File Manager, edit `htdocs/index.php`:
```php
<?php
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Update paths untuk shared hosting
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Kernel::class);
$response = $kernel->handle(
    $request = Request::capture()
)->send();
$kernel->terminate($request, $response);
```

## 🔧 **Step 6: Set Permissions**
Di File Manager, klik kanan dan set permissions:
- `storage/` → 755 (recursive)
- `bootstrap/cache/` → 755 (recursive)

## 🗄️ **Step 7: Setup Database**
1. Akses: `https://your-subdomain.infinityfreeapp.com/migrate.php`
2. Tunggu sampai selesai (akan muncul pesan sukses)
3. **PENTING**: Hapus file `migrate.php` setelah selesai!

## ⚡ **Step 8: Optimize Website**
1. Akses: `https://your-subdomain.infinityfreeapp.com/optimize.php`
2. Tunggu sampai selesai
3. **PENTING**: Hapus file `optimize.php` setelah selesai!

## 🔐 **Step 9: Setup Google OAuth**
1. Buka Google Cloud Console: https://console.cloud.google.com
2. Pilih project Anda
3. Pergi ke "APIs & Services" → "Credentials"
4. Edit OAuth 2.0 Client
5. Tambahkan Authorized redirect URIs:
   ```
   https://your-subdomain.infinityfreeapp.com/auth/google/callback
   ```
6. Copy Client ID dan Client Secret
7. Update di File Manager, edit `.env`:
   ```env
   GOOGLE_CLIENT_ID=your_actual_client_id
   GOOGLE_CLIENT_SECRET=your_actual_client_secret
   ```

## ✅ **Step 10: Test Website**

### A. Test Halaman Utama
- Kunjungi: `https://your-subdomain.infinityfreeapp.com`
- Pastikan website loading dengan baik

### B. Test Admin Panel
- Kunjungi: `https://your-subdomain.infinityfreeapp.com/admin`
- Login dengan: `admin` / `admin123`
- Test semua fitur admin

### C. Test Booking System
- Kunjungi: `https://your-subdomain.infinityfreeapp.com/booking`
- Test login dengan Google
- Test buat booking

### D. Test Responsive Design
- Test di mobile dan desktop
- Pastikan semua fitur berfungsi

## 🚨 **Troubleshooting**

### Error 500 - Internal Server Error
1. Check file permissions (755 untuk folders)
2. Check .env configuration
3. Lihat error logs di InfinityFree control panel

### Database Connection Error
1. Pastikan database credentials benar di .env
2. Check database sudah dibuat di InfinityFree
3. Test koneksi database di phpMyAdmin

### Google OAuth Error
1. Pastikan redirect URL benar di Google Console
2. Check Client ID dan Secret di .env
3. Pastikan domain sudah verified

### Assets Not Loading (CSS/JS)
1. Pastikan file CSS/JS ada di htdocs
2. Check permissions file
3. Clear browser cache

## 🎉 **Selesai!**

Jika semua langkah berhasil, website Anda sekarang live di:
- **Website**: https://your-subdomain.infinityfreeapp.com
- **Admin**: https://your-subdomain.infinityfreeapp.com/admin
- **Booking**: https://your-subdomain.infinityfreeapp.com/booking

## 📞 **Butuh Bantuan?**
Jika ada error atau masalah, screenshot error message dan saya akan bantu troubleshoot!