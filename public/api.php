<?php
define('BASE_PATH', dirname(__DIR__));

$endpoint = $_GET['endpoint'] ? $_GET['endpoint'] : '';

$routes = [
    'get_customers'         => '/src/Controller/Api/get_customers.php',
    'get_jobs'              => '/src/Controller/Api/get_jobs.php',
    'get_locations'         => '/src/Controller/Api/get_locations.php',
    'get_staff'             => '/src/Controller/Api/get_staff.php',
    'get_staff_positions'   => '/src/Controller/Api/get_staff_positions.php',
    'get_trucks'            => '/src/Controller/Api/get_trucks.php',
    'save_ticket'           => '/src/Controller/Api/save_ticket.php',
];

if (!isset($routes[$endpoint])) {
    http_response_code(404);
    echo json_encode(['error' => 'Unknown endpoint']);
    exit;
}

require BASE_PATH . $routes[$endpoint];
