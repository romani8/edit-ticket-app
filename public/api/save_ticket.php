<?php
require_once '../../config/config.php';

use App\Infrastructure\Database;

$pdo = Database::connect();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$data = json_decode(file_get_contents('php://input'), true);

$stmt = $pdo->prepare("
    INSERT INTO tickets (customer_id, job_id, location_id, status, ordered_by, date, area, description)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)
");
$stmt->execute([
    $data['project']['customer_id'],
    $data['project']['job_id'],
    $data['project']['location_id'],
    $data['project']['status'],
    $data['project']['ordered_by'],
    $data['project']['ticket_date'],
    $data['project']['area'],
    $data['project']['description']
]);

$ticketId = $pdo->lastInsertId();

foreach ($data['labour'] as $row) {
    $stmt = $pdo->prepare("
        INSERT INTO ticket_labour (ticket_id, staff_position_id, uom, regular_hours, overtime_hours, fixed_total, total)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $ticketId,
        $row['staff_position_id'],
        $row['uom'],
        $row['regular_hours'],
        $row['overtime_hours'],
        $row['fixed_total'],
        $row['total']
    ]);
}

foreach ($data['truck'] as $row) {
    $stmt = $pdo->prepare("
        INSERT INTO ticket_truck (ticket_id, truck_id, uom, quantity, fixed_total, total)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $ticketId,
        $row['truck_id'],
        $row['uom'],
        $row['quantity'],
        $row['fixed_total'],
        $row['total']
    ]);
}

foreach ($data['misc'] as $row) {
    $stmt = $pdo->prepare("
        INSERT INTO ticket_misc (ticket_id, description, cost, price, quantity, total)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $ticketId,
        $row['description'],
        $row['cost'],
        $row['price'],
        $row['quantity'],
        $row['total']
    ]);
}

echo json_encode(['status' => 'success']);
