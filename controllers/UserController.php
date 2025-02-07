<?php
// Sample UserController.php for handling login requests

require_once '../models/User.php';

class UserController {

    // Handle login
    public function login($username, $password) {
        $user = new User();
        
        // Validate user credentials
        $result = $user->checkCredentials($username, $password);
        
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid username or password']);
        }
    }

    // Handle requests based on the 'action' query parameter
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = isset($_GET['action']) ? $_GET['action'] : null;

            if ($action === 'login') {
                if (isset($_POST['username'], $_POST['password'])) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];

                    // Call the login function
                    $this->login($username, $password);
                } else {
                    echo json_encode(['success' => false, 'error' => 'Missing username or password']);
                }
            } else {
                echo json_encode(['success' => false, 'error' => 'Invalid action']);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid request method']);
        }

        exit;
    }
}

// Make sure to call handleRequest to trigger login handling
$controller = new UserController();
$controller->handleRequest();
