<?php
require_once __DIR__ . '/../../src/Infrastructure/Database.php';

use App\Infrastructure\Database;

header('Content-Type: application/json');

try {
    $pdo = Database::connect();

    $stmt = $pdo->prepare(
        'SELECT id, name, hourly_rate, fixed_rate
         FROM trucks
         ORDER BY name'
    );
    $stmt->execute();

    $results = [];
    foreach ($stmt as $row) {
        $uom = $row['hourly_rate'] !== null ? 'Hourly' : 'Fixed';
        $rate = $uom === 'Hourly' ? $row['hourly_rate'] : $row['fixed_rate'];

        $results[] = [
            'id'           => $row['id'],
            'text'         => $row['name'],
            'rate'         => $rate,
            'uom'          => $uom,
            'hourly_rate'  => $row['hourly_rate'],
            'fixed_rate'   => $row['fixed_rate']
        ];
    }

    echo json_encode($results);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
}
