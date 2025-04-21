<?php
require_once dirname(dirname(__DIR__)) . '/Infrastructure/Database.php';

use App\Infrastructure\Database;

header('Content-Type: application/json');

try {
    $db  = Database::connect();
    
    $sql = 'SELECT id, name FROM staff ORDER BY name';
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $out = [];
    foreach ($stmt as $r) {
        $out[] = ['id' => $r['id'], 'text' => $r['name']];
    }
    echo json_encode($out);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
}
