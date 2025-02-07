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
        public function login() {
        // Set the header to JSON response
        header('Content-Type: application/json');
        
        // Get POST data
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validate data
        if (empty($username) || empty($password)) {
            echo json_encode(['success' => false, 'error' => 'Both username and password are required']);
            return;
        }

        // Attempt to find the user
        $user = User::findByUsername($username);

        if ($user && password_verify($password, $user['password_hash'])) {
            // User found and password matches
            echo json_encode(['success' => true, 'message' => 'Login successful']);
        } else {
            // User not found or password does not match
            echo json_encode(['success' => false, 'error' => 'Invalid username or password']);
        }
        }
    }

    // Call the login method if the 'action' is 'login'
    if (isset($_GET['action']) && $_GET['action'] === 'login') {
    $controller = new UserController();
    $controller->login();
    }
?>
