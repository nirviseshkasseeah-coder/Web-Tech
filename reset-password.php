<?php
session_start();
require_once 'db.php'; // your PDO connection

$token = $_GET['token'] ?? '';
$error = '';
$success = '';

if (empty($token)) {
    die("No reset token provided.");
}

$stmt = $db->prepare("SELECT Email, Expiry FROM password_resets WHERE Token = :token");
$stmt->bindParam(':token', $token);
$stmt->execute();
$reset = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$reset) {
    die("Invalid or expired reset token.");
}

if (strtotime($reset['Expiry']) < time()) {
    die("Token has expired. Please request a new reset link.");
}

$email = $reset['Email'];

if (empty($_SESSION['reset_csrf_token'])) {
    $_SESSION['reset_csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!hash_equals($_SESSION['reset_csrf_token'], $_POST['csrf_token'] ?? '')) {
        $error = "Security validation failed. Please try again.";

    } else {
        $newPassword = $_POST['password'] ?? '';
        $confirm = $_POST['confirm_password'] ?? '';

        if ($newPassword !== $confirm) {
            $error = "Passwords do not match.";

        } elseif (strlen($newPassword) < 8) {
            $error = "Password must be at least 8 characters.";

        } elseif (!preg_match('/[A-Z]/', $newPassword) || !preg_match('/[a-z]/', $newPassword) || !preg_match('/[0-9]/', $newPassword)) {
            $error = "Password must contain at least one uppercase, one lowercase, and one number.";

        } else {
            //update password in database
            $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
            $update = $db->prepare("UPDATE users SET Password = :pwd WHERE Email = :email");
            $update->bindParam(':pwd', $hashed);
            $update->bindParam(':email', $email);

            // token verify and deletion query
            if ($update->execute()) {
                $delete = $db->prepare("DELETE FROM password_resets WHERE Token = :token");
                $delete->bindParam(':token', $token);
                $delete->execute();
                session_regenerate_id(true);
                unset($_SESSION['reset_csrf_token']);
                header("Location: success-reset.html");
                exit;
                
            } else {
                $error = "Database error. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="reset-page">
    <div class="reset-content">
        <div class="container">
            <div class="card">
                <h1>Reset Your Password</h1>
                <p class="subheading">RESET</p>

                <?php if ($error): ?>
                    <p class="error-message" style="color: red;"><?= htmlspecialchars($error) ?></p>
                <?php elseif ($success): ?>
                    <p class="success-message" style="color: green;"><?= htmlspecialchars($success) ?></p>
                <?php else: ?>
                    <form class="reset-form" method="post">
                        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['reset_csrf_token']) ?>">
                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="text" id="password" name="password" placeholder="Enter your new password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="text" id="confirm_password" name="confirm_password" placeholder="Re-enter your new password" required>
                        </div>
                        <button type="submit" class="btn reset-btn">Reset</button>
                    </form>
                    <p class="note" style="font-size: 12px; margin-top: 15px; color: #666;">
                        <em>Note: Password fields are visible for demo purposes.</em>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-links"><a href="#">PRIVACY POLICY</a> | <a href="#">TERMS OF USE</a> | <a href="#">YOUR PRIVACY RIGHTS</a> | <a href="#">CHILDREN'S PRIVACY POLICY</a></div>
            <div class="footer-links"><a href="#">INTEREST BASED ADS</a> | <a href="#">DO NOT SELL MY INFO</a></div>
            <div class="copyright">© 2004-2025 | Kasseeah Nirvisesh</div>
        </div>
    </footer>
</body>
</html>