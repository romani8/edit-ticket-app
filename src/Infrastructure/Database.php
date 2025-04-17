<?php
namespace App\Infrastructure;
class Database {
    public static function connect() {
        $config = require __DIR__ . '/../../config/config.php';
        return new \PDO(
            sprintf(
                'mysql:host=%s;dbname=%s;charset=%s',
                $config['host'],
                $config['dbname'],
                $config['charset']
            ),
            $config['user'],
            $config['password'],
            [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            ]
        );
    }
}
