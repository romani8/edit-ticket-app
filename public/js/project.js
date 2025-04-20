(function () {
    function initProjectBlock(container) {
      var $container = $(container || document);
      var $customer = $container.find('#customer');
      var $job = $container.find('#job');
      var $location = $container.find('#location');
  
      $customer.html('<option value="">Select Customer...</option>');
      $.getJSON('./api/get_customers.php', function (data) {
        $.each(data, function (_, item) {
          $customer.append('<option value="' + item.id + '">' + item.text + '</option>');
        });
      });
  
      $customer.select2({
        placeholder: 'Select Customer...',
        minimumResultsForSearch: Infinity,
        width: '100%'
      });
  
      $job.select2({
        placeholder: 'Select Job...',
        minimumResultsForSearch: Infinity,
        width: '100%'
      });
  
      $location.select2({
        placeholder: 'Select LSD...',
        minimumResultsForSearch: Infinity,
        width: '100%'
      });
  
      $customer.on('change', function () {
        var id = $(this).val();
        $job.prop('disabled', !id).empty().append('<option value="">Select Job...</option>');
        $location.prop('disabled', true).empty().append('<option value="">Select LSD...</option>');
  
        if (!id) return;
  
        $.getJSON('./api/get_jobs.php', { customer_id: id }, function (data) {
          $.each(data, function (_, v) {
            $job.append('<option value="' + v.id + '">' + v.name + '</option>');
          });
        });
      });
  
      $job.on('change', function () {
        var id = $(this).val();
        $location.prop('disabled', !id).empty().append('<option value="">Select LSD...</option>');
  
        if (!id) return;
  
        $.getJSON('./api/get_locations.php', { job_id: id }, function (data) {
          $.each(data, function (_, v) {
            $location.append('<option value="' + v.id + '">' + v.name + '</option>');
          });
        });
      });
    }
  
    window.initProjectBlock = initProjectBlock;
  
    $(document).ready(function () {
      initProjectBlock();
    });
  })();
  