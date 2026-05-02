<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="email-page">
    <div class="email-content">
        <div class="container">
            <div class="card">
                <h1>Password Reset</h1>
                <p class="subheading">RESET</p>
                <p class="message">
                    Click on the button below to proceed to password reset page.
                </p>

                <?php
                // Read token from URL (passed from email-sent-page.php)
                $token = isset($_GET['token']) ? trim($_GET['token']) : '';

                if (empty($token)) {
                    // No token – show error (no link)
                    echo '<p class="error" style="color: red;">Invalid reset link. Please request a new password reset.</p>';
                } else {
                    // Build the link to the actual reset page
                    $resetPage = "http://localhost/Web-Tech/reset-password.php?token=" . urlencode($token);
                    // Escape the URL for safe output
                    $resetPageEscaped = htmlspecialchars($resetPage, ENT_QUOTES, 'UTF-8');
                    echo '<a href="' . $resetPageEscaped . '" class="btn proceed-btn">Proceed</a>';
                }
                ?>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="footer-inner">
            <div class="footer-links">
                <a href="#">PRIVACY POLICY</a> | 
                <a href="#">TERMS OF USE</a> | 
                <a href="#">YOUR PRIVACY RIGHTS</a> | 
                <a href="#">CHILDREN'S PRIVACY POLICY</a>
            </div>
            <div class="footer-links">
                <a href="#">INTEREST BASED ADS</a> | 
                <a href="#">DO NOT SELL MY INFO</a>
            </div>
            <div class="copyright">
                © 2004-2025 | Kasseeah Nirvisesh
            </div>
        </div>
    </footer>
</body>
</html>