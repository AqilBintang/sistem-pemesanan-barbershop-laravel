@echo off
echo ========================================
echo   SETUP SETELAH GIT PULL - OTOMATIS
echo ========================================
echo.

echo [1/5] Updating Composer dependencies...
composer install
if %errorlevel% neq 0 (
    echo ERROR: Composer install failed!
    pause
    exit /b 1
)

echo.
echo [2/5] Running database migrations...
php artisan migrate
if %errorlevel% neq 0 (
    echo ERROR: Migration failed!
    echo.
    echo Trying fresh migration...
    php artisan migrate:fresh
    if %errorlevel% neq 0 (
        echo ERROR: Fresh migration also failed!
        pause
        exit /b 1
    )
)

echo.
echo [3/5] Creating storage link...
php artisan storage:link
if %errorlevel% neq 0 (
    echo WARNING: Storage link failed, but continuing...
)

echo.
echo [4/5] Clearing cache...
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

echo.
echo [5/5] Installing NPM dependencies...
npm install
if %errorlevel% neq 0 (
    echo ERROR: NPM install failed!
    pause
    exit /b 1
)

echo.
echo ========================================
echo           SETUP COMPLETED!
echo ========================================
echo.
echo Admin Panel: http://127.0.0.1:8000/admin
echo Username: admin
echo Password: admin123
echo.
echo Next steps:
echo 1. Run: php artisan serve
echo 2. In another terminal: npm run dev
echo.
pause