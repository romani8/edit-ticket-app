<?php
require_once __DIR__ . '/../../src/Infrastructure/Database.php';

use App\Infrastructure\Database;

header('Content-Type: application/json');

try {
    $pdo = Database::connect();
    $staffId = (int)($_GET['staff_id'] ? $_GET['staff_id'] : 0);

    if (!$staffId) {
        http_response_code(400);
        echo json_encode(['error' => 'Missing staff_id']);
        exit;
    }

    $stmt = $pdo->prepare(
        'SELECT id, position_name, hourly_regular_rate, hourly_overtime_rate,
                fixed_regular_rate, fixed_overtime_rate
         FROM staff_positions
         WHERE staff_id = ?
         ORDER BY position_name'
    );
    $stmt->execute([$staffId]);

    $results = [];
    foreach ($stmt as $row) {
        $isHourly = $row['hourly_regular_rate'] !== null;

        $results[] = [
            'id'        => $row['id'],
            'text'      => $row['position_name'],
            'reg_rate'  => $isHourly ? $row['hourly_regular_rate'] : $row['fixed_regular_rate'],
            'ot_rate'   => $isHourly ? $row['hourly_overtime_rate'] : $row['fixed_overtime_rate'],
            'uom'       => $isHourly ? 'Hourly' : 'Fixed'
        ];
    }

    echo json_encode($results);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database error']);
}
