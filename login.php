<?php
    session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['newpass'];
    $users = file("users.txt", FILE_IGNORE_NEW_LINES);
    $found = false;

    foreach ($users as $userLine){
        $data = explode("|", $userLine);
        if ($data[10] === $inputUsername && $data[11] === $inputPassword) {
            $found = true;
            $_SESSION['user_data'] = $data;
            header("Location: welcome.php");
            exit;
        }
    }

    if (!$found) {
        echo "<div class='alert alert-danger' role='alert'>Invalid username or password.</div>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="home.php">Website</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Services</a>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>

    
  <main class="flex-grow-1">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <h5 class="mb-3 text-center">Login</h5>
                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="name" name="username" class="form-control" id="email" placeholder="Enter username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="newpass" class="form-control" id="password" placeholder="Password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-dark">Login</button>
                        <p>New account? Register below</p>
                        <a class="btn btn-primary" href="register.php">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

    
    <footer class="bg-secondary text-white text-center py-3 mt-auto">
    </footer>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
