<?php
require_once __DIR__ . '/../../src/Infrastructure/Database.php';

use App\Infrastructure\Database;

$pdo = Database::connect();
$jobId = isset($_GET['job_id']) ? (int)$_GET['job_id'] : 0;

$stmt = $pdo->prepare('SELECT id, name FROM job_locations WHERE customer_job_id = ? ORDER BY name');
$stmt->execute([$jobId]);

echo json_encode($stmt->fetchAll());
