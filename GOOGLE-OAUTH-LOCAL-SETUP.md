# 🔐 Setup Google OAuth untuk Local Development

## 🎯 Langkah Setup Google OAuth

### **Step 1: Buat Project di Google Cloud Console**

1. **Kunjungi Google Cloud Console**
   - Buka: https://console.cloud.google.com/
   - Login dengan akun Google Anda

2. **Buat Project Baru**
   - Klik dropdown project di atas
   - Klik "New Project"
   - Nama project: `Sisbar Hairstudio`
   - Klik "Create"

### **Step 2: Enable Google+ API**

1. **Enable APIs**
   - Di sidebar, klik "APIs & Services" → "Library"
   - Cari "Google+ API" → Enable
   - Cari "Google OAuth2 API" → Enable

### **Step 3: Configure OAuth Consent Screen**

1. **Setup Consent Screen**
   - Klik "APIs & Services" → "OAuth consent screen"
   - Pilih "External" → Create
   
2. **Isi Informasi App**
   ```
   App name: Sisbar Hairstudio
   User support email: [email Anda]
   Developer contact information: [email Anda]
   ```

3. **Add Scopes**
   - Klik "Add or Remove Scopes"
   - Pilih:
     - `../auth/userinfo.email`
     - `../auth/userinfo.profile`
   - Save and Continue

4. **Test Users (Optional)**
   - Add email Anda sebagai test user
   - Save and Continue

### **Step 4: Create OAuth 2.0 Credentials**

1. **Create Credentials**
   - Klik "APIs & Services" → "Credentials"
   - Klik "Create Credentials" → "OAuth 2.0 Client IDs"

2. **Configure OAuth Client**
   ```
   Application type: Web application
   Name: Sisbar Hairstudio Local
   
   Authorized JavaScript origins:
   - http://localhost:8000
   - http://127.0.0.1:8000
   
   Authorized redirect URIs:
   - http://localhost:8000/auth/google/callback
   - http://127.0.0.1:8000/auth/google/callback
   ```

3. **Save Credentials**
   - Klik "Create"
   - Copy Client ID dan Client Secret
   - Simpan dengan aman

### **Step 5: Update .env File**

Update file `.env` Anda:
```env
# Google OAuth Configuration
GOOGLE_CLIENT_ID=your_actual_client_id_here
GOOGLE_CLIENT_SECRET=your_actual_client_secret_here
GOOGLE_REDIRECT_URL=http://127.0.0.1:8000/auth/google/callback
```

### **Step 6: Clear Cache Laravel**

```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

### **Step 7: Test Google Login**

1. **Start Laravel Server**
   ```bash
   php artisan serve
   ```

2. **Test Login Flow**
   - Kunjungi: http://127.0.0.1:8000/login
   - Klik "Masuk dengan Google"
   - Login dengan akun Google
   - Harus redirect ke booking page

## 🚨 **Troubleshooting Common Issues**

### **Error: redirect_uri_mismatch**
- Pastikan redirect URI di Google Console sama persis dengan .env
- Check tidak ada trailing slash
- Pastikan menggunakan http:// untuk local development

### **Error: invalid_client**
- Check Client ID dan Client Secret di .env
- Pastikan tidak ada spasi atau karakter tambahan
- Restart server Laravel setelah update .env

### **Error: access_denied**
- Check OAuth consent screen sudah dikonfigurasi
- Pastikan email Anda ada di test users (jika app masih testing)
- Check scopes sudah ditambahkan

### **Error: This app isn't verified**
- Klik "Advanced" → "Go to Sisbar Hairstudio (unsafe)"
- Ini normal untuk development app

## 🔧 **Alternative: Test Login (Tanpa Google OAuth)**

Jika Google OAuth masih bermasalah, gunakan test login:

1. **Kunjungi Test Login**
   - http://127.0.0.1:8000/test-login

2. **Isi Form**
   ```
   Nama: Test User
   Email: test@gmail.com
   ```

3. **Login dan Test Booking**
   - Setelah login, test booking system
   - Test semua fitur

## 📋 **Checklist Setup**

- [ ] Project dibuat di Google Cloud Console
- [ ] Google+ API enabled
- [ ] OAuth consent screen dikonfigurasi
- [ ] OAuth 2.0 credentials dibuat
- [ ] Client ID dan Secret disalin
- [ ] .env file diupdate
- [ ] Laravel cache di-clear
- [ ] Server Laravel restart
- [ ] Test login berhasil

## 💡 **Tips**

1. **Gunakan Incognito Mode** untuk testing
2. **Check Browser Console** untuk error JavaScript
3. **Check Laravel Logs** di `storage/logs/laravel.log`
4. **Pastikan Internet Stabil** untuk OAuth flow

## 🎯 **Expected Flow**

1. User klik "Masuk dengan Google"
2. Redirect ke Google OAuth
3. User login dengan Google
4. Google redirect kembali ke aplikasi
5. User otomatis login dan redirect ke booking
6. Booking form pre-filled dengan data Google

Jika masih ada masalah, screenshot error message dan saya akan bantu troubleshoot!