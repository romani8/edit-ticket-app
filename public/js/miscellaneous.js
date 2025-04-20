(function () {
    function initMiscRow(row) {
      var $row = $(row);
      var $desc = $row.find('.misc-desc');
      var $cost = $row.find('.misc-cost');
      var $price = $row.find('.misc-price');
      var $qty = $row.find('.misc-qty');
      var $total = $row.find('.misc-total');
  
      $desc.val('');
  
      $price.add($qty).off('input').on('input', function () {
        calculateTotal();
      });
  
      function calculateTotal() {
        var qty = parseFloat($qty.val()) || 0;
        var price = parseFloat($price.val()) || 0;
        $total.val((qty * price).toFixed(2));
      }
    }
  
    function addMiscRow() {
      var $template = $('.misc-row').first();
      var newIndex = $('.misc-row').length;
      var $clone = $template.clone(true, true).attr('data-index', newIndex);
  
      $clone.find('[name]').each(function () {
        var $el = $(this);
        var oldName = $el.attr('name');
        var newName = oldName.replace(/\[\d+\]/, '[' + newIndex + ']');
        $el.attr('name', newName).val('');
      });
  
      $('#misc-section').append($clone);
      initMiscRow($clone);
    }
  
    function removeMiscRow(btn) {
      var rows = $('.misc-row');
      if (rows.length > 1) {
        $(btn).closest('.misc-row').remove();
      }
    }
  
    window.initMiscRow = initMiscRow;
    window.addMiscRow = addMiscRow;
    window.removeMiscRow = removeMiscRow;
  
    $(document).ready(function () {
      $('.misc-row').each(function () {
        initMiscRow(this);
      });
    });
  })();
  