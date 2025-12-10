# 🎯 Git Cheat Sheet - Command yang Sering Dipakai

## 🚀 Setup Awal (Sekali Doang)

```bash
# Download project
git clone https://github.com/AqilBintang/sistem-pemesanan-barbershop-laravel.git

# Masuk ke folder
cd sistem-pemesanan-barbershop-laravel

# Setup nama & email (ganti dengan nama kalian)
git config --global user.name "Nama Kalian"
git config --global user.email "email@kalian.com"
```

---

## 📋 Command Harian (Yang Paling Sering Dipakai)

### 1. **Sebelum Mulai Coding**
```bash
# Cek posisi sekarang
git status

# Pindah ke branch main
git checkout main

# Download update terbaru
git pull origin main

# Buat branch baru untuk kerja
git checkout -b feature/nama-fitur-kalian
```

### 2. **Setelah Selesai Coding**
```bash
# Lihat file apa yang berubah
git status

# Tambahkan semua perubahan
git add .

# Atau tambah file tertentu aja
git add nama-file.php

# Simpan perubahan dengan pesan
git commit -m "Deskripsi perubahan kalian"

# Upload ke GitHub
git push origin feature/nama-fitur-kalian
```

### 3. **Lihat History**
```bash
# Lihat commit terakhir
git log --oneline

# Lihat perubahan yang belum di-commit
git diff
```

---

## 🔄 Workflow Lengkap (Copy-Paste Aja)

### **Mulai Kerja Baru:**
```bash
git checkout main
git pull origin main
git checkout -b feature/edit-halaman-utama
```

### **Selesai Kerja:**
```bash
git add .
git commit -m "Edit teks di halaman utama"
git push origin feature/edit-halaman-utama
```

### **Kalau Mau Lanjut Kerja Lagi:**
```bash
git checkout feature/edit-halaman-utama
# lanjut coding...
git add .
git commit -m "Tambah section testimoni"
git push origin feature/edit-halaman-utama
```

---

## 🆘 Command Darurat (Kalau Ada Masalah)

### **Kalau Salah Commit:**
```bash
# Batalkan commit terakhir (tapi file tetap berubah)
git reset --soft HEAD~1

# Batalkan commit + kembalikan file seperti semula
git reset --hard HEAD~1
```

### **Kalau Ada Konflik:**
```bash
# Update branch dengan main terbaru
git checkout main
git pull origin main
git checkout feature/branch-kalian
git merge main

# Kalau ada konflik, edit file yang konflik
# Hapus bagian <<<<<<< ======= >>>>>>>
# Lalu:
git add .
git commit -m "resolve conflict"
```

### **Kalau Mau Buang Semua Perubahan:**
```bash
# Buang semua perubahan yang belum di-commit
git checkout .

# Atau buang file tertentu
git checkout nama-file.php
```

### **Kalau Lupa di Branch Mana:**
```bash
# Lihat semua branch
git branch

# Lihat branch yang aktif (ada tanda *)
git branch --show-current
```

---

## 📝 Template Pesan Commit yang Baik

### **Format:**
```
tipe: deskripsi singkat

Contoh:
feat: tambah halaman tentang kami
fix: perbaiki navbar di mobile
style: ubah warna tema jadi biru
docs: update dokumentasi API
```

### **Tipe-tipe Commit:**
- `feat:` - fitur baru
- `fix:` - perbaiki bug
- `style:` - ubah tampilan/CSS
- `docs:` - update dokumentasi
- `refactor:` - rapihkan code
- `test:` - tambah testing

### **Contoh Pesan yang Baik:**
```bash
git commit -m "feat: tambah section testimoni di halaman utama"
git commit -m "fix: perbaiki responsive navbar di mobile"
git commit -m "style: ubah warna tema dari hijau ke biru"
git commit -m "docs: tambah dokumentasi cara install"
```

### **Contoh Pesan yang Buruk:**
```bash
git commit -m "update"           # Terlalu singkat
git commit -m "fix bug"          # Tidak jelas bug apa
git commit -m "asdfgh"           # Tidak bermakna
```

---

## 🎯 Skenario Umum

### **Skenario 1: Edit File Sederhana**
```bash
# 1. Mulai
git checkout main
git pull origin main
git checkout -b feature/edit-teks

# 2. Edit file (pakai code editor)
# 3. Selesai
git add .
git commit -m "feat: ubah teks welcome di dashboard"
git push origin feature/edit-teks

# 4. Buat Pull Request di GitHub
```

### **Skenario 2: Tambah Halaman Baru**
```bash
# 1. Mulai
git checkout main
git pull origin main
git checkout -b feature/halaman-kontak

# 2. Buat file baru + edit routes
# 3. Selesai
git add .
git commit -m "feat: tambah halaman kontak dengan form"
git push origin feature/halaman-kontak

# 4. Buat Pull Request di GitHub
```

### **Skenario 3: Perbaiki Bug**
```bash
# 1. Mulai
git checkout main
git pull origin main
git checkout -b bugfix/navbar-mobile

# 2. Perbaiki bug
# 3. Selesai
git add .
git commit -m "fix: perbaiki navbar tidak muncul di mobile"
git push origin bugfix/navbar-mobile

# 4. Buat Pull Request di GitHub
```

---

## 🚨 Hal yang JANGAN Dilakukan

### ❌ **JANGAN:**
```bash
# Jangan push langsung ke main
git push origin main

# Jangan commit tanpa pesan
git commit

# Jangan add file yang tidak perlu
git add *

# Jangan force push (berbahaya!)
git push --force
```

### ✅ **LAKUKAN:**
```bash
# Selalu pakai branch
git checkout -b feature/nama-fitur

# Selalu kasih pesan commit
git commit -m "deskripsi jelas"

# Selalu cek dulu sebelum add
git status
git add .

# Push ke branch sendiri
git push origin feature/nama-fitur
```

---

## 📱 Quick Reference

### **Command Paling Sering Dipakai:**
```bash
git status          # Cek status
git add .           # Tambah semua perubahan
git commit -m ""    # Simpan dengan pesan
git push origin     # Upload ke GitHub
git pull origin     # Download update
git checkout        # Pindah branch
git branch          # Lihat branch
```

### **Shortcut Berguna:**
```bash
# Lihat log singkat
git log --oneline -10

# Lihat perubahan
git diff

# Lihat branch remote
git branch -r

# Hapus branch lokal
git branch -d nama-branch
```

---

## 🆘 Kontak Bantuan

**Kalau stuck dengan Git:**
1. Screenshot error message
2. Kirim ke group WhatsApp
3. Tag @AqilBintang
4. Atau Google: "git [error message]"

**Link Berguna:**
- Git Documentation: https://git-scm.com/docs
- GitHub Help: https://help.github.com/
- Git Cheat Sheet: https://education.github.com/git-cheat-sheet-education.pdf

---

**Happy Git-ing! 🚀**