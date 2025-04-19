$(function () {
    $.getJSON('./api/get_customers.php', function (data) {
        $.each(data, function (_, v) {
            $('#customer').append('<option value="' + v.id + '">' + v.text + '</option>');
        });
    });
    
    $('#customer').select2({
        placeholder: 'Select Customer…',
        minimumResultsForSearch: Infinity
    });
    
    $('#job').select2({
        placeholder: 'Select Job…',
        minimumResultsForSearch: Infinity
    });
    
    $('#location').select2({
        placeholder: 'Select LSD…',
        minimumResultsForSearch: Infinity
    });

    $('#customer').on('change', function () {
        const id = $(this).val();
        $('#job').prop('disabled', !id).empty();
        $('#location').prop('disabled', true).empty();
        if (!id) return;
        $.getJSON('./api/get_jobs.php', { customer_id: id }, function (data) {
            $('#job').append('<option value="">Select Job…</option>');
            $.each(data, function (_, v) {
                $('#job').append('<option value="' + v.id + '">' + v.name + '</option>');
            });
        });
    });

    $('#job').on('change', function () {
        const id = $(this).val();
        $('#location').prop('disabled', !id).empty();
        if (!id) return;
        $.getJSON('./api/get_locations.php', { job_id: id }, function (data) {
            $('#location').append('<option value="">Select LSD…</option>');
            $.each(data, function (_, v) {
                $('#location').append('<option value="' + v.id + '">' + v.name + '</option>');
            });
        });
    });
});
