<?php
// require_once __DIR__ . '/../src/Infrastructure/Database.php';
require_once __DIR__ . '/../src/View/Partials/header.php';

// use App\Infrastructure\Database;
// $pdo = Database::connect();
?>

<div class="container my-4">
    <form id="ticket-form">

        <?php require_once __DIR__ . '/partials/project-section.php'; ?>

        <hr class="my-5">

        <?php require_once __DIR__ . '/partials/description-section.php'; ?>

        <hr class="my-5">

        <?php require_once __DIR__ . '/partials/labour-section.php'; ?>

        <hr class="my-5">

        <?php require_once __DIR__ . '/partials/truck-section.php'; ?>
        <hr class="my-5">

        <?php require_once __DIR__ . '/partials/miscellaneous-section.php'; ?>
    </form>
</div>

<?php
require_once __DIR__ . '/../src/View/Partials/footer.php';
