
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
        <button type="submit" id="submit-btn">Register</button>
        <div id="error-message" style="color: red; text-align: center; display: none;"></div>
    </form>
</div>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const registerForm = document.getElementById('register-form');
    const errorMessage = document.getElementById('error-message');
    const submitButton = document.getElementById('submit-btn');

    registerForm.addEventListener('submit', function (event) {
        event.preventDefault();

        // Clear previous error message
        errorMessage.style.display = 'none';
        errorMessage.innerText = '';

        // Disable submit button during request
        submitButton.disabled = true;
        submitButton.innerText = 'Registering...';

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;
        const role = document.getElementById('role').value;

        const data = new FormData();
        data.append('username', username);
        data.append('password', password);
        data.append('role', role);

        // Send registration request via AJAX
        fetch('../controllers/UserController.php?action=register', {
            method: 'POST',
            body: data
        })
        .then(response => {
            // Log the raw response body for debugging
            console.log('Raw Response:', response);
            return response.text();  // Get the response as text first
        })
        .then(text => {
            console.log('Response Text:', text);  // Log the response text

            try {
                const data = JSON.parse(text);  // Attempt to parse as JSON
                // Handle the response as usual
                submitButton.disabled = false;
                submitButton.innerText = 'Register';

                if (data.success) {
                    // Redirect to login page after successful registration
                    alert(data.message);
                    window.location.href = '../views/login.php';
                } else {
                    // Show error message if registration failed
                    errorMessage.style.display = 'block';
                    errorMessage.innerText = 'Registration failed: ' + data.error;
                }
            } catch (error) {
                console.error('Error parsing JSON:', error);
                submitButton.disabled = false;
                submitButton.innerText = 'Register';
                errorMessage.style.display = 'block';
                errorMessage.innerText = 'An error occurred. Please try again.';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            submitButton.disabled = false;
            submitButton.innerText = 'Register';
            errorMessage.style.display = 'block';
            errorMessage.innerText = 'An error occurred. Please try again.';
        });
    });
});



</script>

<?php include('footer.php'); ?>
