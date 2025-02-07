<?php
require_once '../config/config.php';

// /models/User.php

class User {

    public $user_id;
    public $username;
    public $password_hash;
    public $role;

    // Database connection
    private static function getDb() {
        // Updated the database name to 'employee_performance'
        return new PDO('mysql:host=localhost;dbname=employee_performance', 'root', '');
    }

    // Method to find a user by username
    public static function findByUsername($username) {
        $db = self::getDb();
        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Method to save a new user to the database
    public function save() {
        $db = self::getDb();
        $stmt = $db->prepare('INSERT INTO users (username, password_hash, role) VALUES (:username, :password_hash, :role)');
        return $stmt->execute([
            'username' => $this->username,
            'password_hash' => $this->password_hash,
            'role' => $this->role
        ]);
    }
}
?>
