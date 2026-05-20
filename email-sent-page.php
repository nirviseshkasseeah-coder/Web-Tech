<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Sent | Password Reset</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="email-page">
    <div class="email-content">
        <div class="container">
            <div class="card">
                <h1>Email sent!</h1>
                <p class="subheading">Check your inbox</p>
                <p class="message">
                    An email containing a link to reset your password was sent to your email address.
                </p>

                <?php
                // DEMO ONLY: if a token is provided in the URL, display the reset link
                $token = $_GET['token'] ?? '';
                if (!empty($token)) {
                    
                    // Optional: verify token exists and not expired (you can skip for demo)
                    $resetLink = "http://localhost/Web-Tech/email-link-password-reset.php?token=" . urlencode($token);                    

                    echo '<div class="demo-link" style="margin-top: 25px; padding: 12px; background: #e1c699; border-radius: 8px; text-align: center;">
                            <p style="margin: 0 0 8px 0;"><strong> Demo reset link (since email sending is simulated)</strong></p>
                            <a href="' . htmlspecialchars($resetLink) . '" style="color: #4a2c1a; font-weight: bold; word-break: break-all;">' . htmlspecialchars($resetLink) . '</a>
                          </div>';
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