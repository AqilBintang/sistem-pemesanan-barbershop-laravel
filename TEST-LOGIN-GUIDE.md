# 🧪 Test Login System - Quick Guide

## 🚀 **Cara Cepat Test Login (Tanpa Google OAuth)**

Karena setup Google OAuth butuh waktu, mari test dulu dengan test login:

### **Step 1: Start Server**
```bash
php artisan serve
```

### **Step 2: Test Login**
1. **Kunjungi Test Login Page**
   - http://127.0.0.1:8000/test-login

2. **Isi Form Test Login**
   ```
   Nama: John Doe
   Email: john@gmail.com
   ```

3. **Klik "Login Test"**
   - Akan otomatis login dan redirect ke booking

### **Step 3: Test Booking System**
1. **Setelah login, test booking**
   - http://127.0.0.1:8000/booking
   - Form sudah pre-filled dengan data user

2. **Test Complete Booking Flow**
   - Pilih tanggal
   - Pilih kapster
   - Pilih waktu
   - Pilih layanan
   - Isi nomor telepon
   - Submit booking

3. **Test Booking Status**
   - http://127.0.0.1:8000/booking-status
   - Lihat booking yang sudah dibuat

## 🔐 **Setup Google OAuth (Jika Ingin Real Google Login)**

### **Quick Setup Google OAuth:**

1. **Buka Google Cloud Console**
   - https://console.cloud.google.com/

2. **Buat Project Baru**
   - Nama: "Sisbar Hairstudio"

3. **Enable APIs**
   - Google+ API
   - Google OAuth2 API

4. **Setup OAuth Consent Screen**
   - External → App name: "Sisbar Hairstudio"
   - Add scopes: email, profile

5. **Create OAuth 2.0 Credentials**
   - Web application
   - Authorized redirect URIs: `http://127.0.0.1:8000/auth/google/callback`

6. **Update .env**
   ```env
   GOOGLE_CLIENT_ID=your_actual_client_id
   GOOGLE_CLIENT_SECRET=your_actual_client_secret
   GOOGLE_REDIRECT_URL=http://127.0.0.1:8000/auth/google/callback
   ```

7. **Clear Cache**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

## 🧪 **Test Scenarios**

### **Scenario 1: Test Login Flow**
1. Logout (jika sudah login)
2. Kunjungi /booking → redirect ke login
3. Test login dengan test-login
4. Redirect ke booking page

### **Scenario 2: Test Booking Creation**
1. Login dengan test user
2. Buat booking baru
3. Check booking berhasil dibuat
4. Test booking confirmation page

### **Scenario 3: Test Admin Panel**
1. Kunjungi /admin
2. Login: admin / admin123
3. Check booking yang dibuat user
4. Update status booking
5. Test CRUD operations

### **Scenario 4: Test Booking Status**
1. Login sebagai user
2. Kunjungi /booking-status
3. Lihat booking history
4. Test filter by phone

## 🚨 **Common Issues & Solutions**

### **Issue: "Route not found"**
```bash
php artisan route:clear
php artisan route:cache
```

### **Issue: "Class not found"**
```bash
composer dump-autoload
php artisan config:clear
```

### **Issue: "Database connection error"**
- Check database sudah running
- Check .env database credentials
- Run: `php artisan migrate`

### **Issue: "Session not working"**
```bash
php artisan session:table
php artisan migrate
```

## 📊 **Test Checklist**

- [ ] Server Laravel running (php artisan serve)
- [ ] Database connection working
- [ ] Test login berhasil (/test-login)
- [ ] Booking page accessible (/booking)
- [ ] Booking form pre-filled dengan user data
- [ ] Booking creation berhasil
- [ ] Booking confirmation page working
- [ ] Booking status page working (/booking-status)
- [ ] Admin panel accessible (/admin)
- [ ] Admin dapat melihat booking user
- [ ] Logout working

## 🎯 **Next Steps**

Setelah semua test berhasil:
1. **Setup Google OAuth** untuk production-ready login
2. **Deploy ke hosting** (InfinityFree/Railway/dll)
3. **Configure production environment**
4. **Test di production**

## 💡 **Tips**

- **Gunakan Incognito** untuk test login/logout
- **Check browser console** untuk JavaScript errors
- **Check Laravel logs** di `storage/logs/laravel.log`
- **Test di mobile** untuk responsive design