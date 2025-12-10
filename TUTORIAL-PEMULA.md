# 🎓 Tutorial Lengkap untuk Tim Pemula - Pangling Barbershop

## 📚 Daftar Isi
1. [Persiapan Awal](#persiapan-awal)
2. [Download & Setup Project](#download--setup-project)
3. [Memahami Struktur Project](#memahami-struktur-project)
4. [Cara Menjalankan Website](#cara-menjalankan-website)
5. [Cara Edit Code](#cara-edit-code)
6. [Cara Upload Perubahan](#cara-upload-perubahan)
7. [Tips & Troubleshooting](#tips--troubleshooting)

---

## 🛠️ Persiapan Awal

### 1. Install Software yang Dibutuhkan

#### A. Install Git
1. Download Git dari: https://git-scm.com/download/win
2. Install dengan setting default (next, next, finish)
3. Buka Command Prompt, ketik: `git --version`
4. Jika muncul versi Git, berarti berhasil

#### B. Install PHP & Composer
1. Download XAMPP dari: https://www.apachefriends.org/
2. Install XAMPP (pilih Apache, MySQL, PHP)
3. Download Composer dari: https://getcomposer.org/download/
4. Install Composer
5. Test di Command Prompt: `php --version` dan `composer --version`

#### C. Install Node.js
1. Download dari: https://nodejs.org/ (pilih LTS)
2. Install dengan setting default
3. Test di Command Prompt: `node --version` dan `npm --version`

#### D. Install Code Editor
**Pilihan 1: Visual Studio Code (Recommended)**
1. Download dari: https://code.visualstudio.com/
2. Install extension yang berguna:
   - PHP Intelephense
   - Laravel Blade Snippets
   - GitLens
   - Prettier

**Pilihan 2: PHPStorm (Berbayar tapi powerful)**

---

## 📥 Download & Setup Project

### 1. Clone Repository (Download Project)

```bash
# Buka Command Prompt atau Terminal
# Pindah ke folder tempat mau simpan project
cd C:\xampp\htdocs

# Download project dari GitHub
git clone https://github.com/AqilBintang/sistem-pemesanan-barbershop-laravel.git

# Masuk ke folder project
cd sistem-pemesanan-barbershop-laravel
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies  
npm install

# Copy file environment
copy .env.example .env

# Generate application key
php artisan key:generate
```

### 3. Setup Database

#### A. Buka XAMPP Control Panel
1. Start Apache
2. Start MySQL
3. Klik "Admin" di MySQL (akan buka phpMyAdmin)

#### B. Buat Database
1. Di phpMyAdmin, klik "New" 
2. Nama database: `pangling_barbershop`
3. Klik "Create"

#### C. Edit File .env
1. Buka file `.env` dengan text editor
2. Ubah bagian database:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pangling_barbershop
DB_USERNAME=root
DB_PASSWORD=
```

#### D. Jalankan Migration
```bash
php artisan migrate
```

---

## 📁 Memahami Struktur Project

```
sistem-pemesanan-barbershop-laravel/
├── app/                          # Logic aplikasi
│   ├── Http/Controllers/         # File yang mengatur halaman
│   └── Models/                   # File yang mengatur database
├── resources/                    # File tampilan
│   ├── views/                    # File HTML/Blade
│   │   ├── layouts/              # Template utama
│   │   └── users/                # Halaman user
│   ├── css/                      # File CSS
│   └── js/                       # File JavaScript
├── routes/                       # Pengaturan URL
│   └── web.php                   # Daftar halaman website
├── public/                       # File yang bisa diakses browser
│   ├── images/                   # Gambar-gambar
│   ├── css/                      # CSS yang sudah di-compile
│   └── js/                       # JS yang sudah di-compile
├── database/                     # Pengaturan database
│   └── migrations/               # Struktur tabel database
└── .env                          # Pengaturan environment
```

### File Penting untuk Diedit:

#### 🎨 **Tampilan (Views)**
- `resources/views/layouts/app.blade.php` - Template utama (navbar, footer)
- `resources/views/users/dashboard.blade.php` - Halaman utama
- `resources/views/users/layanan.blade.php` - Halaman layanan
- `resources/views/users/booking.blade.php` - Halaman booking
- `resources/views/users/history.blade.php` - Halaman history
- `resources/views/users/profile.blade.php` - Halaman profil

#### 🔧 **Logic (Controllers)**
- `app/Http/Controllers/` - (belum ada, nanti dibuat)

#### 🛣️ **Routes (URL)**
- `routes/web.php` - Daftar halaman dan URL

---

## 🚀 Cara Menjalankan Website

### 1. Start Development Server

```bash
# Buka Command Prompt di folder project
cd C:\xampp\htdocs\sistem-pemesanan-barbershop-laravel

# Jalankan server Laravel
php artisan serve
```

### 2. Buka Browser
- Ketik: `http://localhost:8000`
- Website akan muncul!

### 3. Jika Ada Error
- Pastikan XAMPP Apache & MySQL sudah running
- Pastikan sudah `composer install` dan `npm install`
- Pastikan file `.env` sudah benar

---

## ✏️ Cara Edit Code

### 1. Buka Project di Code Editor
1. Buka Visual Studio Code
2. File → Open Folder
3. Pilih folder `sistem-pemesanan-barbershop-laravel`

### 2. Contoh Edit Sederhana

#### A. Mengubah Teks di Halaman Utama
1. Buka file: `resources/views/users/dashboard.blade.php`
2. Cari baris: `<h1 class="hero-title text-white">Selamat Datang di Pangling Barbershop</h1>`
3. Ubah teks sesuai keinginan
4. Save file (Ctrl+S)
5. Refresh browser untuk lihat perubahan

#### B. Mengubah Warna
1. Buka file: `resources/views/layouts/app.blade.php`
2. Cari bagian CSS:
```css
:root {
    --dark: #1c1c1c;
    --green: #28a745;        /* Ubah ini untuk warna utama */
    --green-dark: #1e7e34;
    --green-light: #40c057;
    --light: #f8f9fa;
}
```
3. Ubah kode warna (contoh: `#28a745` jadi `#ff6b6b` untuk merah)

#### C. Menambah Halaman Baru
1. Buat file baru: `resources/views/users/tentang.blade.php`
2. Copy isi dari file lain, lalu edit
3. Tambah route di `routes/web.php`:
```php
Route::get('/tentang', function () {
    return view('users.tentang');
});
```
4. Tambah link di navbar (`resources/views/layouts/app.blade.php`)

### 3. File yang Sering Diedit

#### 📝 **Untuk Mengubah Tampilan:**
- Header/Navbar: `resources/views/layouts/app.blade.php` (baris 190-240)
- Footer: `resources/views/layouts/app.blade.php` (baris 242-262)
- Halaman Utama: `resources/views/users/dashboard.blade.php`
- Warna & Style: Bagian `<style>` di setiap file

#### 🔗 **Untuk Menambah Halaman:**
- Buat file view baru di `resources/views/users/`
- Tambah route di `routes/web.php`
- Tambah link di navbar

---

## 📤 Cara Upload Perubahan

### 1. Cek Perubahan yang Dibuat
```bash
# Lihat file apa saja yang berubah
git status
```

### 2. Siapkan Perubahan untuk Upload
```bash
# Tambahkan semua perubahan
git add .

# Atau tambah file tertentu saja
git add resources/views/users/dashboard.blade.php
```

### 3. Buat Commit (Simpan Perubahan)
```bash
# Commit dengan pesan yang jelas
git commit -m "Ubah teks di halaman utama"

# Contoh pesan commit yang baik:
git commit -m "Tambah halaman tentang kami"
git commit -m "Ubah warna tema dari hijau ke biru"
git commit -m "Perbaiki tampilan di mobile"
```

### 4. Upload ke GitHub
```bash
# Upload ke branch utama (hati-hati!)
git push origin main

# Atau buat branch baru (lebih aman)
git checkout -b feature/perubahan-saya
git push origin feature/perubahan-saya
```

### 5. Buat Pull Request (Jika Pakai Branch)
1. Buka GitHub repository
2. Klik "Compare & pull request"
3. Tulis deskripsi perubahan
4. Klik "Create pull request"
5. Tunggu review dari team lead

---

## 🎯 Workflow Aman untuk Pemula

### 1. Sebelum Mulai Coding
```bash
# Selalu update dulu
git checkout main
git pull origin main

# Buat branch baru untuk perubahan
git checkout -b feature/nama-perubahan
```

### 2. Setelah Selesai Coding
```bash
# Cek perubahan
git status

# Tambah perubahan
git add .

# Commit
git commit -m "Deskripsi perubahan"

# Upload
git push origin feature/nama-perubahan
```

### 3. Minta Review
- Buat Pull Request di GitHub
- Tag team lead untuk review
- Tunggu approval sebelum merge

---

## 🆘 Tips & Troubleshooting

### ❌ Error yang Sering Terjadi

#### 1. "php artisan serve" tidak jalan
**Solusi:**
- Pastikan PHP sudah terinstall
- Pastikan sudah di folder project yang benar
- Coba: `php -v` untuk cek PHP

#### 2. Website tidak muncul gambar
**Solusi:**
- Pastikan file gambar ada di folder `public/images/`
- Cek nama file gambar (case sensitive)
- Pastikan server Laravel jalan

#### 3. Error "Class not found"
**Solusi:**
```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

#### 4. Database error
**Solusi:**
- Pastikan XAMPP MySQL jalan
- Cek setting `.env` file
- Pastikan database sudah dibuat

### ✅ Tips Sukses

#### 1. **Selalu Backup**
- Commit perubahan secara berkala
- Jangan edit langsung di branch main

#### 2. **Test Sebelum Upload**
- Jalankan `php artisan serve`
- Cek semua halaman masih jalan
- Test di mobile dan desktop

#### 3. **Komunikasi Tim**
- Kasih tau kalau mau edit file tertentu
- Koordinasi lewat WhatsApp group
- Jangan edit file yang sama bersamaan

#### 4. **Belajar Bertahap**
- Mulai dari edit teks sederhana
- Lalu coba ubah warna
- Baru tambah fitur kompleks

### 📱 Kontak Bantuan
- **Team Lead**: @AqilBintang
- **WhatsApp Group**: [Link Group]
- **GitHub Issues**: Untuk bug report

---

## 🎓 Tugas Pertama untuk Tim

### Level 1: Pemula Banget
1. **Setup project** - Ikuti tutorial di atas sampai website jalan
2. **Edit teks** - Ubah nama "Pangling" jadi nama lain di halaman utama
3. **Ganti warna** - Ubah warna hijau jadi warna favorit kalian

### Level 2: Sudah Bisa Dasar
1. **Tambah halaman** - Buat halaman "Tentang Kami"
2. **Edit layanan** - Tambah layanan baru di halaman layanan
3. **Ubah footer** - Ganti info kontak di footer

### Level 3: Siap Coding
1. **Buat controller** - Buat controller untuk handle form
2. **Database** - Buat tabel baru untuk menyimpan data
3. **Fitur baru** - Tambah fitur login sederhana

**Ingat: Mulai dari Level 1 dulu, jangan langsung loncat ke Level 3!**

---

*Happy Coding! 🚀*