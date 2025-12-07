<?php
session_start();
require_once 'db.php';

$email = $password = "";
$emailErr = $passwordErr = "";

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
}

?>