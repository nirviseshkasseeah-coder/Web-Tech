<?php
session_start();
require_once 'db.php';

$email = $password = "";
$emailErr = $passwordErr = "";

//initializing lockout tracking
if (!isset($_SESSION['login_attempts'])) { 
    $_SESSION['login_attempts'] = 0; 
}
if (!isset($_SESSION['lockout_time'])) { 
    $_SESSION['lockout_time'] = 0; 
}

// Clear previous session messages
unset($_SESSION['loginErr']);
unset($_SESSION['successMsg']);

//check if the user trying to login is curently locked out
if (time() < $_SESSION['lockout_time']) {

    $_SESSION['loginErr'] = "Too many failed attempts. Try again in 5 minutes.";
    header("Location: index.php#contact");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitize email (password is left untouched)
    $email = filter_var(trim($_POST["txt_email"]), FILTER_SANITIZE_EMAIL);
    $password =$_POST['txt_password'];

    // Validate email entry
    if (empty($email)) {
        $emailErr = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) || !preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[A-Za-z]{2,}$/', $email)) {
        $emailErr = "Please enter a valid email address.";
    }

    // Validate password entry
    if (empty($password)) {
        $passwordErr = "Password is required.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*()_\-])[A-Za-z\d!@#$%^&*()_\-]{8,255}$/', $password)) {
        $passwordErr = "Password must be 8-255 chars, include at least 1 uppercase, 1 lowercase, 1 number, and 1 special char.";
    }

    // If validation errors exist, save in session and redirect (to same page for testing purposes)
    if (!empty($emailErr) || !empty($passwordErr)) {
        $_SESSION['loginErr'] = $emailErr . " " . $passwordErr;
        header("Location: index.php");
        exit;
    }

    // If no validation errors, check user in database (Users and RegisteredUsers tables)
    try {
        $sql_login_check = "SELECT u.UserID, u.Password 
                            FROM Users u 
                            INNER JOIN RegisteredUsers r ON u.UserID = r.UserID 
                            WHERE u.Email = :email";

        $stmt = $db->prepare($sql_login_check);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    
        // storing SELECT statement values into a variable
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['Password'])) {

            //if password verification fails... increment failed attempts
            $_SESSION['login_attempts']++;

            //if falied attempts reaches 3 attempts then, lock out user for 180 secs (3mins)
            if ($_SESSION['login_attempts'] >= 3) { 

                $_SESSION['lockout_time'] = time() + (3 * 60); // 3 minutes
                $_SESSION['login_attempts'] = 0; // reset attempts after locking
                $_SESSION['loginErr'] = "Too many failed attempts. Account locked for 3 minutes."; 
            
            } else {
                $_SESSION['loginErr'] = "Invalid email or password."; 
            }     
            
            //if 3 or more failed attempts occurs. lock account for 3 minsredirect to same page, for testing purposes. Otherwise show normal error message
            header("Location: index.php#contact"); 
            exit;

        } else {
            
            // Start session for registered user
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['role'] = 'user';
            $_SESSION['successMsg'] = "Login successful!";

            // Reset lockout tracking. Reset failed login attempts and lockout time after successful login.
            $_SESSION['login_attempts'] = 0; 
            $_SESSION['lockout_time'] = 0; 
        
            // Redirect back to index.php for testing purpose
            header("Location: index.php#contact");
            exit;
        }

    } catch (PDOException $e) {
        $_SESSION['loginErr'] = "Database error: " . $e->getMessage();
        header("Location: index.php");
        exit;
    }
}

?>