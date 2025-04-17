<?php
require_once __DIR__ . '/../../src/Infrastructure/Database.php';
use App\Infrastructure\Database;
$pdo = Database::connect();
echo json_encode($pdo->query('SELECT id, name FROM customers ORDER BY name')->fetchAll());
