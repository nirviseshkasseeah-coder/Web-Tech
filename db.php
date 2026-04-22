<?php
$host = "localhost";
$dbname = "ryans_coffee_and_pastries_db";
$username = "root";
$password = "";

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    throw new PDOException("Database connection failed: " . $e->getMessage(), (int) $e->getCode(), $e);
}
?>
