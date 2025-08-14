function redirectpage(pagename) {
    window.location.href = window.origin + '/' + pagename;
}

// Function to handle form submission
function submitForm(formData) {
    $('#changetext').html('Please wait ....').attr('disabled', true);
    $('.error-message').empty().removeClass('text-danger');
    $('.is-invalid').removeClass('is-invalid');

    $.ajax({
        method: 'POST',
        url: formData.attr('action'),
        data: new FormData(formData[0]),
        processData: false,
        contentType: false,
        success: function(res) {
            $('#changetext').html('Submit').attr('disabled', false);
            if (res.code == 200) {
                $('#success').html(res.message);
                setTimeout(() => {
                    window.location.href =   window.location.href;

                }, 1000);
            } else {
                $('#password-error').html(res.message);
                $('.error-message').addClass('text-danger');
            }
        },
        error: function(xhr, status, error) {
            $('#changetext').html('Submit').attr('disabled', false);
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function(key, value) {
                    var inputField = $('[name="' + key + '"]');
                    var errorContainer = $('#' + key + '-error');
                    errorContainer.html(value[0]).addClass('text-danger');
                    inputField.addClass('is-invalid');
                });
            } else {
                alert("An error occurred. Please try again later.");
            }
        }
    });
}

// Event listener for form submission
$('#companyadmin, #companyadminedit').on('submit', function(e) {
    e.preventDefault();
    submitForm($(this));
});


function confirmDelete(id, type) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You want to '+type +' this record!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, '+type +' it!'
    }).then((result) => {
        if (result.isConfirmed) {
            let token = $('meta[name="csrf-token"]').attr('content');

            // If user confirms, send Ajax request to delete the record
            $.ajax({
                url: '/admin/books/delete/' + id, // Update the URL to your delete route
                type: 'POST',
                data: {
                    _token: token, // Include CSRF token in the request
                    type: type, // Include CSRF token in the request
                    id: id, // Include CSRF token in the request
                },
                success: function(response) {
                    // If delete is successful, show success message
                    Swal.fire(
                        type,
                        'Record has been ' + type+'.',
                        'success'
                    ).then(() => {
                        // Reload the page or update the table as per your requirement
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
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


