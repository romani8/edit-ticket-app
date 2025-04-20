<h5 class="mt-5 mb-3">Labour</h5>

<!-- labels -->
<div class="row g-2">
  <div class="col-md-2"><label class="form-label">Staff</label></div>
  <div class="col-md-2"><label class="form-label">Position</label></div>
  <div class="col-md-2"><label class="form-label">UOM</label></div>
  <div class="col-md-1"><label class="form-label">Regular Rate</label></div>
  <div class="col-md-1"><label class="form-label">Reg Hours</label></div>
  <div class="col-md-2"><label class="form-label">Overtime Rate</label></div>
  <div class="col-md-1"><label class="form-label">Overtime</label></div>
  <div class="col-md-1"><label class="form-label">&nbsp;</label></div>
</div>

<div id="labour-section">
  <div class="labour-row row align-items-center mb-2 g-2" data-index="0">
    <div class="col-md-2">
      <select class="form-select staff-select" name="labour[0][staff_id]"></select>
    </div>
    <div class="col-md-2">
      <select class="form-select position-select" name="labour[0][position_id]"></select>
    </div>
    <div class="col-md-2">
      <select class="form-select uom-select" name="labour[0][uom]">
        <option value="Hourly">Hourly</option>
        <option value="Fixed">Fixed</option>
      </select>
    </div>
    <div class="col-md-1">
      <input class="form-control reg-rate" name="labour[0][reg_rate]" readonly disabled>
    </div>
    <div class="col-md-1">
      <input type="number" class="form-control" name="labour[0][reg_hours]" min="0">
    </div>
    <div class="col-md-2">
      <input class="form-control ot-rate" name="labour[0][ot_rate]" readonly disabled>
    </div>
    <div class="col-md-1">
      <input type="number" class="form-control" name="labour[0][ot_hours]" min="0">
    </div>
    <div class="col-md-1">
      <div class="d-flex gap-1">
        <button type="button" class="btn rounded-circle p-0"
          style="width: 24px; height: 24px; font-size: 14px; border: 1px solid #0dcaf0; color: #0dcaf0;"
          onclick="addLabourRow()">
          <i class="bi bi-plus"></i>
        </button>
        <button type="button" class="btn rounded-circle p-0"
          style="width: 24px; height: 24px; font-size: 14px; border: 1px solid #dc3545; color: #dc3545;"
          onclick="removeRow(this)">
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
    <input type="text" class="form-control w-auto d-inline-block" id="labour-subtotal" readonly disabled>
  </div>
</div>
