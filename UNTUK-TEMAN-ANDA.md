# 👋 Halo! Panduan Khusus untuk Teman

## 🚨 LANGKAH PERTAMA (WAJIB DILAKUKAN)

### 1. Clone Repository
```bash
# Ganti USERNAME dan REPOSITORY-NAME dengan yang benar
git clone https://github.com/USERNAME/tecno-berbershop.git
cd tecno-berbershop
```

### 2. Install Dependencies
```bash
# Install PHP dependencies
composer install

# Install Node.js dependencies  
npm install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 3. Setup Git Identity
```bash
# Ganti dengan nama dan email Anda
git config user.name "Nama Lengkap Anda"
git config user.email "email@anda.com"
```

### 4. Pindah ke Branch Kerja
```bash
# Lihat semua branch
git branch -a

# Pindah ke branch kerja
git checkout sistem-pemesanan-barbershop-laravel

# Pastikan Anda di branch yang benar
git branch
```

---

## 🔄 WORKFLOW HARIAN ANDA

### Setiap Mulai Kerja (WAJIB):
```bash
# 1. Pull perubahan terbaru
git pull origin sistem-pemesanan-barbershop-laravel

# 2. Cek status
git status

# 3. Lihat perubahan terbaru (opsional)
git log --oneline -5
```

### Saat Bekerja:
```bash
# 1. Buat perubahan pada file
# Edit file sesuai tugas Anda

# 2. Cek apa yang berubah
git status
git diff

# 3. Add semua perubahan
git add .

# 4. Commit dengan pesan yang jelas
git commit -m "feat: Tambah sistem login dengan validasi"
```

### Setelah Selesai Kerja (WAJIB):
```bash
# 1. Pull dulu untuk cek perubahan terbaru
git pull origin sistem-pemesanan-barbershop-laravel

# 2. Jika tidak ada konflik, push
git push origin sistem-pemesanan-barbershop-laravel

# 3. Beritahu teman bahwa Anda sudah push
```

---

## 📝 CONTOH PESAN COMMIT YANG BAIK

```bash
# ✅ BAIK:
git commit -m "feat: Tambah halaman login dengan form validation"
git commit -m "fix: Perbaiki bug pada sistem booking"
git commit -m "style: Update tampilan navbar responsive"
git commit -m "docs: Tambah dokumentasi API"

# ❌ HINDARI:
git commit -m "update"
git commit -m "fix"
git commit -m "changes"
git commit -m "test"
```

---

## 🎯 PEMBAGIAN TUGAS YANG DISARANKAN

### Anda Fokus Pada:
- **Backend Development**:
  - Controllers (`app/Http/Controllers/`)
  - Models (`app/Models/`)
  - Migrations (`database/migrations/`)
  - Routes (koordinasi dengan teman)
  
- **Database**:
  - Schema design
  - Seeders
  - Factories

- **API Development**:
  - REST API endpoints
  - Authentication
  - Validation

### Teman Anda Fokus Pada:
- **Frontend Development**:
  - Blade templates (`resources/views/`)
  - CSS styling (`resources/css/`)
  - JavaScript (`resources/js/`)
  
- **UI/UX**:
  - Design implementation
  - Responsive layout
  - Animations

---

## ⚠️ JIKA ADA MASALAH

### Problem 1: Push Ditolak
```bash
# Solusi:
git pull origin sistem-pemesanan-barbershop-laravel
# Jika ada konflik, edit file dan resolve
git add .
git commit -m "resolve: Merge conflict"
git push origin sistem-pemesanan-barbershop-laravel
```

### Problem 2: Konflik saat Pull
```bash
# Git akan menampilkan file yang konflik
# Edit file tersebut, cari dan hapus:
# <<<<<<< HEAD
# kode Anda
# =======  
# kode teman
# >>>>>>> hash

# Setelah edit:
git add .
git commit -m "resolve: Fix merge conflict pada file X"
git push origin sistem-pemesanan-barbershop-laravel
```

### Problem 3: Tidak Yakin dengan Perubahan
```bash
# Backup perubahan Anda:
git stash

# Reset ke kondisi aman:
git reset --hard origin/sistem-pemesanan-barbershop-laravel

# Kembalikan perubahan:
git stash pop
```

---

## 📞 CHECKLIST HARIAN

### ✅ Setiap Pagi:
- [ ] `git pull origin sistem-pemesanan-barbershop-laravel`
- [ ] Chat dengan teman tentang rencana hari ini
- [ ] Cek apakah ada file yang tidak boleh diubah bersamaan

### ✅ Setiap Sore:
- [ ] `git add .`
- [ ] `git commit -m "pesan yang jelas"`
- [ ] `git pull origin sistem-pemesanan-barbershop-laravel`
- [ ] `git push origin sistem-pemesanan-barbershop-laravel`
- [ ] Beritahu teman bahwa sudah push

---

## 🚀 TESTING APLIKASI

### Jalankan Development Server:
```bash
# Terminal 1: Laravel server
php artisan serve

# Terminal 2: Vite (untuk CSS/JS)
npm run dev
```

### Akses Aplikasi:
- Buka browser: `http://127.0.0.1:8000`
- Test semua fitur yang Anda buat

---

## 📱 KOMUNIKASI DENGAN TEMAN

### Format Chat yang Disarankan:
```
"Saya mau kerja pada file: app/Http/Controllers/BookingController.php"
"Sudah selesai, silakan pull"
"Ada error di line 25 file X, bisa bantu cek?"
"Push sudah selesai, coba test fitur booking"
```

### Koordinasi File Penting:
- `routes/web.php` - Harus koordinasi
- `database/migrations/` - Harus koordinasi
- `.env` - Jangan di-commit
- `composer.json` - Harus koordinasi

---

## 🎉 TIPS SUKSES

1. **Selalu Pull Sebelum Push** - Ini aturan emas!
2. **Commit Sering** - Jangan menumpuk perubahan
3. **Pesan Commit Jelas** - Bantu teman memahami perubahan
4. **Komunikasi Aktif** - Chat sebelum mengubah file penting
5. **Test Sebelum Push** - Pastikan kode tidak error
6. **Backup Penting** - Simpan perubahan penting di tempat lain

---

## 🆘 KONTAK DARURAT

Jika stuck atau bingung:

1. **Jangan Panic** - Semua masalah Git bisa diselesaikan
2. **Screenshot Error** - Kirim ke teman untuk dibantu
3. **Backup Dulu** - `git stash` untuk simpan perubahan
4. **Tanya Teman** - Lebih baik tanya daripada salah

---

**🎯 Ingat: Kolaborasi yang sukses = Komunikasi + Koordinasi + Konsistensi**

**💪 Semangat coding!**