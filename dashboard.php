<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: admin-login.html");
    exit;
}
echo "Welcome admin: " . htmlspecialchars($_SESSION['username']);
?>