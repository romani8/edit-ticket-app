(function () {
  function initTruckRow(row) {
    var $row = $(row);
    var $truck = $row.find('.truck-select');
    var $uom = $row.find('.uom-select');
    var $rate = $row.find('.rate');
    var $quantity = $row.find('.quantity');
    var $total = $row.find('.total');

    $truck.html('<option value="">Select Truck...</option>');

    $.getJSON('./api.php?endpoint=get_trucks', function (truckList) {
      $.each(truckList, function (_, item) {
        var $option = $('<option>')
          .val(item.id)
          .text(item.text)
          .data({
            hourly_rate: item.hourly_rate,
            fixed_rate: item.fixed_rate,
            uom: item.uom
          });
        $truck.append($option);
      });
    });

    $truck.select2({
      placeholder: 'Select Truck...',
      minimumResultsForSearch: Infinity,
      width: '100%'
    });

    $truck.on('change', function () {
      var $selected = $truck.find('option:selected');
      if (!$selected.length) return;

      var hourlyRate = $selected.data('hourly_rate') || 0;
      var fixedRate = $selected.data('fixed_rate') || 0;
      var uom = $selected.data('uom') || 'Hourly';

      $uom.val(uom);
      $rate.val(uom === 'Fixed' ? fixedRate : hourlyRate);
      calculateTotal();
    });

    $uom.on('change', function () {
      var $selected = $truck.find('option:selected');
      if (!$selected.length) return;

      var hourlyRate = $selected.data('hourly_rate') || 0;
      var fixedRate = $selected.data('fixed_rate') || 0;
      var uom = $uom.val();

      $rate.val(uom === 'Fixed' ? fixedRate : hourlyRate);
      calculateTotal();
    });

    $quantity.on('input', function () {
      calculateTotal();
    });

    function calculateTotal() {
      var quantity = parseFloat($quantity.val()) || 0;
      var rate = parseFloat($rate.val()) || 0;
      $total.val((quantity * rate).toFixed(2));
      calculateTruckSubTotal();
    }
  }

  function calculateTruckSubTotal() {
    var subtotal = 0;
    $('.truck-row').each(function () {
      var rowTotal = parseFloat($(this).find('.total').val()) || 0;
      subtotal += rowTotal;
    });
    $('#truck-subtotal').val(subtotal.toFixed(2));
  }

  function addTruckRow() {
    var $template = $('.truck-row').first();
    var newIndex = $('.truck-row').length;
    var $clone = $template.clone(false).attr('data-index', newIndex);

    $clone.find('[name]').each(function () {
      var $el = $(this);
      var oldName = $el.attr('name');
      if (!oldName) return;

      var newName = oldName.replace(/\[\d+\]/, '[' + newIndex + ']');
      $el.attr('name', newName);

      if (oldName.includes('[quantity]') || oldName.includes('[rate]') || oldName.includes('[total]')) {
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

    $('#truck-section').append($clone);
    initTruckRow($clone);
    calculateTruckSubTotal();
  }

  function removeTruckRow(btn) {
    var rows = $('.truck-row');
    if (rows.length > 1) {
      $(btn).closest('.truck-row').remove();
      calculateTruckSubTotal();
    }
  }

  window.initTruckRow = initTruckRow;
  window.addTruckRow = addTruckRow;
  window.removeTruckRow = removeTruckRow;

  $(document).ready(function () {
    $('.truck-row').each(function () {
      initTruckRow(this);
    });
    calculateTruckSubTotal();
  });
})();
