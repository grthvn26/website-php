
<?php
session_start();

if (!isset($_SESSION['user_data']) || !is_array($_SESSION['user_data']) || count($_SESSION['user_data']) < 12) {
    header("Location: login.php");
    exit;
}


$userData = $_SESSION['user_data'];
$fullname = htmlspecialchars($userData[0] ?? '');
$gender = htmlspecialchars($userData[1] ?? '');
$dob = htmlspecialchars($userData[2] ?? '');
$phone = htmlspecialchars($userData[3] ?? ''); 
$email = htmlspecialchars($userData[4] ?? '');
$street = htmlspecialchars($userData[5] ?? '');
$city = htmlspecialchars($userData[6] ?? '');
$province = htmlspecialchars($userData[7] ?? '');
$zipcode = htmlspecialchars($userData[8] ?? '');
$country = htmlspecialchars($userData[9] ?? '');
$username = htmlspecialchars($userData[10] ?? ''); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome!</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <div class="container">
            <a class="navbar-brand" href="#">Website</a>
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
                <a class="btn btn-primary" href="logout.php">Logout</a>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <h1 class="mb-4">
                        <?php
                        echo "Welcome, " . htmlspecialchars($fullname) . "!";
                        ?>
                    </h1>
                    <p class="lead">Personal Information:</p>
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Full Name:</strong> <?php echo $fullname; ?></li>
                        <li class="list-group-item"><strong>Gender:</strong> <?php echo $gender; ?></li>
                        <li class="list-group-item"><strong>Date of Birth:</strong> <?php echo $dob; ?></li>
                        <li class="list-group-item"><strong>Phone Number:</strong> <?php echo $phone; ?></li>
                        <li class="list-group-item"><strong>Email:</strong> <?php echo $email; ?></li>
                        <li class="list-group-item"><strong>Street:</strong> <?php echo $street; ?></li>
                        <li class="list-group-item"><strong>City:</strong> <?php echo $city; ?></li>
                        <li class="list-group-item"><strong>Province:</strong> <?php echo $province; ?></li>
                        <li class="list-group-item"><strong>Zip Code:</strong> <?php echo $zipcode; ?></li>
                        <li class="list-group-item"><strong>Country:</strong> <?php echo $country; ?></li>
                        <li class="list-group-item"><strong>Username:</strong> <?php echo $username; ?></li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-secondary text-white text-center py-3 mt-auto">
        <div class="container">
            <p>&copy; 2025 Aaron Arevalo, UE Manila. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>