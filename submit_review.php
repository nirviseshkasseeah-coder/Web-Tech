<?php
header('Content-Type: application/json');
session_start();
require_once __DIR__ . '/../db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'error' => 'Please login to submit a review']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);

// Validation
if (!isset($data['product_id']) || empty($data['product_id'])) {
    echo json_encode(['success' => false, 'error' => 'Product ID is required']);
    exit;
}

if (!isset($data['rating']) || $data['rating'] < 1 || $data['rating'] > 5) {
    echo json_encode(['success' => false, 'error' => 'Rating must be between 1 and 5 stars']);
    exit;
}

if (!isset($data['comment']) || strlen($data['comment']) < 5 || strlen($data['comment']) > 500) {
    echo json_encode(['success' => false, 'error' => 'Comment must be between 5 and 500 characters']);
    exit;
}

$product_id = $data['product_id'];
$rating = (int)$data['rating'];
$comment = trim($data['comment']);
$user_id = $_SESSION['user_id'];

try {
    // Check if already reviewed
    $check_stmt = $db->prepare("SELECT ReviewID FROM reviews WHERE UserID = ? AND ProductID = ?");
    $check_stmt->execute([$user_id, $product_id]);
    
    if ($check_stmt->fetch()) {
        echo json_encode(['success' => false, 'error' => 'You have already reviewed this product']);
        exit;
    }
    
    // Insert review
    $insert_stmt = $db->prepare("
        INSERT INTO reviews (UserID, ProductID, Rating, Comment, CreatedAt) 
        VALUES (?, ?, ?, ?, NOW())
    ");
    $insert_stmt->execute([$user_id, $product_id, $rating, $comment]);
    
    echo json_encode(['success' => true, 'message' => 'Review submitted successfully']);
    
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>