<?php
// login.php - Login form

session_start();

// Include necessary files
include_once '../controllers/UserController.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle the login request using UserController
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userController = new UserController();
    $user = $userController->login($username, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit();  // Ensure no further code is executed
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!-- HTML Form -->
<form method="POST" action="login.php">
    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Login</button>
</form>

<?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>

<!-- Include JS for AJAX-based login -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loginForm = document.querySelector('form');
        const errorMessage = document.getElementById('error-message');

        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();

            const username = document.querySelector('input[name="username"]').value;
            const password = document.querySelector('input[name="password"]').value;

            const data = new FormData();
            data.append('username', username);
            data.append('password', password);

            fetch('login.php', {
                method: 'POST',
                body: data
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('Invalid credentials')) {
                    errorMessage.innerHTML = "Invalid credentials!";
                } else {
                    window.location.href = "dashboard.php"; // Redirect to dashboard
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorMessage.innerHTML = "An error occurred!";
            });
        });
    });
</script>

<div id="error-message" style="color: red; text-align: center;"></div>
