<?php
// login.php - Login form

session_start();

// Include necessary files
include_once '../controllers/UserController.php';

?>

<!-- HTML Form -->
<form id="login-form">
    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Login</button>
</form>

<!-- Error Message -->
<div id="error-message" style="color: red; text-align: center;"></div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loginForm = document.getElementById('login-form');
        const errorMessage = document.getElementById('error-message');

        loginForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const username = document.querySelector('input[name="username"]').value;
            const password = document.querySelector('input[name="password"]').value;

            const data = new FormData();
            data.append('username', username);
            data.append('password', password);

            // Send login request via AJAX
            fetch('../controllers/UserController.php?action=login', {
                method: 'POST',
                body: data
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // If login is successful, redirect to dashboard
                    alert(data.message);
                    window.location.href = 'dashboard.php';
                } else {
                    // If login failed, show error message
                    errorMessage.style.display = 'block';
                    errorMessage.innerText = data.error;
                }
            })
            .catch(error => {
                // Handle errors from AJAX request
                console.error('Error:', error);
                errorMessage.style.display = 'block';
                errorMessage.innerText = 'An error occurred. Please try again.';
            });
        });
    });
</script>
