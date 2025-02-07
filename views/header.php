<!-- /views/header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employee Performance Tracker</title>
    
    <!-- Bootstrap CSS (CDN or local file) -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- External CSS for header -->
    <link rel="stylesheet" href="../assets/css/header.css">

    <!-- External JavaScript -->
    <script src="../assets/js/app.js" defer></script>
    
    <!-- Optional favicon -->
    <link rel="icon" href="../assets/images/Fire Logo Png Svg Free Download - Fire Logo PNG Transparent With Clear Background ID 275709 _ TopPNG.jpg" type="image/png">
</head>
<body>
    <header class="bg-light py-3 shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo / Branding -->
            <div class="logo">
                <a href="../views/index.php">
                    <img src="../assets/images/Fire Logo Png Svg Free Download - Fire Logo PNG Transparent With Clear Background ID 275709 _ TopPNG.jpg" alt="Employee Performance Tracker Logo" class="img-fluid" />
                </a>
            </div>

            <!-- Navigation Menu -->
            <nav>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="../views/dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/performance.php">Performance</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../views/export.php">Export Data</a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    <div class="content">
