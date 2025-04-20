<h5 class="mt-5 mb-3">Miscellaneous</h5>
<div id="misc-section">
  <div class="misc-row row align-items-center mb-2 g-2" data-index="0">
    <div class="col-md-3">
      <label class="form-label">Description</label>
      <input type="text" class="form-control misc-desc" name="misc[0][description]">
    </div>

    <div class="col-md-2">
      <label class="form-label">Cost</label>
      <input type="text" class="form-control misc-cost" name="misc[0][cost]">
    </div>

    <div class="col-md-2">
      <label class="form-label">Price</label>
      <input type="text" class="form-control misc-price" name="misc[0][price]">
    </div>

    <div class="col-md-1">
      <label class="form-label">Quantity</label>
      <input type="number" class="form-control misc-qty" name="misc[0][quantity]" min="0">
    </div>

    <div class="col-md-2">
      <label class="form-label">Total</label>
      <input type="text" class="form-control misc-total" name="misc[0][total]" readonly>
    </div>

    <div class="col-md-1 d-flex align-items-end">
      <button type="button" class="btn btn-success btn-sm me-1" onclick="addMiscRow()">+</button>
      <button type="button" class="btn btn-danger btn-sm" onclick="removeMiscRow(this)">x</button>
    </div>
  </div>
</div>
