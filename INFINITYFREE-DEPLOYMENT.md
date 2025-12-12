# 🚀 Deploy Laravel ke InfinityFree

## 📋 Persiapan Sebelum Deploy

### 1. **Daftar InfinityFree**
- Kunjungi: https://infinityfree.net
- Klik "Create Account"
- Verifikasi email
- Login ke control panel

### 2. **Buat Hosting Account**
- Di dashboard, klik "Create Account"
- Pilih subdomain gratis atau gunakan domain sendiri
- Tunggu aktivasi (biasanya instant)

## 🛠️ Persiapan Project Laravel

### 1. **Optimize Project untuk Shared Hosting**
```bash
# Install dependencies production
composer install --optimize-autoloader --no-dev

# Generate optimized files
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize

# Build assets
npm run build
```

### 2. **Buat File .htaccess untuk Root**
```apache
# .htaccess di root folder
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

### 3. **Update .env untuk Production**
```env
APP_NAME="Sisbar Hairstudio"
APP_ENV=production
APP_KEY=base64:f0hxsJ5/MVqdEqHhlg/ZlafYvoeaaorPVtdUNUtH9oQ=
APP_DEBUG=false
APP_URL=https://your-subdomain.infinityfreeapp.com

DB_CONNECTION=mysql
DB_HOST=sql200.infinityfree.com
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Google OAuth
GOOGLE_CLIENT_ID=your_google_client_id
GOOGLE_CLIENT_SECRET=your_google_client_secret
GOOGLE_REDIRECT_URL=https://your-subdomain.infinityfreeapp.com/auth/google/callback
```

## 📁 Struktur File untuk Upload

### 1. **Siapkan Files untuk Upload**
```
project-root/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/          # Ini akan jadi htdocs
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
├── .htaccess        # Buat baru
├── artisan
├── composer.json
└── composer.lock
```

## 🌐 Langkah Deploy ke InfinityFree

### Step 1: **Setup Database**
1. Login ke InfinityFree control panel
2. Klik "MySQL Databases"
3. Buat database baru
4. Catat: Database name, Username, Password, Host
5. Buka phpMyAdmin
6. Import database (jika ada) atau siapkan untuk migration

### Step 2: **Upload Files**
1. Buka "File Manager" di control panel
2. Masuk ke folder `htdocs`
3. Upload semua file Laravel KECUALI folder `public`
4. Upload isi folder `public` ke `htdocs` (root)
5. Struktur akhir di server:
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
├── index.php        # dari public/
├── css/            # dari public/
├── js/             # dari public/
├── images/         # dari public/
└── artisan
```

### Step 3: **Update index.php**
Edit `htdocs/index.php`:
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

### Step 4: **Set Permissions**
Di File Manager, set permissions:
```
storage/ → 755 (recursive)
bootstrap/cache/ → 755 (recursive)
```

### Step 5: **Run Database Migration**
Buat file `migrate.php` di root:
```php
<?php
// migrate.php - Jalankan sekali untuk setup database

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

// Run migrations
Artisan::call('migrate', ['--force' => true]);
echo "Migrations completed!\n";

// Run seeders
Artisan::call('db:seed', ['--class' => 'BarberSeeder', '--force' => true]);
Artisan::call('db:seed', ['--class' => 'ServiceSeeder', '--force' => true]);
echo "Seeders completed!\n";

echo "Database setup complete!";
```

Akses: `https://your-subdomain.infinityfreeapp.com/migrate.php`
Setelah selesai, HAPUS file ini!

## 🔧 Konfigurasi Tambahan

### 1. **Update Google OAuth**
1. Buka Google Cloud Console
2. Pergi ke Credentials
3. Edit OAuth 2.0 Client
4. Tambahkan Authorized redirect URIs:
   ```
   https://your-subdomain.infinityfreeapp.com/auth/google/callback
   ```

### 2. **Fix Storage Links**
Buat file `storage-link.php`:
```php
<?php
// storage-link.php - Jalankan sekali untuk link storage

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

Artisan::call('storage:link');
echo "Storage linked successfully!";
```

Akses sekali, lalu hapus file.

### 3. **Optimize untuk Shared Hosting**
Buat file `optimize.php`:
```php
<?php
// optimize.php - Optimize Laravel untuk production

require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';

Artisan::call('config:cache');
Artisan::call('route:cache');
Artisan::call('view:cache');
Artisan::call('optimize');

echo "Laravel optimized for production!";
```

## 🚨 Troubleshooting

### **Error 500 - Internal Server Error**
1. Check file permissions (755 untuk folders, 644 untuk files)
2. Check .env configuration
3. Check error logs di control panel

### **Database Connection Error**
1. Pastikan DB credentials benar
2. Check database host (biasanya sql200.infinityfree.com)
3. Pastikan database sudah dibuat

### **Routes Not Working**
1. Pastikan .htaccess ada di root
2. Check mod_rewrite enabled
3. Clear route cache

### **Assets Not Loading**
1. Pastikan CSS/JS ada di root htdocs
2. Check asset paths di blade templates
3. Run `php artisan storage:link`

## 📝 Checklist Deploy

- [ ] Daftar InfinityFree account
- [ ] Buat hosting account
- [ ] Setup database MySQL
- [ ] Upload files ke htdocs
- [ ] Update index.php paths
- [ ] Set file permissions
- [ ] Configure .env
- [ ] Run migrations
- [ ] Setup Google OAuth
- [ ] Test website functionality
- [ ] Remove temporary files (migrate.php, etc.)

## 🎯 URL Akhir

Setelah deploy berhasil:
- **Website**: https://your-subdomain.infinityfreeapp.com
- **Admin Panel**: https://your-subdomain.infinityfreeapp.com/admin
- **Login**: https://your-subdomain.infinityfreeapp.com/login
- **Booking**: https://your-subdomain.infinityfreeapp.com/booking

## ⚠️ Batasan InfinityFree

- **Ads**: Ada iklan di website
- **Resources**: Limited CPU/Memory
- **Bandwidth**: 5GB/month
- **Storage**: 5GB
- **No HTTPS**: Hanya HTTP (kecuali upgrade)
- **File Upload**: Max 10MB

## 💡 Tips Optimasi

1. **Compress Images**: Kecilkan ukuran gambar
2. **Minimize CSS/JS**: Gunakan minified versions
3. **Cache**: Gunakan Laravel caching
4. **Database**: Optimize queries
5. **CDN**: Gunakan external CDN untuk assets

Apakah Anda siap untuk mulai deploy? Saya bisa bantu step-by-step!