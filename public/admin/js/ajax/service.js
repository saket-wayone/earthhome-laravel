function redirectpage(pagename) {
    window.location.href = window.origin + '/' + pagename;
}
$('#tenure-in-days, #tenure-in-months').change(function () {
    calculateExpiryDate();
});
$('#package-amount, #paid-amount').on('input', function() {
    calculateAmounts();
});

function calculateAmounts() {
    let packageAmount = parseFloat($('#package-amount').val()) || 0;
    let paidAmount = parseFloat($('#paid-amount').val()) || 0;

    if (packageAmount > 0) {
        let discountAmount = packageAmount - paidAmount;
        let discountPercentage = (discountAmount / packageAmount) * 100;
        let balanceAmount = packageAmount - paidAmount;
        let bookingProfitAmount =packageAmount - paidAmount ;

        $('#discount-amount').val(Math.round(discountAmount));
        $('#discount-percentage').val(Math.round(discountPercentage));
        $('#balance-amount').val(Math.round(balanceAmount));
        // $('#booking-profit-amount').val(Math.round(bookingProfitAmount));
        $('#booking-profit-amount').val('');
    } else {
        $('#discount-amount').val('');
        $('#discount-percentage').val('');
        $('#balance-amount').val('');
        $('#booking-profit-amount').val('');
    }
}



function calculateExpiryDate() {
    let currentDate = new Date();
    let days = $('#tenure-in-days').val();
    let months = $('#tenure-in-months').val();
    
    if (days) {
        currentDate.setDate(currentDate.getDate() + parseInt(days));
        $('#tenure-in-months').val('');
    } else if (months) {
        currentDate.setMonth(currentDate.getMonth() + parseInt(months));
        $('#tenure-in-days').val('');
    }

    let expiryDateString = currentDate.toISOString().split('T')[0];
    $('#expiry-date').val(expiryDateString);
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
                    window.location.href = window.origin+ '/admin/risk-assement/download/' +res.id;

                }, 1000);
            } else if (res.code == 202) {
                $('#success').html(res.message);

                window.location.href = window.origin + '/admin/mr';


            }else if (res.code == 409) {
                    $('#success').html(res.message);
                    $('#username').html(res.name);
                    $('#user_email').html(res.email);
                    $('#user_mobile').html(res.phone);
                    $('#user_score').html(res.points);
                    $('#risk_factor').html(res.risk);
                    $('#showandhidebutton').hide();
                    $('#scoresection').show();
    
                    // window.location.href = window.origin + '/admin/mr';
    
    
                


            } else if (res.code == 407) {
                $('#crediterror').html(res.message);



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
                url: '/admin/risk-assement/delete/' + id, // Update the URL to your delete route
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
                        'Record has been ' + type + '.',
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



document.addEventListener('DOMContentLoaded', (e) => {
    document.querySelector('#deleteaggrement').addEventListener('click', (e) => {

        let id  = document.getElementById('servicemainid').value;
         let type  = 'delete';
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
                    url: '/admin/serviceagreement/aggrement/' + id, // Update the URL to your delete route
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
                          window.location.href= window.origin + '/admin/risk-assement';
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

    })
})