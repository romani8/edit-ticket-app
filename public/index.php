<?php
require_once __DIR__ . '/../src/Infrastructure/Database.php';
require_once __DIR__ . '/../src/View/Partials/header.php';

use App\Infrastructure\Database;
$pdo = Database::connect();
?>

<div class="container my-4">
    <h5 class="mb-3">Project</h5>
    
    <form id="ticket-form">
        <div class="row align-items-center mb-2 g-2">
            <label for="customer" class="col-md-2 col-form-label">Customer&nbsp;Name:</label>
            <div class="col-md-4">
                <select id="customer" class="form-select" name="customer_id">
                    <option value="">Select Customer…</option>
                </select>
            </div>

            <div class="col-md-1"></div>

            <label for="ordered_by" class="col-md-2 col-form-label">Ordered&nbsp;By:</label>
            <div class="col-md-3">
                <input id="ordered_by" type="text" class="form-control" name="ordered_by">
            </div>
        </div>

        <div class="row align-items-center mb-2 g-2">
            <label for="job" class="col-md-2 col-form-label">Job&nbsp;Name:</label>
            <div class="col-md-4">
                <select id="job" class="form-select" name="job_id" disabled></select>
            </div>

            <div class="col-md-1"></div>

            <label for="ticket_date" class="col-md-2 col-form-label">Date:</label>
            <div class="col-md-3">
                <input id="ticket_date" type="date" class="form-control"
                    name="ticket_date" value="<?= date('Y-m-d') ?>">
            </div>
        </div>

        <div class="row align-items-center mb-2 g-2">
            <label for="status" class="col-md-2 col-form-label">Status:</label>
            <div class="col-md-4">
                <select id="status" class="form-select" name="status">
                    <option value="Active">Active</option>
                    <option value="Pending">Pending</option>
                    <option value="Closed">Closed</option>
                </select>
            </div>

            <div class="col-md-1"></div>

            <label for="area_field" class="col-md-2 col-form-label">Area/Field:</label>
            <div class="col-md-3">
                <input id="area_field" type="text" class="form-control" name="area_field">
            </div>
        </div>

        <div class="row align-items-center mb-2 g-2">
            <label for="location" class="col-md-2 col-form-label">Location/LSD:</label>
            <div class="col-md-4">
                <select id="location" class="form-select" name="location_id" disabled></select>
            </div>
        </div>

    <hr class="my-5">
    <h5 class="mb-3">Description of Work</h5>

        <div class="row mb-3 mt-4">
            <label for="description" class="col-md-2 col-form-label">Description:</label>
        </div>
        <div>
            <div class="col-md-12">
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>
        </div>
    </form>
</div>

<?php
require_once __DIR__ . '/../src/View/Partials/footer.php';
