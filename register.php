<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // Personal Information
    $fullname = $_POST['fullname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $phone = $_POST['tel'];
    $email = $_POST['email'];
        
    // Address
    $street = $_POST['street'];
    $city = $_POST['city'];
    $province = $_POST['province'];
    $zip = $_POST['zipcode'];
    $country = $_POST['country'];

    // Account Information
    $username = $_POST['username'];
    $password = $_POST['newpass'];
    $confirm = $_POST['confirm'];   
    
    $full_name_pattern = "/^[A-Za-z ]{2,50}$/";
    $date_of_birth = $_POST['dob'];
    $phone_pattern = "/^63\d{9}$/";
    $email_pattern = "/^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/";

    // Address Details
    $street_pattern = "/^[A-Za-z0-9\s.,#\-]{5,100}$/";
    $city_pattern = "/^[A-Za-z ]{2,50}$/";
    $province_pattern = "/^[A-Za-z ]{2,50}$/";
    $zip_pattern = "/^\d{4}$/";
    $country_pattern = "/^[A-Za-z ]+$/";

   
    $username_pattern = "/^\w{5,20}$/";
    $password_pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/";
    $dob = DateTime::createFromFormat('Y-m-d', $_POST['dob']);
    $today = new DateTime();
    $age = $today->diff($dob)->y;
    $errors = [];

    if (!preg_match($full_name_pattern, $_POST['fullname'])) {
        $errors[] = "Full name must be 2-50 letters and spaces only.";
    }

    if ($age < 18) {
        $errors[] = "You must be at least 18 years old.";
    }

    if (!preg_match($phone_pattern, $_POST['tel'])) {
        $errors[] = "Phone number must be 11 digits and start with 09.";
    }

    if (!preg_match($email_pattern, $_POST['email'])) {
        $errors[] = "Invalid email format.";
    }

    if (!preg_match($street_pattern, $_POST['street'])) {
        $errors[] = "Street must be 5-100 characters, valid address symbols only.";
    }

    if (!preg_match($city_pattern, $_POST['city'])) {
        $errors[] = "City must be 2-50 letters and spaces only.";
    }

    if (!preg_match($province_pattern, $_POST['province'])) {
        $errors[] = "Province/State must be 2-50 letters and spaces only.";
    }

    if (!preg_match($zip_pattern, $_POST['zipcode'])) {
        $errors[] = "Zip code must be 4 digits.";
    }

    if (!preg_match($country_pattern, $_POST['country'])) {
        $errors[] = "Country must be letters and spaces only.";
    }

    if (!preg_match($username_pattern, $_POST['username'])) {
        $errors[] = "Username must be 5-20 characters, letters, numbers, and underscores only.";
    }

    if (!preg_match($password_pattern, $_POST['newpass'])) {
        $errors[] = "Password must be at least 8 characters, with uppercase, lowercase, digit, and special character.";
    }

    if ($_POST['newpass'] !== $_POST['confirm']) {
        $errors[] = "Passwords do not match.";
    }   
    
    if ($password !== $confirm){
        echo "<script>alert('Passwords do not match. Please try again.'); 
        window.history.back();</script>";
    }
    


    if (!empty($errors)) {
    foreach ($errors as $error) {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'> 
        $error<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
        }
    }
    else {
        $line = implode("|", [
            $fullname, $gender, $dob, $phone, $email,
            $street, $city, $province, $zip, $country,
            $username, $password
        ]) . "\n";
        file_put_contents("users.txt", $line, FILE_APPEND);

        echo "<script>
            alert('Registration successful! Proceeding to login...');
            window.location.href = 'login.php';
        </script>";
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
            </div>
        </div>
    </nav>
      
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h2 class="mb-4 text-center">Create Your Account</h2>
                    <form method="POST" action="register.php">
                        <h4 class="mb-3">Personal Information</h4>
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" name="fullname" class="form-control" id="name" placeholder="Enter your full name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" class="form-select" id="gender" required>
                                    <option value="">Choose</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Prefer not to say</option>
                                    <option>Other</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" id="date" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" name="tel" class="form-control" id="phone" placeholder="e.g., +639123456789" required>
                            </div>
                            <div class="col-md-6">
                                <label for="emailRegister" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
                            </div>
                        </div>

                        <h4 class="mb-3">Address Details</h4>
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label for="street" class="form-label">Street Address</label>
                                <input type="text" name="street" class="form-control" id="street" placeholder="123 Main St" required>
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" name="city" class="form-control" id="city" required>
                            </div>
                            <div class="col-md-6">
                                <label for="provinceState" class="form-label">Province/State</label>
                                <input type="text" name="province" class="form-control" id="provinceState" required>
                            </div>
                            <div class="col-md-6">
                                <label for="zipCode" class="form-label">Zip Code</label>
                                <input type="text" name="zipcode" class="form-control" id="zipCode" required>
                            </div>
                            <div class="col-md-6">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select" name="country" id="country" required>
                                    <option value="">Choose...</option>
                                    <option>Philippines</option>
                                    <option>United States</option>
                                    <option>Canada</option>
                                    <option>United Kingdom</option>
                                    <option>Australia</option>
                                    <option>Other</option>
                                </select>
                            </div>
                        </div>

                        <h4 class="mb-3">Account Details</h4>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">@</span>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                                    <div class="invalid-feedback">
                                        Your username is required.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="newPassword" class="form-label">Password</label>
                                <input type="password" name="newpass" class="form-control" id="newPassword" required>
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm" class="form-control" id="newPassword" required>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button class="btn btn-secondary btn-lg" name="submit" type="submit">Register</button>
                        </div>

                        <div class="d-grid gap-2 mt-2">
                            <button type="reset" class="btn btn-outline-secondary btn-lg">Reset</button>
                        </div>
                    </form>
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

