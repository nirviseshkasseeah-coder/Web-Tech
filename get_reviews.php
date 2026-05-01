<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../db.php';

$product_id = $_GET['id'] ?? 'tiramisu-cake';

try {
    // Get reviews for this product from database
    $stmt = $db->prepare("
        SELECT r.*, u.Username 
        FROM reviews r
        JOIN users u ON r.UserID = u.UserID
        WHERE r.ProductID = ?
        ORDER BY r.CreatedAt DESC
    ");
    $stmt->execute([$product_id]);
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $total = count($reviews);
    $avg = 0;
    if ($total > 0) {
        $sum = array_sum(array_column($reviews, 'Rating'));
        $avg = round($sum / $total, 1);
    }
    
    echo json_encode([
        'success' => true,
        'data' => $reviews,
        'average' => $avg,
        'total' => $total
    ]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
?>