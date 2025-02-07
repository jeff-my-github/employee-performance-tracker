<?php

// User.php
class User {

    // Database connection method
    private function getDB() {
        // Correct database name: 'employee_performance'
        $dsn = 'mysql:host=localhost;dbname=employee_performance';  // Correct database name
        $username = 'root';  // Your database username
        $password = '';  // Your database password, make sure to set it if needed
        
        try {
            // Establishing PDO connection
            return new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            // Error handling if connection fails
            die("Connection failed: " . $e->getMessage());
        }
    }
    
}

?>
