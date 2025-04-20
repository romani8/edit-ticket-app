<h5 class="mt-5 mb-3">Truck</h5>
<div id="truck-section">
  <div class="truck-row row align-items-center mb-2 g-2" data-index="0">
    <div class="col-md-2">
      <label class="form-label">Label</label>
      <select class="form-select truck-select" name="truck[0][truck_id]"></select>
    </div>

    <div class="col-md-2">
      <label class="form-label">Qty</label>
      <input type="number" class="form-control quantity" name="truck[0][quantity]" min="0">
    </div>

    <div class="col-md-2">
      <label class="form-label">UOM</label>
      <select class="form-select uom-select" name="truck[0][uom]">
        <option value="Hourly">Hourly</option>
        <option value="Fixed">Fixed</option>
      </select>
    </div>

    <div class="col-md-2">
      <label class="form-label">Rate ($)</label>
      <input type="text" class="form-control rate" name="truck[0][rate]" readonly>
    </div>

    <div class="col-md-2">
      <label class="form-label">Total</label>
      <input type="text" class="form-control total" name="truck[0][total]" readonly>
    </div>

    <div class="col-md-1 d-flex align-items-end">
      <button type="button" class="btn btn-success btn-sm me-1" onclick="addTruckRow()">+</button>
      <button type="button" class="btn btn-danger btn-sm" onclick="removeTruckRow(this)">x</button>
    </div>
  </div>
</div>
