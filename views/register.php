<!-- /views/register.php -->
<?php include('header.php'); ?>
<link rel="stylesheet" href="../assets/css/register.css">

<h2>Employee Performance Tracker - Register</h2>

<!-- Registration Form -->
<div class="register-form">
    <h3>Create an Account</h3>
    <form id="register-form">
        <input type="text" id="username" name="username" placeholder="Username" required />
        <input type="password" id="password" name="password" placeholder="Password" required />
        <select id="role" name="role" required>
            <option value="manager">Manager</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Register</button>
        <div id="error-message" style="color: red; text-align: center; display: none;"></div>
    </form>
</div>

<!-- Link to the register CSS -->
<link rel="stylesheet" href="../assets/css/register.css">

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const registerForm = document.getElementById('register-form');
        const errorMessage = document.getElementById('error-message');
        
        if (registerForm) {
            registerForm.addEventListener('submit', function (event) {
                event.preventDefault();
                
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                const role = document.getElementById('role').value;
                
                const data = new FormData();
                data.append('username', username);
                data.append('password', password);
                data.append('role', role);
                
                // Sending registration request via AJAX
                fetch('../controllers/UserController.php?action=register', {
                    method: 'POST',
                    body: data
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Redirect to login page after successful registration
                        alert('Registration successful! Please login.');
                        window.location.href = '../views/login.php';
                    } else {
                        // Show error message if registration failed
                        errorMessage.style.display = 'block';
                        errorMessage.innerText = 'Registration failed: ' + data.error;
                    }
                })
                .catch(error => {
                    // Handle error
                    alert('Error: ' + error);
                    errorMessage.style.display = 'block';
                    errorMessage.innerText = 'Error: ' + error;
                });
            });
        }
    });
</script>

<?php include('footer.php'); ?>
