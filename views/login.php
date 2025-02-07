<?php include('header.php'); ?>

<h2>Employee Performance Tracker - Login</h2>

<!-- Login Form -->
<div class="login-form">
    <h3>Login</h3>
    <form id="login-form">
        <input type="text" id="username" name="username" placeholder="Username" required />
        <input type="password" id="password" name="password" placeholder="Password" required />
        <button type="submit">Login</button>
    </form>
</div>

<!-- Link to the login CSS -->
<link rel="stylesheet" href="../assets/css/login.css">

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle form submission using AJAX
        const loginForm = document.getElementById('login-form');
        
        if (loginForm) {
            loginForm.addEventListener('submit', function (event) {
                event.preventDefault();
                
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                
                const data = new FormData();
                data.append('username', username);
                data.append('password', password);
                
                // Sending login request via AJAX
                fetch('/employee-performance-tracker/controllers/UserController.php?action=login', {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirect to the dashboard after successful login
                        window.location.href = '/employee-performance-tracker/views/dashboard.php';
                    } else {
                        alert('Login failed: ' + data.error);
                    }
                })
                .catch(error => alert('Error: ' + error));
            });
        }
    });
</script>

<?php include('footer.php'); ?>
