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
        success: function (res) {
            $('#changetext').html('Submit').attr('disabled', false);
            if (res.code == 200) {
                $('#success').html(res.message);
                setTimeout(() => {
                    window.location.href = window.location.href;

                }, 1000);
            } else {
                $('#password-error').html(res.message);
                $('.error-message').addClass('text-danger');
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
    submitForm($(this));
});

function getUnassignSourceLeads(value) {
    if(value == ''){
        $('#showsourcecount').html(' ');

    }
    $('#submitbttn').show();
    $.ajax({
        method: 'POST',
        url: window.origin + '/admin/leads/assignleadcount',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: { value: value },
        success: function (res) {
            if(res == 0){
                $('#submitbttn').hide();

            }
            $('#showsourcecount').html('UNASSIGNED ' + value + ' LEADS :' + '<b>'+ res + '</b>');
            $('#unassignedleads').val(res);
            $('#maxcount').attr('max',res);
            // Handle the success response
        },
        error: function (xhr, status, error) {
            // Handle the error response
            console.error('Error:', error);
        }
    });

}