<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=edit_ticket_db;charset=utf8',
        'ticket_user',
        'P@ssword1#',
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    echo "✅ Connected to MySQL using PDO";

    $stmt = $pdo->query("SHOW TABLES");
    echo "<br><br><b>Tables in database:</b><ul>";
    while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
        echo "<li>" . htmlspecialchars($row[0]) . "</li>";
    }
    echo "</ul>";

} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
