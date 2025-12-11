# 🤝 Panduan Kolaborasi GitHub - Pangling Barbershop

## 📋 Daftar Isi
1. [Setup Awal untuk Teman](#setup-awal-untuk-teman)
2. [Workflow Kolaborasi](#workflow-kolaborasi)
3. [Mengatasi Konflik](#mengatasi-konflik)
4. [Best Practices](#best-practices)
5. [Troubleshooting](#troubleshooting)

---

## 🚀 Setup Awal untuk Teman

### Step 1: Clone Repository
```bash
# Teman Anda perlu clone repository ini
git clone https://github.com/USERNAME/REPOSITORY-NAME.git
cd tecno-berbershop

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate
```

### Step 2: Konfigurasi Git
```bash
# Set nama dan email (hanya sekali)
git config --global user.name "Nama Teman Anda"
git config --global user.email "email@teman.com"

# Atau untuk repository ini saja
git config user.name "Nama Teman Anda"
git config user.email "email@teman.com"
```

### Step 3: Cek Branch dan Remote
```bash
# Lihat semua branch
git branch -a

# Pindah ke branch kerja
git checkout sistem-pemesanan-barbershop-laravel

# Pastikan remote sudah benar
git remote -v
```

---

## 🔄 Workflow Kolaborasi

### Untuk Anda (Pemilik Repository)

#### 1. Sebelum Mulai Kerja
```bash
# Selalu pull perubahan terbaru
git pull origin sistem-pemesanan-barbershop-laravel

# Cek status
git status
```

#### 2. Saat Bekerja
```bash
# Buat perubahan pada file
# Edit, tambah, atau hapus file sesuai kebutuhan

# Lihat perubahan
git status
git diff

# Add perubahan
git add .

# Commit dengan pesan yang jelas
git commit -m "feat: Tambah fitur booking online dengan validasi"
```

#### 3. Push Perubahan
```bash
# Push ke GitHub
git push origin sistem-pemesanan-barbershop-laravel
```

### Untuk Teman Anda

#### 1. Sebelum Mulai Kerja
```bash
# WAJIB: Pull perubahan terbaru dari Anda
git pull origin sistem-pemesanan-barbershop-laravel

# Cek apakah ada perubahan
git log --oneline -5
```

#### 2. Saat Bekerja
```bash
# Buat perubahan pada file
# Pastikan tidak mengubah file yang sama dengan Anda

# Lihat perubahan
git status
git diff

# Add perubahan
git add .

# Commit dengan pesan yang jelas
git commit -m "feat: Tambah sistem notifikasi email"
```

#### 3. Push Perubahan
```bash
# Pull dulu untuk memastikan tidak ada konflik
git pull origin sistem-pemesanan-barbershop-laravel

# Jika tidak ada konflik, push
git push origin sistem-pemesanan-barbershop-laravel
```

---

## ⚠️ Mengatasi Konflik

### Jika Terjadi Konflik saat Pull
```bash
# Saat pull dan ada konflik
git pull origin sistem-pemesanan-barbershop-laravel

# Git akan menampilkan file yang konflik
# Edit file tersebut dan hapus marker konflik:
# <<<<<<< HEAD
# kode Anda
# =======
# kode teman
# >>>>>>> commit-hash

# Setelah resolve konflik
git add .
git commit -m "resolve: Merge conflict pada file X"
git push origin sistem-pemesanan-barbershop-laravel
```

### Jika Push Ditolak
```bash
# Jika push ditolak karena ada perubahan baru
git pull origin sistem-pemesanan-barbershop-laravel
# Resolve konflik jika ada
git push origin sistem-pemesanan-barbershop-laravel
```

---

## 📝 Best Practices

### 1. Komunikasi
- **Koordinasi**: Beritahu teman file mana yang sedang Anda kerjakan
- **Pesan Commit**: Gunakan pesan yang jelas dan deskriptif
- **Frekuensi**: Push perubahan secara berkala, jangan menumpuk

### 2. Pembagian Tugas
```
Anda fokus pada:
- Frontend (Blade templates, CSS, JavaScript)
- UI/UX improvements
- Landing page enhancements

Teman fokus pada:
- Backend (Controllers, Models, Routes)
- Database migrations
- API endpoints
- Authentication
```

### 3. Format Pesan Commit
```bash
# Format yang baik:
git commit -m "feat: Tambah halaman booking dengan validasi form"
git commit -m "fix: Perbaiki bug pada sistem login"
git commit -m "style: Update styling navbar responsive"
git commit -m "docs: Tambah dokumentasi API booking"

# Hindari pesan seperti:
git commit -m "update"
git commit -m "fix bug"
git commit -m "changes"
```

### 4. File yang Sebaiknya Tidak Dikerjakan Bersamaan
```
- resources/views/components/landing-page.blade.php
- resources/css/app.css
- resources/js/app.js
- routes/web.php (koordinasi dulu)
```

---

## 🔧 Troubleshooting

### Problem 1: Teman tidak bisa push
```bash
# Solusi:
git pull origin sistem-pemesanan-barbershop-laravel
git push origin sistem-pemesanan-barbershop-laravel
```

### Problem 2: File .env bermasalah
```bash
# Jangan commit file .env
# Pastikan .env ada di .gitignore
echo ".env" >> .gitignore
git add .gitignore
git commit -m "chore: Add .env to gitignore"
```

### Problem 3: Node modules atau vendor bermasalah
```bash
# Jangan commit folder ini
echo "node_modules/" >> .gitignore
echo "vendor/" >> .gitignore
git add .gitignore
git commit -m "chore: Add node_modules and vendor to gitignore"
```

### Problem 4: Melihat perubahan teman
```bash
# Untuk melihat apa yang berubah
git log --oneline -10
git show HEAD  # Lihat commit terakhir
git diff HEAD~1 HEAD  # Bandingkan dengan commit sebelumnya
```

---

## 📞 Checklist Harian

### Setiap Mulai Kerja:
- [ ] `git pull origin sistem-pemesanan-barbershop-laravel`
- [ ] `git status` (pastikan clean)
- [ ] Koordinasi dengan teman via chat

### Setiap Selesai Kerja:
- [ ] `git add .`
- [ ] `git commit -m "pesan yang jelas"`
- [ ] `git pull origin sistem-pemesanan-barbershop-laravel`
- [ ] `git push origin sistem-pemesanan-barbershop-laravel`
- [ ] Beritahu teman bahwa Anda sudah push

### Setiap Hari:
- [ ] Sync dengan teman tentang progress
- [ ] Review perubahan yang dibuat teman
- [ ] Plan tugas untuk hari berikutnya

---

## 🎯 Contoh Skenario Kolaborasi

### Skenario 1: Anda kerja Frontend, Teman kerja Backend
```bash
# Anda (Frontend):
git pull origin sistem-pemesanan-barbershop-laravel
# Edit: resources/views/components/booking-page.blade.php
git add .
git commit -m "feat: Tambah form booking dengan validasi frontend"
git push origin sistem-pemesanan-barbershop-laravel

# Teman (Backend):
git pull origin sistem-pemesanan-barbershop-laravel
# Edit: app/Http/Controllers/BookingController.php
git add .
git commit -m "feat: Tambah BookingController dengan validasi backend"
git push origin sistem-pemesanan-barbershop-laravel
```

### Skenario 2: Kerja pada file yang sama (HARUS KOORDINASI)
```bash
# Chat dulu:
"Anda: Saya mau edit routes/web.php untuk tambah route booking"
"Teman: OK, saya tunggu sampai kamu selesai"

# Setelah Anda selesai:
"Anda: Sudah push, silakan pull dan lanjut"
```

---

## 📱 Tools Tambahan

### 1. GitHub Desktop (Opsional)
- Download: https://desktop.github.com/
- GUI yang mudah untuk pemula

### 2. VS Code Extensions
- GitLens
- Git Graph
- GitHub Pull Requests

### 3. Command Shortcuts
```bash
# Buat alias untuk command yang sering dipakai
git config --global alias.st status
git config --global alias.co checkout
git config --global alias.br branch
git config --global alias.cm commit
git config --global alias.pl pull
git config --global alias.ps push

# Sekarang bisa pakai:
git st  # instead of git status
git pl origin sistem-pemesanan-barbershop-laravel
```

---

## 🆘 Kontak Darurat

Jika ada masalah yang tidak bisa diselesaikan:

1. **Backup dulu perubahan**:
   ```bash
   git stash  # Simpan perubahan sementara
   ```

2. **Reset ke kondisi aman**:
   ```bash
   git reset --hard origin/sistem-pemesanan-barbershop-laravel
   ```

3. **Restore perubahan**:
   ```bash
   git stash pop  # Kembalikan perubahan
   ```

---

**💡 Tips Sukses:**
- Komunikasi adalah kunci utama
- Pull sebelum push, selalu!
- Commit sering dengan pesan yang jelas
- Jangan takut bertanya jika bingung
- Backup pekerjaan penting secara terpisah

**🎉 Selamat berkolaborasi!**