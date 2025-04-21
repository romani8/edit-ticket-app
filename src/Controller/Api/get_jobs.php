<?php
require_once dirname(dirname(__DIR__)) . '/Infrastructure/Database.php';
use App\Infrastructure\Database;

header('Content-Type: application/json');

try {
    $pdo = Database::connect();
    $customerId = isset($_GET['customer_id']) ? (int)$_GET['customer_id'] : 0;

    if ($customerId) {
        $stmt = $pdo->prepare('SELECT id, name, customer_id FROM customer_jobs WHERE customer_id = ? ORDER BY name');
        $stmt->execute([$customerId]);
    } else {
        $stmt = $pdo->query('SELECT id, name, customer_id FROM customer_jobs ORDER BY name');
    }

    $results = [];
    foreach ($stmt as $row) {
        $results[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'customer_id' => $row['customer_id']
        ];
    }

    echo json_encode($results);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
}
