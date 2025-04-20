<h5 class="mt-5 mb-3">Labour</h5>
<div id="labour-section">
  <div class="labour-row row align-items-center mb-2 g-2" data-index="0">
    <div class="col-md-2">
      <label class="form-label">Staff</label>
      <select class="form-select staff-select" name="labour[0][staff_id]"></select>
    </div>

    <div class="col-md-2">
      <label class="form-label">Position</label>
      <select class="form-select position-select" name="labour[0][position_id]"></select>
    </div>

    <div class="col-md-1">
      <label class="form-label">UOM</label>
      <select class="form-select uom-select" name="labour[0][uom]">
        <option value="Hourly">Hourly</option>
        <option value="Fixed">Fixed</option>
      </select>
    </div>

    <div class="col-md-1">
      <label class="form-label">Regular Rate</label>
      <input class="form-control reg-rate" name="labour[0][reg_rate]" readonly>
    </div>

    <div class="col-md-1">
      <label class="form-label">Reg Hours</label>
      <input type="number" class="form-control" name="labour[0][reg_hours]" min="0">
    </div>

    <div class="col-md-2">
      <label class="form-label">Overtime Rate</label>
      <input class="form-control ot-rate" name="labour[0][ot_rate]" readonly>
    </div>

    <div class="col-md-1">
      <label class="form-label">Overtime</label>
      <input type="number" class="form-control" name="labour[0][ot_hours]" min="0">
    </div>

    <div class="col-md-1">
      <button type="button" class="btn btn-success btn-sm me-1" onclick="addLabourRow()">+</button>
      <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">x</button>
    </div>
  </div>
</div>
