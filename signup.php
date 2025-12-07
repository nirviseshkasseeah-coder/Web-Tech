<?php
# Setting up form to be displayed.
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pass1 = $_POST["password"];
    $pass2 = $_POST["confirm_password"];

    # Messages to be displayed depending on the error made by user.
    if ($username == "" || $email == "" || $pass1 == "" || $pass2 == "") {
        $message = "Please fill in all the fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Email is not valid!";
    } elseif ($pass1 != $pass2) {
        $message = "Passwords do not match!";
    } else {
        $message = "Account setup successfully for " .
htmlspecialchars($username);
    }
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