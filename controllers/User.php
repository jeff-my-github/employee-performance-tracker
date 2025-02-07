<?php

class User {
    // Example database connection method (you should replace it with your actual DB connection code)
    private function getDB() {
        // Assuming PDO connection
        $dsn = 'mysql:host=localhost;dbname=employee_performance_tracker';
        $username = 'root';
        $password = '';
        
        try {
            return new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Method to check user credentials
    public function checkCredentials($username, $password) {
        $db = $this->getDB();
        
        // Prepare the SQL query to check if the user exists and the password matches
        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // If the user exists and the password matches
        if ($user && password_verify($password, $user['password'])) {
            return true;
        }
        
        return false;
    }
}
