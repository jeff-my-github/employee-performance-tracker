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

    // Method to save user to the database
    public function save() {
        // Get the database connection
        $db = $this->getDB();
        
        // Prepare the SQL query to insert a new user
        $stmt = $db->prepare("INSERT INTO users (username, password_hash, role) VALUES (:username, :password_hash, :role)");
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password_hash', $this->password_hash);
        $stmt->bindParam(':role', $this->role);

        // Execute and return the result
        return $stmt->execute();  // Returns true if insert was successful, false otherwise
    }

    // Method to check if a username exists
    public static function findByUsername($username) {
        // Get the database connection
        $db = (new self())->getDB();
        
        // Prepare the SQL query to check for existing username
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Fetch the result, return the user data if found, otherwise null
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Returns the user if found, otherwise null
    }
}

?>
