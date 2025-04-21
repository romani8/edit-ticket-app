<?php
require_once __DIR__ . '/../src/View/Partials/header.php';

?>

<div class="container my-4">
    <form id="ticket-form">

        <?php require_once __DIR__ . '/../src/View/Partials/project-section.php'; ?>

        <hr class="my-5">

        <?php require_once __DIR__ . '/../src/View/Partials/description-section.php'; ?>

        <hr class="my-5">

        <?php require_once __DIR__ . '/../src/View/Partials/labour-section.php'; ?>

        <hr class="my-5">

        <?php require_once __DIR__ . '/../src/View/Partials/truck-section.php'; ?>
        <hr class="my-5">

        <?php require_once __DIR__ . '/../src/View/Partials/miscellaneous-section.php'; ?>
    </form>
</div>

<div class="text-end mt-2 mb-2 me-3">
  <button id="finish-button" type="button" class="btn btn-secondary px-4">
    FINISH
  </button>
</div>

<?php
require_once __DIR__ . '/../src/View/Partials/footer.php';
