<?php
// /controllers/UserController.php

include_once '../models/User.php';

class UserController {

    // Register a new user
    public function register() {
        // Get POST data
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];  // Assuming role is either 'admin' or 'manager'

        // Validate data
        if (empty($username) || empty($password) || empty($role)) {
            echo json_encode(['success' => false, 'error' => 'All fields are required']);
            return;
        }

        // Check if username already exists
        $existingUser = User::findByUsername($username);
        if ($existingUser) {
            echo json_encode(['success' => false, 'error' => 'Username is already taken']);
            return;
        }

        // Hash the password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Create a new User and save it to the database
        $user = new User();
        $user->username = $username;
        $user->password_hash = $password_hash;
        $user->role = $role;

        if ($user->save()) {
            echo json_encode(['success' => true, 'message' => 'Registration successful']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Registration failed']);
        }
    }

    // Login a user
    public function login($username, $password) {
        // Check if the username exists
        $user = User::findByUsername($username);

        if ($user && password_verify($password, $user['password_hash'])) {
            // Return the user if credentials are valid
            return $user;
        }

        // Return false if credentials are invalid
        return false;
    }
}

?>
