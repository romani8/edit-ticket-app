<?php
require_once dirname(dirname(__DIR__)) . '/Infrastructure/Database.php';

use App\Infrastructure\Database;

header('Content-Type: application/json');

try {
    $pdo = Database::connect();
    $jobId = isset($_GET['job_id']) ? (int)$_GET['job_id'] : 0;

    $stmt = $pdo->prepare('SELECT id, name FROM job_locations WHERE customer_job_id = ? ORDER BY name');
    $stmt->execute([$jobId]);

    echo json_encode($stmt->fetchAll());
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
}
