(function () {
  function initLabourRow(row) {
    var $row = $(row);
    var $staff = $row.find('.staff-select');
    var $position = $row.find('.position-select');
    var $uom = $row.find('.uom-select');
    var $regRate = $row.find('.reg-rate');
    var $otRate = $row.find('.ot-rate');

    $staff.html('<option value="">Select Staff...</option>');
    $position.prop('disabled', true).html('<option value="">Select Position...</option>');

    $.getJSON('./api.php?endpoint=get_staff', function (staffList) {
      $.each(staffList, function (i, staff) {
        $staff.append('<option value="' + staff.id + '">' + staff.text + '</option>');
      });
    });

    $staff.select2({ placeholder: 'Select Staff...', minimumResultsForSearch: Infinity, width: '100%' });
    $position.select2({ placeholder: 'Select Position...', minimumResultsForSearch: Infinity, width: '100%' });

    $staff.on('change', function () {
      var staffId = $staff.val();
      $position.prop('disabled', !staffId).html('<option value="">Select Position...</option>');
      $regRate.val('');
      $otRate.val('');
      $uom.val('Hourly');

      if (!staffId) return;

      $.getJSON('./api.php?endpoint=get_staff_positions', { staff_id: staffId }, function (positions) {
        $.each(positions, function (i, pos) {
          var $option = $('<option>')
            .val(pos.id)
            .text(pos.text)
            .data({
              hourly_regular_rate: pos.hourly_regular_rate,
              hourly_overtime_rate: pos.hourly_overtime_rate,
              fixed_regular_rate: pos.fixed_regular_rate,
              fixed_overtime_rate: pos.fixed_overtime_rate
            });
          $position.append($option);
        });
      });
    });

    $position.on('change', function () {
      var $selected = $position.find(':selected');
      if (!$selected.length) return;

      var uom = $uom.val();
      $regRate.val(uom === 'Fixed' ? $selected.data('fixed_regular_rate') : $selected.data('hourly_regular_rate'));
      $otRate.val(uom === 'Fixed' ? $selected.data('fixed_overtime_rate') : $selected.data('hourly_overtime_rate'));
      calculateLabourSubTotal();
    });

    $uom.on('change', function () {
      var $selected = $position.find(':selected');
      if (!$selected.length) return;

      var uom = $uom.val();
      $regRate.val(uom === 'Fixed' ? $selected.data('fixed_regular_rate') : $selected.data('hourly_regular_rate'));
      $otRate.val(uom === 'Fixed' ? $selected.data('fixed_overtime_rate') : $selected.data('hourly_overtime_rate'));
      calculateLabourSubTotal();
    });

    $row.find('[name$="[reg_hours]"], [name$="[ot_hours]"]').on('input', function () {
      calculateLabourSubTotal();
    });
  }

  function calculateLabourSubTotal() {
    let total = 0;
    $('.labour-row').each(function () {
      const regHours = parseFloat($(this).find('[name$="[reg_hours]"]').val()) || 0;
      const otHours = parseFloat($(this).find('[name$="[ot_hours]"]').val()) || 0;
      const regRate = parseFloat($(this).find('[name$="[reg_rate]"]').val()) || 0;
      const otRate = parseFloat($(this).find('[name$="[ot_rate]"]').val()) || 0;
      total += (regHours * regRate) + (otHours * otRate);
    });
    $('#labour-subtotal').val(total.toFixed(2));
  }

  function addLabourRow() {
    var $template = $('.labour-row').first();
    var newIndex = $('.labour-row').length;
    var $clone = $template.clone(false).attr('data-index', newIndex);

    $clone.find('[name]').each(function () {
      var $el = $(this);
      var oldName = $el.attr('name');
      if (!oldName) return;

      var newName = oldName.replace(/\[\d+\]/, '[' + newIndex + ']');
      $el.attr('name', newName);

      if (oldName.includes('[reg_hours]') || oldName.includes('[ot_hours]') || oldName.includes('[reg_rate]') || oldName.includes('[ot_rate]')) {
        $el.val('');
      }

      if ($el.is('select')) {
        const nameAttr = $el.attr('name') || '';
        $el.empty();
      
        if (nameAttr.includes('[uom]')) {
          $el.append('<option value="Hourly">Hourly</option>');
          $el.append('<option value="Fixed">Fixed</option>');
          $el.val('Hourly');
        } else {
          const placeholder = $('<option value="">Select…</option>');
          $el.append(placeholder).val('');
        }
      }      
    });

    $clone.find('.select2-container').remove();
    $clone.find('select').show();

    $('#labour-section').append($clone);
    initLabourRow($clone);
    calculateLabourSubTotal();
  }

  function removeRow(btn) {
    var rows = $('.labour-row');
    if (rows.length > 1) {
      $(btn).closest('.labour-row').remove();
      calculateLabourSubTotal();
    }
  }

  window.initLabourRow = initLabourRow;
  window.addLabourRow = addLabourRow;
  window.removeRow = removeRow;

  $(document).ready(function () {
    $('.labour-row').each(function () {
      initLabourRow(this);
    });
    calculateLabourSubTotal();
  });
})();
