(function () {
    function initTruckRow(row) {
      var $row = $(row);
      var $truck = $row.find('.truck-select');
      var $uom = $row.find('.uom-select');
      var $rate = $row.find('.rate');
      var $qty = $row.find('.quantity');
      var $total = $row.find('.total');
  
      $truck.html('<option value="">Select Truck...</option>');
  
      $.getJSON('./api/get_trucks.php', function (truckList) {
        $.each(truckList, function (_, item) {
          var $option = $('<option>')
            .val(item.id)
            .text(item.text)
            .data({
              rate: item.rate,
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
        var rate = $selected.data('rate') || 0;
        var uom = $selected.data('uom') || 'Hourly';
        $rate.val(rate);
        $uom.val(uom);
        calculateTotal();
      });
  
      $qty.on('input', function () {
        calculateTotal();
      });
  
      function calculateTotal() {
        var qty = parseFloat($qty.val()) || 0;
        var rate = parseFloat($rate.val()) || 0;
        $total.val((qty * rate).toFixed(2));
      }
    }
  
    function addTruckRow() {
      var $template = $('.truck-row').first();
      var newIndex = $('.truck-row').length;
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
  
      $('#truck-section').append($clone);
      initTruckRow($clone);
    }
  
    function removeTruckRow(btn) {
      var rows = $('.truck-row');
      if (rows.length > 1) {
        $(btn).closest('.truck-row').remove();
      }
    }
  
    window.initTruckRow = initTruckRow;
    window.addTruckRow = addTruckRow;
    window.removeTruckRow = removeTruckRow;
  
    $(document).ready(function () {
      $('.truck-row').each(function () {
        initTruckRow(this);
      });
    });
  })();
  