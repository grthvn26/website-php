<?php
$message = "";

$fullnameErr = $genderErr = $dobErr = $phoneErr = $emailErr = "";
$streetErr = $cityErr = $provinceErr = $zipErr = $countryErr = "";
$usernameErr = $passwordErr = $confirmErr = "";

// Initialize variables to retain user input
$fullname = $gender = $dob = $phone = $email = "";
$street = $city = $province = $zip = $country = "";
$username = $password = $confirm = "";

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    // Personal Information
    $fullname = trim($_POST['fullname']);
    $gender = isset($_POST['gender']) ? trim($_POST['gender']) : ''; // Check if gender is set
    $dob = trim($_POST['dob']);
    $phone = trim($_POST['tel']);
    $email = trim($_POST['email']);
        
    // Address
    $street = trim($_POST['street']);
    $city = trim($_POST['city']);
    $province = trim($_POST['province']);
    $zip = trim($_POST['zipcode']);
    $country = isset($_POST['country']) ? trim($_POST['country']) : ''; // Check if country is set

    // Account Information
    $username = trim($_POST['username']);
    $password = trim($_POST['newpass']);
    $confirm = trim($_POST['confirm']);    
    
    // Regular expressions for validation
    $full_name_pattern = "/^[A-Za-z ]{2,50}$/";
    $phone_pattern = "/^09\d{9}$/";
    $email_pattern = "/^[A-Za-z0-9._-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/";
    $street_pattern = "/^[A-Za-z0-9\s.,#\-]{5,100}$/";
    $city_pattern = "/^[A-Za-z ]{2,50}$/";
    $province_pattern = "/^[A-Za-z ]{2,50}$/";
    $zip_pattern = "/^\d{4}$/";
    $country_pattern = "/^[A-Za-z ]+$/";
    $username_pattern = "/^\w{5,20}$/";
    $password_pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/";

    // Date of Birth and Age validation
    $dobObj = DateTime::createFromFormat('Y-m-d', $dob);
    $today = new DateTime();
    $age = $dobObj ? $today->diff($dobObj)->y : 0;

    // --- Validation Checks ---

    if (!preg_match($full_name_pattern, $fullname)) {
        $fullnameErr = "<div class='text-danger small mt-1'>Full name must be 2-50 letters and spaces only.</div>";
    }

    if (empty($gender)) {
        $genderErr = "<div class='text-danger small mt-1'>Please select a gender.</div>";
    }

    if (!$dobObj || $age < 18) {
        $dobErr = "<div class='text-danger small mt-1'>You must be at least 18 years old.</div>";
    }

    if (!preg_match($phone_pattern, $phone)) {
        $phoneErr = "<div class='text-danger small mt-1'>Phone number must be 11 digits and start with 09.</div>";
    }

    if (!preg_match($email_pattern, $email)) {
        $emailErr = "<div class='text-danger small mt-1'>Invalid email format.</div>";
    }

    if (!preg_match($street_pattern, $street)) {
        $streetErr = "<div class='text-danger small mt-1'>Street must be 5-100 characters, valid address symbols only.</div>";
    }

    if (!preg_match($city_pattern, $city)) {
        $cityErr = "<div class='text-danger small mt-1'>City must be 2-50 letters and spaces only.</div>";
    }

    if (!preg_match($province_pattern, $province)) {
        $provinceErr = "<div class='text-danger small mt-1'>Province/State must be 2-50 letters and spaces only.</div>";
    }

    if (!preg_match($zip_pattern, $zip)) {
        $zipErr = "<div class='text-danger small mt-1'>Zip code must be 4 digits.</div>";
    }

    if (empty($country) || !preg_match($country_pattern, $country)) {
        $countryErr = "<div class='text-danger small mt-1'>Country must be selected and contain letters and spaces only.</div>";
    }

    if (!preg_match($username_pattern, $username)) {
        $usernameErr = "<div class='text-danger small mt-1'>Username must be 5-20 characters, letters, numbers, and underscores only.</div>";
    }

    if (!preg_match($password_pattern, $password)) {
        $passwordErr = "<div class='text-danger small mt-1'>Password must be at least 8 characters, with uppercase, lowercase, digit, and special character.</div>";
    }

    if ($password !== $confirm) {
        $confirmErr = "<div class='text-danger small mt-1'>Passwords do not match.</div>";
    }

    // --- Check if all validations pass ---
    if (
        empty($fullnameErr) && empty($genderErr) && empty($dobErr) && empty($phoneErr) && empty($emailErr) &&
        empty($streetErr) && empty($cityErr) && empty($provinceErr) && empty($zipErr) && empty($countryErr) &&
        empty($usernameErr) && empty($passwordErr) && empty($confirmErr)
    ) {
        $line = implode("|", [
            $fullname, $gender, $dob, $phone, $email,
            $street, $city, $province, $zip, $country,
            $username, $password
        ]) . "\n";
        file_put_contents("users.txt", $line, FILE_APPEND); // Appends user data to 'users.txt'

        echo "<script>
            alert('Registration successful! Proceeding to login...');
            window.location.href = 'login.php';
        </script>";
        exit; // Important to exit after redirection
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
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
<main>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <h2 class="mb-4 text-center">Create Your Account</h2>
                    <form method="POST" action="register.php">
                        <h4 class="mb-3">Personal Information</h4>
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label for="fullName" class="form-label">Full Name</label>
                                <input type="text" name="fullname" class="form-control" id="fullName" placeholder="Enter your full name" value="<?php echo htmlspecialchars($fullname); ?>" required>
                                <?php if (!empty($fullnameErr)) echo $fullnameErr; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Gender</label>
                                <select name="gender" class="form-select" id="gender" required>
                                    <option value="">Choose</option>
                                    <option value="Male" <?php if(isset($gender) && $gender=="Male") echo "selected"; ?>>Male</option>
                                    <option value="Female" <?php if(isset($gender) && $gender=="Female") echo "selected"; ?>>Female</option>
                                    <option value="Prefer not to say" <?php if(isset($gender) && $gender=="Prefer not to say") echo "selected"; ?>>Prefer not to say</option>
                                    <option value="Other" <?php if(isset($gender) && $gender=="Other") echo "selected"; ?>>Other</option>
                                </select>
                                <?php if (!empty($genderErr)) echo $genderErr; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" name="dob" class="form-control" id="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
                                <?php if (!empty($dobErr)) echo $dobErr; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone Number</label>
                                <input type="tel" name="tel" class="form-control" id="phone" placeholder="e.g., 09123456789" value="<?php echo htmlspecialchars($phone); ?>" required>
                                <?php if (!empty($phoneErr)) echo $phoneErr; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="mail" name="email" class="form-control" id="email" placeholder="you@example.com" value="<?php echo htmlspecialchars($email); ?>" required>
                                <?php if (!empty($emailErr)) echo $emailErr; ?>
                            </div>
                        </div>

                        <h4 class="mb-3">Address Details</h4>
                        <div class="row g-3 mb-3">
                            <div class="col-12">
                                <label for="street" class="form-label">Street Address</label>
                                <input type="text" name="street" class="form-control" id="street" placeholder="123 Main St" value="<?php echo htmlspecialchars($street); ?>" required>
                                <?php if (!empty($streetErr)) echo $streetErr; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" name="city" class="form-control" id="city" value="<?php echo htmlspecialchars($city); ?>" required>
                                <?php if (!empty($cityErr)) echo $cityErr; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="provinceState" class="form-label">Province/State</label>
                                <input type="text" name="province" class="form-control" id="provinceState" value="<?php echo htmlspecialchars($province); ?>" required>
                                <?php if (!empty($provinceErr)) echo $provinceErr; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="zipCode" class="form-label">Zip Code</label>
                                <input type="text" name="zipcode" class="form-control" id="zipCode" value="<?php echo htmlspecialchars($zip); ?>" required>
                                <?php if (!empty($zipErr)) echo $zipErr; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select" name="country" id="country" required>
                                    <option value="">Choose...</option>
                                    <option value="Philippines" <?php if(isset($country) && $country=="Philippines") echo "selected"; ?>>Philippines</option>
                                    <option value="United States" <?php if(isset($country) && $country=="United States") echo "selected"; ?>>United States</option>
                                    <option value="Canada" <?php if(isset($country) && $country=="Canada") echo "selected"; ?>>Canada</option>
                                    <option value="United Kingdom" <?php if(isset($country) && $country=="United Kingdom") echo "selected"; ?>>United Kingdom</option>
                                    <option value="Australia" <?php if(isset($country) && $country=="Australia") echo "selected"; ?>>Australia</option>
                                    <option value="Other" <?php if(isset($country) && $country=="Other") echo "selected"; ?>>Other</option>
                                </select>
                                <?php if (!empty($countryErr)) echo $countryErr; ?>
                            </div>
                        </div>

                        <h4 class="mb-3">Account Details</h4>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label for="username" class="form-label">Username</label>
                                <div class="input-group has-validation">
                                    <span class="input-group-text">@</span>
                                    <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" required>
                                </div>
                                <?php if (!empty($usernameErr)) echo $usernameErr; ?>
                            </div>
                            <div class="col-md-6">
                                <label for="newPassword" class="form-label">Password</label>
                                <input type="password" name="newpass" class="form-control" id="newPassword" required>
                                <?php if (!empty($passwordErr)) echo $passwordErr; ?>
                            </div>
                            <div class="col-md-6"> <!-- Moved to its own column for better layout -->
                                <label for="confirmPassword" class="form-label">Confirm Password</label>
                                <input type="password" name="confirm" class="form-control" id="confirmPassword" required>
                                <?php if (!empty($confirmErr)) echo $confirmErr; ?>
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
