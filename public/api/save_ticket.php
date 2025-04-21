<?php
require_once __DIR__ . '/../../src/Infrastructure/Database.php';

use App\Infrastructure\Database;

try {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = json_decode(file_get_contents('php://input'), true);

    $stmt = $pdo->prepare("
        INSERT INTO tickets (
            customer_id, job_id, location_id,
            status, ordered_by, date, area, description,
            labour_subtotal, truck_subtotal, misc_subtotal
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $data['project']['customer_id'],
        $data['project']['job_id'],
        $data['project']['location_id'],
        $data['project']['status'],
        $data['project']['ordered_by'],
        $data['project']['ticket_date'],
        $data['project']['area'],
        $data['project']['description'],
        $data['project']['labour_subtotal'],
        $data['project']['truck_subtotal'],
        $data['project']['misc_subtotal']
    ]);

    $ticketId = $pdo->lastInsertId();

    foreach ($data['labour'] as $row) {
        $stmt = $pdo->prepare("
            INSERT INTO ticket_labour (
                ticket_id, staff_id, staff_position_id, uom,
                regular_hours, overtime_hours,
                regular_rate, overtime_rate
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $ticketId,
            $row['staff_id'],
            $row['staff_position_id'],
            $row['uom'],
            $row['regular_hours'],
            $row['overtime_hours'],
            $row['regular_rate'],
            $row['overtime_rate']
        ]);
    }

    foreach ($data['truck'] as $row) {
        $stmt = $pdo->prepare("
            INSERT INTO ticket_truck (
                ticket_id, truck_id, uom,
                quantity, rate, total
            ) VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt->execute([
            $ticketId,
            $row['truck_id'],
            $row['uom'],
            $row['quantity'],
            $row['rate'],
            $row['total']
        ]);
    }

    foreach ($data['misc'] as $row) {
        $stmt = $pdo->prepare("
            INSERT INTO ticket_misc (
                ticket_id, description, cost, price,
                quantity, total
            ) VALUES (?, ?, ?, ?, ?, ?)
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
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
