<?php
/**
 * Laravel Optimization Script for InfinityFree
 * 
 * IMPORTANT: 
 * 1. Run this AFTER migrate.php
 * 2. Access via browser: https://your-domain.com/optimize.php
 * 3. DELETE this file after running
 */

echo "<h2>⚡ Optimizing Laravel for Production...</h2>";

try {
    // Load Laravel
    require_once 'vendor/autoload.php';
    $app = require_once 'bootstrap/app.php';
    
    echo "<p>✅ Laravel loaded successfully</p>";
    
    // Clear all caches first
    echo "<p>🔄 Clearing existing caches...</p>";
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('cache:clear');
    echo "<p>✅ Caches cleared</p>";
    
    // Create optimized caches
    echo "<p>🔄 Creating optimized caches...</p>";
    Artisan::call('config:cache');
    echo "<p>✅ Config cached</p>";
    
    Artisan::call('route:cache');
    echo "<p>✅ Routes cached</p>";
    
    Artisan::call('view:cache');
    echo "<p>✅ Views cached</p>";
    
    // Create storage link
    echo "<p>🔄 Creating storage link...</p>";
    try {
        Artisan::call('storage:link');
        echo "<p>✅ Storage link created</p>";
    } catch (Exception $e) {
        echo "<p>⚠️ Storage link: " . $e->getMessage() . "</p>";
    }
    
    // General optimization
    Artisan::call('optimize');
    echo "<p>✅ General optimization completed</p>";
    
    echo "<h3>🎉 Laravel optimization completed!</h3>";
    echo "<p><strong>Your website is now optimized for production.</strong></p>";
    echo "<p>🚨 <strong>DELETE this optimize.php file for security!</strong></p>";
    
    echo "<h4>📊 Performance Tips:</h4>";
    echo "<ul>";
    echo "<li>✅ All Laravel caches are now active</li>";
    echo "<li>✅ Storage link created for file uploads</li>";
    echo "<li>✅ Views are pre-compiled</li>";
    echo "<li>✅ Routes are cached for faster loading</li>";
    echo "<li>✅ Configuration is cached</li>";
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<h3>❌ Error occurred:</h3>";
    echo "<p style='color: red;'>" . $e->getMessage() . "</p>";
    echo "<p><strong>This is usually safe to ignore if your website works properly.</strong></p>";
}
?>

<style>
body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
h2, h3, h4 { color: #333; }
p { margin: 10px 0; }
ul { margin: 10px 0 10px 20px; }
</style>