<?php
require_once __DIR__ . '/../../src/Infrastructure/Database.php';

use App\Infrastructure\Database;

$pdo = Database::connect();

$term = isset($_GET['term']) ? $_GET['term'] : '';
$stmt = $pdo->prepare('SELECT id, name FROM customers WHERE name LIKE ? ORDER BY name');
$stmt->execute(["%$term%"]);

$results = [];
foreach ($stmt->fetchAll() as $row) {
    $results[] = ['id' => $row['id'], 'text' => $row['name']];
}

echo json_encode($results);
