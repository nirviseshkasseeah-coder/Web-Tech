<?php
// Clean output buffer
ob_clean();
error_reporting(0);
ini_set('display_errors', 0);

session_start();
require_once 'db.php';

// Better AJAX detection
$isAjax = !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
$isAjax = $isAjax || (isset($_POST['ajax']) && $_POST['ajax'] === true);

$now = time();

// Rate limiting
if (isset($_SESSION['last_reset']) && ($now - $_SESSION['last_reset']) < 60) {
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Please wait a minute before requesting another reset link.']);
        exit;
    } else {
        header("Location: email-sent-page.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
        exit;
    } else {
        header("Location: index.php");
        exit;
    }
}

$rawEmail = $_POST['email'] ?? '';
$decodedEmail = urldecode($rawEmail);
$email = filter_var(trim($decodedEmail), FILTER_SANITIZE_EMAIL);

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    if ($isAjax) {
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Invalid email address.']);
        exit;
    } else {
        header("Location: email-sent-page.php");
        exit;
    }
}

$stmt = $db->prepare("SELECT UserID FROM users WHERE LOWER(Email) = LOWER(:email)");
$stmt->bindParam(':email', $email);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// token generation
$token = '';
if ($user) {
    $token = bin2hex(random_bytes(32));

    $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
    $insert = $db->prepare("INSERT INTO password_resets (Email, Token, Expiry) VALUES (:email, :token, :expiry)");
    $insert->bindParam(':email', $email);
    $insert->bindParam(':token', $token);
    $insert->bindParam(':expiry', $expiry);
    $insert->execute();
}

//rate limiting to check when last session was 
$_SESSION['last_reset'] = $now;

if ($isAjax) {
    header('Content-Type: application/json');
    if ($user) {
        echo json_encode(['success' => true, 'token' => $token]);
    } else {
        echo json_encode(['success' => false, 'message' => 'If this email exists, a reset link has been sent.']);
    }
    exit;
}

// Non‑AJAX fallback (loading animation)
$redirectUrl = 'email-sent-page.php';
if (!empty($token)) $redirectUrl .= '?token=' . urlencode($token);
?>
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta http-equiv="refresh" content="2;url=<?= htmlspecialchars($redirectUrl) ?>"><title>Processing</title><style>body{font-family:"Jacques Francois",serif;background:#F9F6F1;display:flex;justify-content:center;align-items:center;height:100vh;margin:0;text-align:center;}.message{background:#cbb89d;padding:30px 40px;border-radius:12px;box-shadow:0 12px 10px -10px rgba(0,0,0,0.25);color:#4a2c1a;font-size:20px;}.loader{margin-top:15px;width:30px;height:30px;border:3px solid #e1c699;border-top-color:#6F4E37;border-radius:50%;animation:spin 1s linear infinite;display:inline-block;}@keyframes spin{to{transform:rotate(360deg);}}</style></head>
<body><div class="message"><strong>Processing your request...</strong><br>You will be redirected shortly.<div class="loader"></div></div></body>
</html>