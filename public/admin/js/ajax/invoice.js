$('#invoice').on('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission
    $('#changetext').html('Please wait ....').attr('disabled', true);

    // Serialize form data
    let formData = $(this).serializeArray();

    // Add services to form data
    $('#serviceList .list-group-item').each(function () {
        const serviceDescription = $(this).find('span:first-child').text();
        const serviceAmount = parseFloat($(this).find('.badge').text().replace('₹', ''));
        formData.push({ name: 'services[]', value: JSON.stringify({ description: serviceDescription, amount: serviceAmount }) });
    });


    let subtotal = $('#subtotal').html() ?? 0;
    let totalCost = $('#totalCost').text() ?? 0;
    formData.push({ name: 'subtotal', value: subtotal.replace('₹', '') });
    formData.push({ name: 'totalCost', value: totalCost.replace('₹', '') });

    // Log all data for verification

    // If you want to submit the data via AJAX
    $.ajax({
        url: $(this).attr('action'), // Use the form action
        method: $(this).attr('method'), // Use the form method
        data: formData,
        success: function (response) {
            // Handle success
            $('#changetext').html('Submit').attr('disabled', false);
            toastr.options.timeOut = 10000;
            toastr.success(response.message);
            setTimeout(() => {
                window.location.href = window.origin + '/admin/invoices/view/' + response.id;

            }, 1000);
            // You can also update the UI or redirect the user as needed
        },
        error: function (xhr, status, error) {
            // Handle error
            $('#changetext').html('Submit').attr('disabled', false);

            $.each(xhr.responseJSON.errors, function (key, value) {
                var inputField = $('[name="' + key + '"]');
                var errorContainer = $('#' + key + '-error');
                errorContainer.html(value[0]).addClass('text-danger');
                inputField.addClass('is-invalid');
            });
        }
    });
});

function confirmDelete(id, type) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You want to ' + type + ' this record!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, ' + type + ' it!'
    }).then((result) => {
        if (result.isConfirmed) {
            let token = $('meta[name="csrf-token"]').attr('content');

            // If user confirms, send Ajax request to delete the record
            $.ajax({
                url: '/admin/invoices/delete/' + id, // Update the URL to your delete route
                type: 'POST',
                data: {
                    _token: token, // Include CSRF token in the request
                    type: type, // Include CSRF token in the request
                    id: id, // Include CSRF token in the request
                },
                success: function (response) {
                    // If delete is successful, show success message
                    Swal.fire(
                        type,
                        'Record has been ' + type + '.',
                        'success'
                    ).then(() => {
                        // Reload the page or update the table as per your requirement
                        location.reload();
                    });
                },
                error: function (xhr, status, error) {
                    // If there is an error, show error message
                    Swal.fire(
                        'Error!',
                        'An error occurred while deleting the record.',
                        'error'
                    );
                }
            });
        }
    });
}

$(document).ready(function () {
    let subtotal = 0; // Variable to store subtotal

    // Add service functionality
    $('#addServiceBtn').click(function () {
        subtotal =  Number(($('#subtotal').text()).replace('₹',''));

        // Get values from input fields
        var description = $('#serviceDescription').val();
        var amount = parseFloat($('#serviceAmount').val()); // Parse to float

        // Validate input
        if (description === "" || isNaN(amount) || amount <= 0) {
            alert("Please fill in both fields with valid values.");
            return;
        }

        // Create a new list item
        var listItem = `
        <li class="list-group-item">
            <span>${description}</span>
            <span class="badge badge-primary badge-pill text-dark">₹${amount.toFixed(2)}</span>
            <button class="btn btn-danger btn-sm removeBtn">Remove</button>
        </li>`;

        // Append the new item to the list
        $('#serviceList').append(listItem);

        // Update subtotal
        subtotal += amount;
        $('#subtotal').text('₹' + subtotal.toFixed(2));

        // Calculate and display IGST (18%)
        let igst = subtotal * 0.18;
        $('#igst').text('₹' + igst.toFixed(2));

        // Calculate and display total cost
        let totalCost = subtotal + igst;
        $('#totalCost').text('₹' + totalCost.toFixed(2));

        // Clear input fields
        $('#serviceDescription').val('');
        $('#serviceAmount').val('');
    });

    // Remove service functionality
    $(document).on('click', '.removeBtn', function () {
        subtotal =  Number(($('#subtotal').text()).replace('₹',''));

        console.log(subtotal);
        // Get the amount from the corresponding badge
        var amount = parseFloat($(this).siblings('.badge').text().replace('₹', ''));
        subtotal -= amount; // Subtract the amount from subtotal

        // Remove the item from the list
        $(this).parent().remove();

        // Update the subtotal display
        $('#subtotal').text('₹' + subtotal.toFixed(2));

        // Calculate and display IGST (18%)
        let igst = subtotal * 0.18;
        $('#igst').text('₹' + igst.toFixed(2));

        // Calculate and display total cost
        let totalCost = subtotal + igst;
        $('#totalCost').text('₹' + totalCost.toFixed(2));
    });


   
    // On form submission

});


