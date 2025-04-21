<h5 class="mt-5 mb-3">Miscellaneous</h5>

<!-- labels -->
<div class="row g-2">
  <div class="col-md-4"><label class="form-label">Description</label></div>
  <div class="col-md-2"><label class="form-label">Cost</label></div>
  <div class="col-md-2"><label class="form-label">Price</label></div>
  <div class="col-md-1"><label class="form-label">Quantity</label></div>
  <div class="col-md-2"><label class="form-label">Total</label></div>
  <div class="col-md-1"><label class="form-label">&nbsp;</label></div>
</div>

<div id="misc-section">
  <div class="misc-row row align-items-center mb-2 g-2" data-index="0">
    <div class="col-md-4">
      <input type="text" class="form-control misc-desc" name="misc[0][description]">
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control misc-cost" name="misc[0][cost]">
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control misc-price" name="misc[0][price]">
    </div>
    <div class="col-md-1">
      <input type="number" class="form-control misc-quantity" name="misc[0][quantity]" min="0">
    </div>
    <div class="col-md-2">
      <input type="text" class="form-control misc-total" name="misc[0][total]" readonly disabled>
    </div>
    <div class="col-md-1">
      <div class="d-flex gap-1">
        <button type="button" class="btn rounded-circle p-0"
          style="width: 24px; height: 24px; font-size: 14px; border: 1px solid #0dcaf0; color: #0dcaf0;"
          onclick="addMiscRow()">
          <i class="bi bi-plus"></i>
        </button>
        <button type="button" class="btn rounded-circle p-0"
          style="width: 24px; height: 24px; font-size: 14px; border: 1px solid #dc3545; color: #dc3545;"
          onclick="removeMiscRow(this)">
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
    <input type="text" class="form-control w-auto d-inline-block" id="misc-subtotal" readonly disabled>
  </div>
</div>
