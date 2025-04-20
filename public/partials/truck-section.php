<h5 class="mt-5 mb-3">Truck</h5>

<div class="row g-2">
  <div class="col-md-3"><label class="form-label">Label</label></div>
  <div class="col-md-2"><label class="form-label">Qty</label></div>
  <div class="col-md-2"><label class="form-label">UOM</label></div>
  <div class="col-md-2"><label class="form-label">Rate ($)</label></div>
  <div class="col-md-2"><label class="form-label">Total</label></div>
  <div class="col-md-1"><label class="form-label">&nbsp;</label></div>
</div>

<div id="truck-section">
  <div class="truck-row row align-items-center mb-2 g-2" data-index="0">
    <div class="col-md-3">
      <select class="form-select truck-select" name="truck[0][truck_id]"></select>
    </div>
    <div class="col-md-2">
      <input type="number" class="form-control quantity" name="truck[0][quantity]" min="0">
    </div>
    <div class="col-md-2">
      <select class="form-select uom-select" name="truck[0][uom]">
        <option value="Hourly">Hourly</option>
        <option value="Fixed">Fixed</option>
      </select>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control rate" name="truck[0][rate]" readonly disabled>
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control total" name="truck[0][total]" readonly disabled>
    </div>
    <div class="col-md-1">
      <div class="d-flex gap-1">
        <button type="button" class="btn rounded-circle p-0"
          style="width: 24px; height: 24px; font-size: 14px; border: 1px solid #0dcaf0; color: #0dcaf0;"
          onclick="addTruckRow()">
          <i class="bi bi-plus"></i>
        </button>
        <button type="button" class="btn rounded-circle p-0"
          style="width: 24px; height: 24px; font-size: 14px; border: 1px solid #dc3545; color: #dc3545;"
          onclick="removeTruckRow(this)">
          <i class="bi bi-x"></i>
        </button>
      </div>
    </div>
  </div>
</div>

<div class="row mt-2">
  <div class="col-md-6">
    <label class="form-label">Sub Total</label>
  </div>
  <div class="col-md-5 text-end">
    <input type="text" class="form-control w-auto d-inline-block" id="truck-subtotal" readonly>
  </div>
</div>
