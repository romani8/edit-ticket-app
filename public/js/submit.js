(function () {
  const $finishButton = $('#finish-button');
  const nullIfUndefined = val => (val === undefined || val === '') ? null : val;

  $finishButton.on('click', () => {
    const project = {
      customer_id: nullIfUndefined($('#customer').val()),
      job_id: nullIfUndefined($('#job').val()),
      location_id: nullIfUndefined($('#location').val()),
      status: $('#status').val(),
      ordered_by: $('#ordered_by').val(),
      ticket_date: $('#ticket_date').val(),
      area: $('#area').val(),
      description: tinymce.get('description').getContent(),
      labour_subtotal: $('#labour-subtotal').val(),
      truck_subtotal: $('#truck-subtotal').val(),
      misc_subtotal: $('#misc-subtotal').val()
    };

    const labour = $('.labour-row').map((_, row) => {
      const $row = $(row);
      return {
        staff_id: nullIfUndefined($row.find('[name*="[staff_id]"]').val()),
        staff_position_id: nullIfUndefined($row.find('[name*="[position_id]"]').val()),        
        uom: $row.find('[name*="[uom]"]').val(),
        regular_hours: $row.find('[name*="[reg_hours]"]').val(),
        overtime_hours: $row.find('[name*="[ot_hours]"]').val(),
        regular_rate: $row.find('[name*="[reg_rate]"]').val(),
        overtime_rate: $row.find('[name*="[ot_rate]"]').val(),
        total: $row.find('[name*="[total]"]').val()
      };
    }).get();

    const truck = $('.truck-row').map((_, row) => {
      const $row = $(row);
      return {
        truck_id: nullIfUndefined($row.find('[name*="[truck_id]"]').val()),
        uom: $row.find('[name*="[uom]"]').val(),
        quantity: $row.find('[name*="[quantity]"]').val(),
        rate: $row.find('[name*="[rate]"]').val(),
        total: $row.find('[name*="[total]"]').val()
      };
    }).get();

    const misc = $('.misc-row').map((_, row) => {
      const $row = $(row);
      return {
        description: $row.find('[name*="[description]"]').val(),
        cost: $row.find('[name*="[cost]"]').val(),
        price: $row.find('[name*="[price]"]').val(),
        quantity: $row.find('[name*="[quantity]"]').val(),
        total: $row.find('[name*="[total]"]').val()
      };
    }).get();

    console.log(JSON.stringify({ project, labour, truck, misc }));

    fetch('./api/save_ticket.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ project, labour, truck, misc })
    })
      .then(res => res.json())
      .then(res => {
        alert(res.status === 'success' ? 'Ticket created.' : 'Failed to create ticket.');
        console.log(res);
      });
  });
})();
