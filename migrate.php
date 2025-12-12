<?php
/**
 * Database Migration Script for InfinityFree
 * 
 * IMPORTANT: 
 * 1. Upload this file to your htdocs root
 * 2. Access it once via browser: https://your-domain.com/migrate.php
 * 3. DELETE this file after running successfully
 */

echo "<h2>🚀 Setting up Sisbar Hairstudio Database...</h2>";

try {
    // Load Laravel
    require_once 'vendor/autoload.php';
    $app = require_once 'bootstrap/app.php';
    
    echo "<p>✅ Laravel loaded successfully</p>";
    
    // Test database connection
    $pdo = new PDO(
        'mysql:host=' . env('DB_HOST') . ';dbname=' . env('DB_DATABASE'),
        env('DB_USERNAME'),
        env('DB_PASSWORD')
    );
    echo "<p>✅ Database connection successful</p>";
    
    // Run migrations
    echo "<p>🔄 Running migrations...</p>";
    Artisan::call('migrate', ['--force' => true]);
    echo "<p>✅ Migrations completed</p>";
    
    // Run seeders
    echo "<p>🔄 Running seeders...</p>";
    
    // Service Seeder
    try {
        Artisan::call('db:seed', ['--class' => 'ServiceSeeder', '--force' => true]);
        echo "<p>✅ Service seeder completed</p>";
    } catch (Exception $e) {
        echo "<p>⚠️ Service seeder: " . $e->getMessage() . "</p>";
    }
    
    // Barber Seeder
    try {
        Artisan::call('db:seed', ['--class' => 'BarberSeeder', '--force' => true]);
        echo "<p>✅ Barber seeder completed</p>";
    } catch (Exception $e) {
        echo "<p>⚠️ Barber seeder: " . $e->getMessage() . "</p>";
    }
    
    // Barber Schedule Seeder
    try {
        Artisan::call('db:seed', ['--class' => 'BarberScheduleSeeder', '--force' => true]);
        echo "<p>✅ Barber Schedule seeder completed</p>";
    } catch (Exception $e) {
        echo "<p>⚠️ Barber Schedule seeder: " . $e->getMessage() . "</p>";
    }
    
    // Booking Seeder (sample data)
    try {
        Artisan::call('db:seed', ['--class' => 'BookingSeeder', '--force' => true]);
        echo "<p>✅ Booking seeder completed</p>";
    } catch (Exception $e) {
        echo "<p>⚠️ Booking seeder: " . $e->getMessage() . "</p>";
    }
    
    echo "<h3>🎉 Database setup completed successfully!</h3>";
    echo "<p><strong>Next steps:</strong></p>";
    echo "<ul>";
    echo "<li>✅ Visit your website: <a href='/' target='_blank'>Home Page</a></li>";
    echo "<li>✅ Test admin panel: <a href='/admin' target='_blank'>Admin Panel</a> (admin/admin123)</li>";
    echo "<li>✅ Test booking: <a href='/booking' target='_blank'>Booking System</a></li>";
    echo "<li>🚨 <strong>DELETE this migrate.php file for security!</strong></li>";
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<h3>❌ Error occurred:</h3>";
    echo "<p style='color: red;'>" . $e->getMessage() . "</p>";
    echo "<p><strong>Common solutions:</strong></p>";
    echo "<ul>";
    echo "<li>Check your .env database credentials</li>";
    echo "<li>Make sure database exists in InfinityFree panel</li>";
    echo "<li>Verify file permissions (755 for folders)</li>";
    echo "<li>Check if all Laravel files are uploaded</li>";
    echo "</ul>";
}
?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
h2, h3 { color: #333; }
p { margin: 10px 0; }
ul { margin: 10px 0 10px 20px; }
a { color: #007cba; text-decoration: none; }
a:hover { text-decoration: underline; }
</style>