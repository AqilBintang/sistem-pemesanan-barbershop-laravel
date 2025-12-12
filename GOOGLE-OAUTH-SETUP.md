# Google OAuth Setup Guide

Untuk mengaktifkan login dengan Google, Anda perlu mengkonfigurasi Google OAuth di Google Cloud Console.

## Langkah-langkah Setup:

### 1. Buat Project di Google Cloud Console
1. Kunjungi [Google Cloud Console](https://console.cloud.google.com/)
2. Buat project baru atau pilih project yang sudah ada
3. Aktifkan Google+ API dan Google OAuth2 API

### 2. Konfigurasi OAuth Consent Screen
1. Di Google Cloud Console, pergi ke **APIs & Services** > **OAuth consent screen**
2. Pilih **External** untuk user type
3. Isi informasi aplikasi:
   - App name: `Sisbar Hairstudio`
   - User support email: email Anda
   - Developer contact information: email Anda
4. Tambahkan scope yang diperlukan:
   - `../auth/userinfo.email`
   - `../auth/userinfo.profile`
5. Simpan konfigurasi

### 3. Buat OAuth 2.0 Credentials
1. Pergi ke **APIs & Services** > **Credentials**
2. Klik **Create Credentials** > **OAuth 2.0 Client IDs**
3. Pilih **Web application**
4. Isi informasi:
   - Name: `Sisbar Hairstudio Web Client`
   - Authorized JavaScript origins: `http://127.0.0.1:8000`
   - Authorized redirect URIs: `http://127.0.0.1:8000/auth/google/callback`
5. Klik **Create**

### 4. Update File .env
Setelah mendapat Client ID dan Client Secret, update file `.env`:

```env
GOOGLE_CLIENT_ID=your_actual_google_client_id_here
GOOGLE_CLIENT_SECRET=your_actual_google_client_secret_here
GOOGLE_REDIRECT_URL=http://127.0.0.1:8000/auth/google/callback
```

### 5. Testing
1. Restart server Laravel: `php artisan serve`
2. Kunjungi `/booking` - akan redirect ke login
3. Klik "Masuk dengan Google"
4. Login dengan akun Google Anda
5. Setelah berhasil, akan redirect ke halaman booking

## Catatan Penting:
- Untuk production, ganti URL dengan domain yang sebenarnya
- Pastikan domain production sudah ditambahkan di Google Console
- Simpan Client ID dan Secret dengan aman
- Jangan commit file .env ke repository

## Troubleshooting:
- Jika error "redirect_uri_mismatch", pastikan URL callback sama persis
- Jika error "access_denied", cek konfigurasi OAuth consent screen
- Jika error "invalid_client", cek Client ID dan Secret di .env

## URL Penting:
- Login: `http://127.0.0.1:8000/login`
- Booking: `http://127.0.0.1:8000/booking`
- Status Booking: `http://127.0.0.1:8000/booking-status`