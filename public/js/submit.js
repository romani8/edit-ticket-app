(function () {
    const $finishButton = $('#finish-button');
  
    $finishButton.on('click', () => {
      const project = {
        customer_id: $('#customer').val(),
        job_id: $('#job').val(),
        location_id: $('#location').val(),
        status: $('#status').val(),
        ordered_by: $('#ordered_by').val(),
        ticket_date: $('#ticket-date').val(),
        area: $('#area').val(),
        description: tinymce.get('description').getContent()
      };
  
      const labour = $('.labour-row').map((_, row) => {
        const $row = $(row);
        return {
          staff_position_id: $row.find('[name*="[position]"]').val(),
          uom: $row.find('[name*="[uom]"]').val(),
          regular_hours: $row.find('[name*="[reg_hours]"]').val(),
          overtime_hours: $row.find('[name*="[ot_hours]"]').val(),
          fixed_total: $row.find('[name*="[fixed_total]"]').val(),
          total: $row.find('[name*="[total]"]').val()
        };
      }).get();
  
      const truck = $('.truck-row').map((_, row) => {
        const $row = $(row);
        return {
          truck_id: $row.find('[name*="[label]"]').val(),
          uom: $row.find('[name*="[uom]"]').val(),
          quantity: $row.find('[name*="[qty]"]').val(),
          fixed_total: $row.find('[name*="[fixed_total]"]').val(),
          total: $row.find('[name*="[total]"]').val()
        };
      }).get();
  
      const misc = $('.misc-row').map((_, row) => {
        const $row = $(row);
        return {
          description: $row.find('[name*="[description]"]').val(),
          cost: $row.find('[name*="[cost]"]').val(),
          price: $row.find('[name*="[price]"]').val(),
          quantity: $row.find('[name*="[qty]"]').val(),
          total: $row.find('[name*="[total]"]').val()
        };
      }).get();
  
      alert('Ticket: ' + JSON.stringify({ project, labour, truck, misc }));

    //   fetch('./api/save_ticket.php', {
    //     method: 'POST',
    //     headers: { 'Content-Type': 'application/json' },
    //     body: JSON.stringify({ project, labour, truck, misc })
    //   })
    //     .then(res => res.json())
    //     .then(res => {
    //       alert(res.status === 'success' ? 'Ticket created.' : 'Failed to create ticket.');
    //     });
    });
  })();
  