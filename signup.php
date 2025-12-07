<?php
# Setting up form to be displayed.

require_once "db.php";

$username = $email = "";
$usernameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";
$successMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Trim and sanitize inputs
    $username = sanitize_data($_POST["txt_username"]);
    $email = filter_var(trim($_POST["txt_email"]), FILTER_SANITIZE_EMAIL);
    $pass1 = $_POST["txt_password"];
    $pass2 = $_POST["txt_confirm_password"];

    // Validate username
    if (empty($username)) {
        $usernameErr = "Username is required.";
    } elseif (!preg_match('/^[a-zA-Z0-9_ ]{3,45}$/', $username)) {
        $usernameErr = "Username must be 3-45 characters long and contain only letters, numbers, and underscores.";
    }

    // Validate email
    if (empty($email)) {
        $emailErr = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,}$/', $email)) {
        $emailErr = "Please enter a valid email address.";
    }

    // Validate password
    if (empty($pass1)) {
        $passwordErr = "Password is required.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_\-])[A-Za-z\d!@#$%^&*()_\-]{8,255}$/', $pass1)) {
        $passwordErr = "Password must be 8-255 chars, include at least 1 uppercase, 1 lowercase, 1 number, and 1 special char.";
    }

    // Confirm password
    if ($pass1 !== $pass2) {
        $confirmPasswordErr = "Passwords do not match.";
    }
}

function sanitize_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data); 
  return $data;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "UTF-8">
    <title>Account Creation Page</title>
    <link rel = "stylesheet" href = "style.css">
</head>

<body>
<div class = "top-bar">
    <button class = "nav-btn">Home</button>
    <button class = "nav-btn right">About us</button>
</div>

<div class = "body-img">
    <h1 class = "tagline" >Sign Up, Sip Up, Reward Up!</h1>

    <div class = "card">
        <h2 class = "card-title">Sign Up</h2>

        <div class = "logo-circle">
            <img src = "logo.png" alt = "Ryan Coffee Shop Logo">
        </div>

        <?php if ($message != ""): ?>
            <p class = "info"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method = "post" class = "form input">
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter your username">

            <label>Email</label>
            <input type="text" name="email" placeholder="Enter your email">

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password">

            <label>Confirm password</label>
            <input type="password" name="confirm password" placeholder="Re-enter your password">

            <button type="submit" class="submit-btn">Sign Up</button>
        </form>
    </div>
</div>

<div class="footer">
    <p>PRIVACY POLICY | TERMS OF USE</p>
    <p>YOUR PRIVACY RIGHTS | CHILDREN'S PRIVACY POLICY</p>
    <p>INTEREST BASED ADS | DO NOT SELL MY INFO</p>
    <p>© 2004-2005 | Kasseeah Nirvisesh</p>
</div>

</body>
</html>