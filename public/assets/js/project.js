(function () {
  function initProjectBlock(container) {
    var $container = $(container || document);
    var $customer = $container.find('#customer');
    var $job = $container.find('#job');
    var $location = $container.find('#location');

    var allCustomers = [];
    var allJobs = [];
    var allLocations = [];

    function populate($select, items, selectedId) {
      $select.empty().append('<option value="">Select...</option>');
      $.each(items, function (_, item) {
        var label = item.name || item.text;  // ← это ключевая строка
        $select.append('<option value="' + item.id + '">' + label + '</option>');
      });
      if (selectedId) $select.val(selectedId).trigger('change.select2');
    }    

    function loadInitialData() {
      $.getJSON('./api.php?endpoint=get_customers', function (data) {
        allCustomers = data;
        populate($customer, allCustomers);
      });

      $.getJSON('./api.php?endpoint=get_jobs', function (data) {
        allJobs = data;
        populate($job, allJobs);
      });

      $.getJSON('./api.php?endpoint=get_locations', function (data) {
        allLocations = data;
        populate($location, allLocations);
      });
    }

    $customer.select2({ placeholder: 'Select Customer...', minimumResultsForSearch: Infinity, width: '100%' });
    $job.select2({ placeholder: 'Select Job...', minimumResultsForSearch: Infinity, width: '100%' });
    $location.select2({ placeholder: 'Select LSD...', minimumResultsForSearch: Infinity, width: '100%' });

    $customer.on('change', function () {
      var customerId = $(this).val();

      if (!customerId) {
        populate($job, allJobs);
        populate($location, allLocations);
        return;
      }

      var jobs = allJobs.filter(j => j.customer_id == customerId);
      populate($job, jobs);

      var jobIds = jobs.map(j => j.id);
      var locs = allLocations.filter(l => jobIds.includes(l.job_id));
      populate($location, locs);
    });

    $job.on('change', function () {
      var jobId = $(this).val();

      if (!jobId) {
        populate($location, allLocations);
        return;
      }

      var job = allJobs.find(j => j.id == jobId);
      if (job) {
        populate($customer, allCustomers, job.customer_id);
      }

      var locs = allLocations.filter(l => l.job_id == jobId);
      populate($location, locs);
    });

    $location.on('change', function () {
      var locId = $(this).val();
      var location = allLocations.find(l => l.id == locId);
      if (!location) return;

      var job = allJobs.find(j => j.id == location.job_id);
      var customer = allCustomers.find(c => c.id == job.customer_id);

      populate($customer, allCustomers, customer.id);

      var jobs = allJobs.filter(j => j.customer_id == customer.id);
      populate($job, jobs, job.id);

      var locs = allLocations.filter(l => l.job_id == job.id);
      populate($location, locs, locId);
    });

    loadInitialData();
  }

  window.initProjectBlock = initProjectBlock;

  $(document).ready(function () {
    initProjectBlock();
  });
})();
