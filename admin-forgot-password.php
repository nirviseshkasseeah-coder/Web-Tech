<?php
session_start();
require_once 'db.php'; // your PDO connection

// Rate limiting for admin reset (separate from user resets)
$now = time();
if (isset($_SESSION['admin_last_reset']) && ($now - $_SESSION['admin_last_reset']) < 60) {
    header("Location: email-sent-page.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Decode and sanitize email
    $rawEmail = $_POST['email'] ?? '';
    $decodedEmail = urldecode($rawEmail);
    $email = filter_var(trim($decodedEmail), FILTER_SANITIZE_EMAIL);
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: email-sent-page.php");
        exit;
    }
    
    // Check if email belongs to an admin (join users and admins)
    $stmt = $db->prepare("
        SELECT u.UserID 
        FROM users u
        INNER JOIN admins a ON u.UserID = a.UserID
        WHERE LOWER(u.Email) = LOWER(:email)
    ");
    
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $token = '';
    
    if ($admin) {
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        
        $insert = $db->prepare("INSERT INTO password_resets (Email, Token, Expiry) VALUES (:email, :token, :expiry)");
        $insert->bindParam(':email', $email);
        $insert->bindParam(':token', $token);
        $insert->bindParam(':expiry', $expiry);
        $insert->execute();
    }


    $_SESSION['admin_last_reset'] = $now;
    
    // Build redirect URL (with token only if an admin was found)
    $redirectUrl = 'email-sent-page.php';
    if (!empty($token)) {
        $redirectUrl .= '?token=' . urlencode($token);
    }
    
    
    // Loading animation (same as user version)
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="2;url=' . htmlspecialchars($redirectUrl) . '">
        <title>Processing</title>
        <style>
            body {
                font-family: "Jacques Francois", serif;
                background: #F9F6F1;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                text-align: center;
            }
            .message {
                background: #cbb89d;
                padding: 30px 40px;
                border-radius: 12px;
                box-shadow: 0 12px 10px -10px rgba(0,0,0,0.25);
                color: #4a2c1a;
                font-size: 20px;
            }
            .loader {
                margin-top: 15px;
                width: 30px;
                height: 30px;
                border: 3px solid #e1c699;
                border-top-color: #6F4E37;
                border-radius: 50%;
                animation: spin 1s linear infinite;
                display: inline-block;
            }
            @keyframes spin {
                to { transform: rotate(360deg); }
            }
        </style>
    </head>
    
    <body>
        <div class="message">
            <strong>Processing your request...</strong><br>
            You will be redirected shortly.
            <div class="loader"></div>
        </div>
    </body>
    </html>';

    exit;

    } else {
    // Direct access (GET) – redirect to admin login page
    header("Location: admin-login.html");
    exit;

}
?>