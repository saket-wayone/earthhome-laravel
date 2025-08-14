function redirectpage(pagename) {
    window.location.href = window.origin + '/' + pagename;
}

function savename(button){
    $('#pagename').val(button)
}

// Function to handle form submission

// Function to handle form submission
function submitForm(formData) {
    let location = window.location.href;

    if ($('#pagename').val() === 'next') {
        location = window.location.origin + '/admin/leads/edit/' + $('#next').val();
    }

    
    $('#changetext').html('Please wait ....').attr('disabled', true);
    $('.error-message').empty().removeClass('text-danger');
    $('.is-invalid').removeClass('is-invalid');
    $('.hidesection').addClass('hidesection');
    $('.pagination').css('display','none');

    $.ajax({
        method: 'POST',
        url: formData.attr('action'),
        data: new FormData(formData[0]),
        processData: false,
        contentType: false,
        success: function (res) {

            $('#changetext').html('Submit').attr('disabled', false);
            if (res.code == 200) {
                $('#success').html(res.message);
                // showsuccess(res.message);
                setTimeout(() => {
                    window.location.href = location ;

                }, 1000);
            } else {


                if (res.code == 215) {
                    $('#appendleads').html(res.data);
                    $('#totalcount').addClass('col-md-4 alert alert-info');
                    $('#totalcount').html(`Total: ${res.totalcount} leads`);
                } else {
                    if (res.code == 216) {
                    $('#appendleads').html(res.data);
                    $('#totalcount').addClass('col-md-4 alert alert-info');
                    $('#totalcount').html(`Total Sales:  ₹ ${res.totalcount} `);
                } else{
                    $('#password-error').html(res.message);
                    $('.error-message').addClass('text-danger');
                }
                    
                }

            }
        },
        error: function (xhr, status, error) {
            $('#changetext').html('Submit').attr('disabled', false);
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function (key, value) {
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
$('#companyadmin, #companyadminedit').on('submit', function (e) {
    e.preventDefault();
    submitForm($(this) );
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
                url: '/admin/leads/delete/' + id, // Update the URL to your delete route
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


function changestatus(value) {
    $('#paymentsection').hide();
    $('#paidamount').attr('required', false);
    if (value == 'Paid') {
        $('#paymentsection').show();
        $('#paidamount').attr('required', true);
    }
}