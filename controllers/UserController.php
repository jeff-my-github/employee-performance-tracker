<?php
// /controllers/UserController.php

include_once '../models/User.php';

class UserController {

    // Register a new user
    public function register() {
        // Set the header to JSON response
        header('Content-Type: application/json');
        
        // Start output buffering to capture all output
        ob_start();

        // Get POST data
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];  // Assuming role is either 'admin' or 'manager'

        // Validate data
        if (empty($username) || empty($password) || empty($role)) {
            echo json_encode(['success' => false, 'error' => 'All fields are required']);
            ob_end_flush();  // Flush the output buffer
            return;
        }

        // Check if username already exists
        $existingUser = User::findByUsername($username);
        if ($existingUser) {
            echo json_encode(['success' => false, 'error' => 'Username is already taken']);
            ob_end_flush();
            return;
        }

        // Hash the password securely using PASSWORD_BCRYPT
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Create a new User object and set the properties
        $user = new User();
        $user->username = $username;
        $user->password_hash = $password_hash;
        $user->role = $role;

        // Attempt to save the user
        if ($user->save()) {
            echo json_encode(['success' => true, 'message' => 'Registration successful']);
        } else {
            echo json_encode(['success' => false, 'error' => 'Registration failed']);
        }

        // Ensure any output is captured
        ob_end_flush();
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

// Initialize the controller and call the register method
if (isset($_GET['action']) && $_GET['action'] == 'register') {
    $controller = new UserController();
    $controller->register();
}
?>
