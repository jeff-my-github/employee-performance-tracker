<?php
// config.php - Database connection settings

define('DB_HOST', 'localhost');  // Your database host
define('DB_NAME', 'employee_performance');  // Your database name
define('DB_USER', 'root');  // Your database username
define('DB_PASS', '');  // Your database password (empty for local development)

// Create database connection
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
