(function () {
  function initMiscRow(row) {
    var $row = $(row);
    var $desc = $row.find('.misc-desc');
    var $cost = $row.find('.misc-cost');
    var $price = $row.find('.misc-price');
    var $quantity = $row.find('.misc-quantity');
    var $total = $row.find('.misc-total');

    $desc.val('');

    $price.add($quantity).add($cost).on('input', function () {
      calculateTotal();
    });

    function calculateTotal() {
      var cost = parseFloat($cost.val()) || 0;
      var quantity = parseFloat($quantity.val()) || 0;
      var price = parseFloat($price.val()) || 0;
      $total.val((cost * quantity * price).toFixed(2));
      calculateMiscSubTotal();
    }
  }

  function calculateMiscSubTotal() {
    var subtotal = 0;
    $('.misc-row').each(function () {
      var rowTotal = parseFloat($(this).find('.misc-total').val()) || 0;
      subtotal += rowTotal;
    });
    $('#misc-subtotal').val(subtotal.toFixed(2));
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
    calculateMiscSubTotal();
  }

  function removeMiscRow(btn) {
    var rows = $('.misc-row');
    if (rows.length > 1) {
      $(btn).closest('.misc-row').remove();
      calculateMiscSubTotal();
    }
  }

  window.initMiscRow = initMiscRow;
  window.addMiscRow = addMiscRow;
  window.removeMiscRow = removeMiscRow;

  $(document).ready(function () {
    $('.misc-row').each(function () {
      initMiscRow(this);
    });
    calculateMiscSubTotal();
  });
})();
