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
  
      $.getJSON('./api/get_staff.php', function (staffList) {
        $.each(staffList, function (i, staff) {
          $staff.append('<option value="' + staff.id + '">' + staff.text + '</option>');
        });
      });
  
      $staff.select2({
        placeholder: 'Select Staff...',
        minimumResultsForSearch: Infinity,
        width: '100%'
      });
  
      $position.select2({
        placeholder: 'Select Position...',
        minimumResultsForSearch: Infinity,
        width: '100%'
      });
  
      $staff.on('change', function () {
        var staffId = $staff.val();
        $position.prop('disabled', !staffId).html('<option value="">Select Position...</option>');
        $regRate.val('');
        $otRate.val('');
        $uom.val('Hourly');
  
        if (!staffId) return;
  
        $.getJSON('./api/get_staff_positions.php', { staff_id: staffId }, function (positions) {
          $.each(positions, function (i, pos) {
            var $option = $('<option>')
              .val(pos.id)
              .text(pos.text)
              .data({
                reg_rate: pos.reg_rate,
                ot_rate: pos.ot_rate,
                uom: pos.uom
              });
            $position.append($option);
          });
        });
      });
  
      $position.on('change', function () {
        var $selected = $position.find('option:selected');
        $regRate.val($selected.data('reg_rate') || '');
        $otRate.val($selected.data('ot_rate') || '');
        $uom.val($selected.data('uom') || 'Hourly');
      });
    }
  
    function addLabourRow() {
      var $template = $('.labour-row').first();
      var newIndex = $('.labour-row').length;
      var $clone = $template.clone(true, true).attr('data-index', newIndex);
  
      $clone.find('[name]').each(function () {
        var $el = $(this);
        var oldName = $el.attr('name');
        var newName = oldName.replace(/\[\d+\]/, '[' + newIndex + ']');
        $el.attr('name', newName).val('');
        if ($el.is('select')) {
          $el.empty();
        }
      });
  
      $('#labour-section').append($clone);
      initLabourRow($clone);
    }
  
    function removeRow(btn) {
      var rows = $('.labour-row');
      if (rows.length > 1) {
        $(btn).closest('.labour-row').remove();
      }
    }
  
    window.initLabourRow = initLabourRow;
    window.addLabourRow = addLabourRow;
    window.removeRow = removeRow;
  
    $(document).ready(function () {
      $('.labour-row').each(function () {
        initLabourRow(this);
      });
    });
  })();
  