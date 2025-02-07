<?php include('header.php'); ?>

<!-- Login Section -->
<div class="login-container">
    <h2>Employee Performance Tracker - Login</h2>

    <!-- Login Form -->
    <div class="login-form">
        <h3>Login</h3>
        <form id="login-form">
            <input type="text" id="username" name="username" placeholder="Username" required />
            <input type="password" id="password" name="password" placeholder="Password" required />
            <button type="submit">Login</button>
            <!-- Error message will be displayed here -->
            <div id="error-message" style="color: red; text-align: center; display: none;">Login failed. Please check your username and password.</div>
        </form>
    </div>
</div>

<!-- Link to the login CSS -->
<link rel="stylesheet" href="../assets/css/login.css">

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Handle form submission using AJAX
        const loginForm = document.getElementById('login-form');
        const errorMessage = document.getElementById('error-message');
        
        if (loginForm) {
            loginForm.addEventListener('submit', function (event) {
                event.preventDefault();
                
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                
                const data = new FormData();
                data.append('username', username);
                data.append('password', password);
                
                // Sending login request via AJAX
                fetch('../controllers/UserController.php?action=login', {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirect to the dashboard after successful login
                        window.location.href = '../views/dashboard.php';
                    } else {
                        // Show error message if login failed
                        errorMessage.style.display = 'block';
                    }
                })
                .catch(error => {
                    // Handle error
                    alert('Error: ' + error);
                    errorMessage.style.display = 'block';
                });
            });
        }
    });
</script>

<?php include('footer.php'); ?>
