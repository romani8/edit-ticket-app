<?php
require_once dirname(dirname(__DIR__)) . '/Infrastructure/Database.php';

use App\Infrastructure\Database;

header('Content-Type: application/json');

try {
    $pdo = Database::connect();
    $customerId = isset($_GET['customer_id']) ? (int)$_GET['customer_id'] : 0;

    $stmt = $pdo->prepare('SELECT id, name FROM customer_jobs WHERE customer_id = ? ORDER BY name');
    $stmt->execute([$customerId]);

    echo json_encode($stmt->fetchAll());
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
}
