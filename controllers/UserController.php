<?php
require_once '../models/User.php';

class UserController {

    // Login
    public function login($username, $password) {
        $user = new User();
        return $user->authenticate($username, $password);
    }

    // Register a new user
    public function register($username, $password, $role) {
        $user = new User();
        return $user->register($username, $password, $role);
    }
}
?>
