<?php
session_start();
require_once 'db.php'; // your PDO connection

// CSRF protection: generate a token for the login form if not exists
if (empty($_SESSION['admin_login_csrf'])) {
    $_SESSION['admin_login_csrf'] = bin2hex(random_bytes(32));
}

// Initialise lockout tracking
if (!isset($_SESSION['admin_attempts'])) {
    $_SESSION['admin_attempts'] = 0;
}
if (!isset($_SESSION['admin_lockout'])) {
    $_SESSION['admin_lockout'] = 0;
}

$error = '';

// Check if currently locked out
if (time() < $_SESSION['admin_lockout']) {
    $error = "Too many failed attempts. Try again in 3 minutes.";
} else {
    // Process login only if POST and no lockout
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
        
        // ===== CSRF PROTECTION =====
        if (!isset($_POST['csrf_token']) || !isset($_SESSION['admin_login_csrf']) || 
            !hash_equals($_SESSION['admin_login_csrf'], $_POST['csrf_token'])) {
            $error = "Security validation failed. Please try again.";
            unset($_SESSION['admin_login_csrf']);
        } else {
            unset($_SESSION['admin_login_csrf']);
            
            $email    = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = "Please fill in all fields.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format.";
            } else {
                $stmt = $db->prepare("
                    SELECT u.UserID, u.Username, u.Password
                    FROM users u
                    JOIN admins a ON u.UserID = a.UserID
                    WHERE u.Email = :email
                ");
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($row && password_verify($password, $row['Password'])) {
                    $_SESSION['user_id']  = $row['UserID'];
                    $_SESSION['username'] = $row['Username'];
                    $_SESSION['is_admin'] = true;
                    $_SESSION['admin_attempts'] = 0;
                    $_SESSION['admin_lockout']  = 0;

                    header("Location: dashboard.php");
                    exit;
                } else {
                    $_SESSION['admin_attempts']++;
                    if ($_SESSION['admin_attempts'] >= 3) {
                        $_SESSION['admin_lockout'] = time() + (3 * 60);
                        $_SESSION['admin_attempts'] = 0;
                        $error = "Too many failed attempts. Account locked for 3 minutes.";
                    } else {
                        $error = "Invalid email or password.";
                    }
                }
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
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
    <!-- FontAwesome for eye icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="admin-login-page">
    <!-- Top banner with "View website" button -->
    <div class="admin-top-banner">
        <div class="banner-container">
            <a href="index.php" class="view-website-btn">View website</a>
        </div>
    </div>

    <!-- Main content -->
    <div class="admin-login-content">
        <div class="container">
            <div class="card">
                <h2 id="admin-heading">Admin Login</h2>

                <?php if ($error): ?>
                    <p class="error-message" style="color: red; text-align: center;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>

                <form id="admin-auth-form" class="admin-login-form" method="post">
                    <!-- CSRF token -->
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['admin_login_csrf'] ?? '') ?>">

                    <div class="form-group">
                        <label for="admin-email">Email</label>
                        <input type="email" id="admin-email" name="email" placeholder="Enter your email" required>
                    </div>

                    <div id="admin-login-fields">
                        <div class="form-group">
                            <label for="admin-password">Password</label>
                            <!-- Password wrapper with toggle button (same as index.php) -->
                            <div class="password-wrapper">
                                <input type="password" id="admin-password" name="password" placeholder="Enter your password" required>
                                <button type="button" class="toggle-password" aria-label="Show/Hide Password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="forgot-password">
                            <a href="#" id="admin-forgot-link">Forgot your password?</a>
                        </div>
                    </div>

                    <div class="form-actions" style="display: flex; gap: 10px;">
                        <button type="submit" name="login" id="admin-login-btn" class="btn login-btn">Login</button>
                        <button type="button" id="admin-reset-submit-btn" class="btn login-btn" style="display: none;">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
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

    <script>
    $(function() {
        // ---- Password visibility toggle (same as index.php) ----
        $('.toggle-password').on('click', function() {
            const $pwdField = $('#admin-password');
            const type = $pwdField.attr('type') === 'password' ? 'text' : 'password';
            $pwdField.attr('type', type);
            $(this).html(type === 'password' ? '<i class="fas fa-eye"></i>' : '<i class="fas fa-eye-slash"></i>');
        });

        // ---- Mode switching functions (unchanged) ----
        const $form = $('#admin-auth-form');
        const $heading = $('#admin-heading');
        const $loginFields = $('#admin-login-fields');
        const $loginBtn = $('#admin-login-btn');
        const $resetSubmitBtn = $('#admin-reset-submit-btn');
        const $forgotLink = $('#admin-forgot-link');
        const $emailInput = $('#admin-email');
        const $passwordInput = $('#admin-password');

        function setLoginMode() {
            $heading.text('Admin Login');
            $loginFields.show();
            $loginBtn.css('display', 'inline-block');
            $resetSubmitBtn.hide();
            $form.attr('action', '');
            $form.attr('method', 'post');
            $passwordInput.prop('required', true);
        }

        function setForgotMode() {
            $heading.text('Enter email to reset password');
            $loginFields.hide();
            $loginBtn.css('display', 'inline-block');
            $resetSubmitBtn.css('display', 'inline-block');
            $form.attr('action', 'admin-forgot-password.php');
            $form.attr('method', 'post');
            $passwordInput.prop('required', false);
        }

        $forgotLink.on('click', function(e) {
            e.preventDefault();
            setForgotMode();
        });

        $loginBtn.on('click', function(e) {
            if ($form.attr('action') === 'admin-forgot-password.php') {
                e.preventDefault();
                setLoginMode();
            }
        });

        $resetSubmitBtn.on('click', function() {
            if ($.trim($emailInput.val()) === '') {
                alert('Please enter your email address.');
                return;
            }
            $form.submit();
        });
    });
    </script>
</body>
</html>