# 🚀 Setup Setelah Git Pull - Panduan Lengkap

## ⚠️ **PENTING: Langkah Wajib Setelah Git Pull**

Setelah melakukan `git pull origin main`, Anda **HARUS** menjalankan langkah-langkah berikut untuk menghindari error database:

---

## 📋 **Langkah-Langkah Setup**

### 1. **Update Dependencies**
```bash
composer install
npm install
```

### 2. **Setup Environment File**
```bash
# Jika belum ada file .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 3. **⭐ WAJIB: Jalankan Database Migrations**
```bash
# Jalankan migrasi untuk membuat tabel baru
php artisan migrate

# Atau jika ingin fresh install (hapus semua data lama)
php artisan migrate:fresh
```

### 4. **Setup Storage Link (untuk upload foto)**
```bash
php artisan storage:link
```

### 5. **Jalankan Aplikasi**
```bash
# Terminal 1: Jalankan Laravel server
php artisan serve

# Terminal 2: Jalankan Vite untuk assets
npm run dev
```

---

## 🗃️ **Tabel Database Baru yang Ditambahkan**

Update ini menambahkan tabel-tabel berikut:
- `services` - Untuk menyimpan data layanan barbershop
- `barbers` - Untuk menyimpan data kapster
- `migrations` - Laravel migration tracking

---

## 🔐 **Akses Admin Panel**

Setelah setup selesai, Anda dapat mengakses:

### **Admin Login**
- URL: `http://127.0.0.1:8000/admin`
- Username: `admin`
- Password: `admin123`

### **Fitur Admin**
- Dashboard dengan statistik
- Manajemen Layanan (CRUD + Upload Foto)
- Manajemen Kapster (CRUD)
- Sidebar tetap saat scroll
- Design minimalis dan elegan

---

## 🎨 **Fitur Baru - Service Cards**

Layanan sekarang memiliki design card yang berbeda berdasarkan tipe:

- 🟢 **Ekonomis** - Hijau (Ramah kantong)
- 🟡 **Populer** - Kuning (Nilai terbaik)  
- 🔵 **Paket** - Biru (Hemat)
- 🟣 **Premium** - Ungu (Premium)

---

## ❌ **Troubleshooting Error Umum**

### **Error: "no such table: services"**
```bash
# Solusi: Jalankan migrasi
php artisan migrate
```

### **Error: "Class 'App\Models\Service' not found"**
```bash
# Solusi: Update autoload
composer dump-autoload
```

### **Error: Storage link tidak berfungsi**
```bash
# Solusi: Buat storage link
php artisan storage:link
```

### **Error: Permission denied pada storage**
```bash
# Windows (PowerShell as Administrator)
icacls "storage" /grant Everyone:F /T

# Linux/Mac
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## 📱 **Testing Fitur Baru**

1. **Test Admin Panel:**
   - Buka `http://127.0.0.1:8000/admin`
   - Login dengan credentials di atas
   - Coba tambah layanan baru dengan foto

2. **Test Service Cards:**
   - Buka `http://127.0.0.1:8000/services`
   - Lihat perbedaan warna card berdasarkan tipe

3. **Test Responsive Design:**
   - Buka di mobile browser
   - Test sidebar navigation

---

## 🆘 **Jika Masih Error**

Jika masih mengalami masalah:

1. **Reset Database Completely:**
```bash
php artisan migrate:fresh
php artisan db:seed  # Jika ada seeder
```

2. **Clear All Cache:**
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

3. **Reinstall Dependencies:**
```bash
rm -rf vendor node_modules
composer install
npm install
```

---

## 📞 **Kontak Support**

Jika masih mengalami kesulitan, hubungi tim development dengan informasi:
- Error message lengkap
- Screenshot error
- Langkah yang sudah dicoba

---

**Happy Coding! 🎉**