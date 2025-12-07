<?php
require_once "db.php";

$username = $email = "";
$usernameErr = $emailErr = $passwordErr = $confirmPasswordErr = "";
$successMsg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
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

    // If no errors, insert into DB
    if (empty($usernameErr) && empty($emailErr) && empty($passwordErr) && empty($confirmPasswordErr)) {
        try {
            $hashed_password = password_hash($pass1, PASSWORD_DEFAULT);

            // Insert into Users table
            $sql_insert_users = "INSERT INTO Users (Username, Email, Password) VALUES (:username, :email, :password)";
            $stmt = $db->prepare($sql_insert_users);
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);
            $stmt->execute();

            // Get the new UserID
            $newUserID = $db->lastInsertId();

            // Insert into RegisteredUsers table
            $sql_insert_registeredUsers = "INSERT INTO RegisteredUsers (UserID) VALUES (:userID)";
            $stmt2 = $db->prepare($sql_insert_registeredUsers);
            $stmt2->bindParam(":userID", $newUserID, PDO::PARAM_INT);
            $stmt2->execute();


            $successMsg = "Account created successfully for " . htmlspecialchars($username) . " Login from Home page to access Account";

            // Clear input fields
            $username = $email = "";

        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $emailErr = "Username or Email already exists.";
            } else {
                $successMsg = "Database error: " . $e->getMessage();
            }
        }
    }
}

// function to sanitize user inputs
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

        <?php if ($successMsg != ""): ?>
            <p class = "info"><?php echo $successMsg; ?></p>
        <?php endif; ?>

        <form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" novalidate>

            <label>Username</label>
            <input type="text" name="txt_username" value="<?php echo
            htmlspecialchars($username); ?>"
                required minlength="3" maxlength="45" pattern="[a-zA-Z0-9_ ]{3,45}"
                title="Only letters, numbers, and underscores" placeholder="Enter your username">
            <span class="error"><?php echo $usernameErr; ?></span><br>

            <label>Email</label>
            <input type="email" name="txt_email"  value="<?php echo htmlspecialchars($email); ?>" 
                required title="Enter a valid email" placeholder="Enter your email">
            <span class="error"><?php echo $emailErr; ?></span><br>

            <label>Password</label>
            <input type="password" name="txt_password" autocomplete="new-password"
                required pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_\-])[A-Za-z\d!@#$%^&*()_\-]{8,255}"
                title="Password must be 8-255 chars, include at least 1 uppercase, 1 lowercase, 1 number, and 1 special char."
                placeholder="Enter your password">
            <span class="error"><?php echo $passwordErr; ?></span><br>

            <label>Confirm Password</label>
            <input type="password" name="txt_confirm_password" autocomplete="new-password"
                required pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_\-])[A-Za-z\d!@#$%^&*()_\-]{8,255}"
                placeholder="Re-enter your password">
            <span class="error"><?php echo $confirmPasswordErr; ?></span><br>

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