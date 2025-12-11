@echo off
echo ========================================
echo    PANGLING BARBERSHOP - GIT HELPER
echo ========================================
echo.

:menu
echo Pilih aksi yang ingin dilakukan:
echo.
echo 1. Pull perubahan terbaru (Mulai kerja)
echo 2. Push perubahan saya (Selesai kerja)
echo 3. Cek status repository
echo 4. Lihat log commit terbaru
echo 5. Setup awal untuk teman baru
echo 6. Emergency: Backup dan reset
echo 7. Keluar
echo.
set /p choice="Masukkan pilihan (1-7): "

if "%choice%"=="1" goto pull_latest
if "%choice%"=="2" goto push_changes
if "%choice%"=="3" goto check_status
if "%choice%"=="4" goto show_log
if "%choice%"=="5" goto setup_friend
if "%choice%"=="6" goto emergency
if "%choice%"=="7" goto exit
goto menu

:pull_latest
echo.
echo [1] Pulling perubahan terbaru...
git pull origin sistem-pemesanan-barbershop-laravel
echo.
echo ✅ Selesai! Anda bisa mulai bekerja.
echo.
pause
goto menu

:push_changes
echo.
echo [2] Mempersiapkan push perubahan...
echo.
echo Perubahan yang akan di-commit:
git status --short
echo.
set /p commit_msg="Masukkan pesan commit: "
if "%commit_msg%"=="" (
    echo ❌ Pesan commit tidak boleh kosong!
    pause
    goto menu
)

echo.
echo Adding files...
git add .

echo Committing changes...
git commit -m "%commit_msg%"

echo Pulling latest changes...
git pull origin sistem-pemesanan-barbershop-laravel

echo Pushing to GitHub...
git push origin sistem-pemesanan-barbershop-laravel

echo.
echo ✅ Perubahan berhasil di-push!
echo 💬 Jangan lupa beritahu teman bahwa Anda sudah push.
echo.
pause
goto menu

:check_status
echo.
echo [3] Status repository:
echo.
echo Current branch:
git branch --show-current
echo.
echo Status:
git status
echo.
echo Remote info:
git remote -v
echo.
pause
goto menu

:show_log
echo.
echo [4] 10 commit terakhir:
echo.
git log --oneline -10 --graph
echo.
pause
goto menu

:setup_friend
echo.
echo [5] Setup untuk teman baru:
echo.
echo Pastikan teman Anda sudah:
echo 1. Clone repository: git clone [URL]
echo 2. Install composer: composer install
echo 3. Install npm: npm install
echo 4. Copy .env: cp .env.example .env
echo 5. Generate key: php artisan key:generate
echo 6. Set git config:
echo    git config user.name "Nama Teman"
echo    git config user.email "email@teman.com"
echo 7. Checkout branch: git checkout sistem-pemesanan-barbershop-laravel
echo.
echo Apakah teman sudah melakukan semua langkah di atas? (y/n)
set /p ready="Jawab: "
if /i "%ready%"=="y" (
    echo.
    echo ✅ Bagus! Sekarang teman bisa mulai kolaborasi.
    echo 📋 Berikan file UNTUK-TEMAN-ANDA.md kepada teman.
) else (
    echo.
    echo ⚠️  Pastikan teman menyelesaikan setup dulu.
)
echo.
pause
goto menu

:emergency
echo.
echo [6] 🆘 EMERGENCY BACKUP DAN RESET
echo.
echo ⚠️  PERINGATAN: Ini akan menyimpan perubahan Anda dan reset ke kondisi aman.
echo.
set /p confirm="Apakah Anda yakin? (y/n): "
if /i "%confirm%"=="y" (
    echo.
    echo Backing up changes...
    git stash push -m "Emergency backup %date% %time%"
    
    echo Resetting to safe state...
    git reset --hard origin/sistem-pemesanan-barbershop-laravel
    
    echo.
    echo ✅ Reset selesai!
    echo 💾 Perubahan Anda disimpan di stash.
    echo 🔄 Untuk mengembalikan: git stash pop
) else (
    echo.
    echo ❌ Emergency dibatalkan.
)
echo.
pause
goto menu

:exit
echo.
echo 👋 Terima kasih! Selamat coding!
echo.
pause
exit

:error
echo.
echo ❌ Terjadi error! Cek koneksi internet dan repository.
echo.
pause
goto menu