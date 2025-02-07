<?php
// login.php - Login form

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $userController = new UserController();
    $user = $userController->login($username, $password);

    if ($user) {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
    } else {
        $error = "Invalid credentials!";
    }
}

?>

<form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Login</button>
</form>

<?php if (isset($error)) echo $error; ?>
