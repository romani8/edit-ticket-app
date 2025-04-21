<?php
require_once dirname(dirname(__DIR__)) . '/Infrastructure/Database.php';
use App\Infrastructure\Database;

header('Content-Type: application/json');

try {
    $pdo = Database::connect();
    $jobId = isset($_GET['job_id']) ? (int)$_GET['job_id'] : 0;

    if ($jobId) {
        $stmt = $pdo->prepare('SELECT id, name, customer_job_id AS job_id FROM job_locations WHERE customer_job_id = ? ORDER BY name');
        $stmt->execute([$jobId]);
    } else {
        $stmt = $pdo->query('SELECT id, name, customer_job_id AS job_id FROM job_locations ORDER BY name');
    }

    $results = [];
    foreach ($stmt as $row) {
        $results[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'job_id' => $row['job_id']
        ];
    }

    echo json_encode($results);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
}
