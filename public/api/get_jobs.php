<?php
require_once __DIR__ . '/../../src/Infrastructure/Database.php';

use App\Infrastructure\Database;

$pdo = Database::connect();
$customerId = isset($_GET['customer_id']) ? (int)$_GET['customer_id'] : 0;

$stmt = $pdo->prepare('SELECT id, name FROM customer_jobs WHERE customer_id = ? ORDER BY name');
$stmt->execute([$customerId]);

echo json_encode($stmt->fetchAll());
