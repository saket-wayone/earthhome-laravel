function redirectpage(pagename) {
    window.location.href = window.origin + '/' + pagename;
}


function playErrorAudio() {
    var audioSrc = window.origin + '/sample/audio/error.mp3'; // Laravel asset URL
    var audio = new Audio(audioSrc);
    audio.play();
    
}

function playSuccessAudio() {
    var audioSrc = window.origin + '/sample/audio/sucess.mp3'; // Laravel asset URL
    var audio = new Audio(audioSrc);
    audio.play();
    
}
$('#loginauth').on('submit', function (e) {
    e.preventDefault();
    $('.toggle-password').removeClass('custom-top');
    $('.toggle-password').removeClass('custom-right');

    const Formdata = new FormData(this);
    $('.error-message').empty().removeClass('text-danger');
    $('.is-invalid').removeClass('is-invalid');
    $('#processing').html('Please Wait....');
    $('#processing').attr('disabled', true);
    $('#success').html('');

    $.ajax({
        method: 'POST',
        url: $(this).attr('action'),
        data: Formdata,
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Prevent jQuery from setting the Content-Type header
        success: function (res) {
            $('#processing').attr('disabled', false);
            $('#processing').html('Send Verification');
            $('#processing').html('Send Verification code');



            if (res.code == 200) {
                $('#processing').html('Verification Code  has been sent');
                $('.toggle-password').addClass('custom-top');

                toastr.options.timeOut = 10000;
                toastr.success(res.message);
                playSuccessAudio();
                setTimeout(() => {
                    
                    redirectpage('admin/dashboard');
                }, 500);

            } else {
                if (res.code == 203) {
                    toastr.options.timeOut = 10000;
                    toastr.info(res.message);
                    $('#authcodeinput').attr('required', true);
                    $('#success').html(res.message);
                    $('.toggle-password').addClass('custom-top');
                    $('#authcode').show();
                    playErrorAudio();


                } else {
                    if (res.message == 'Wrong Code' || 'Invalid Credentials!') {
                        $('.toggle-password').addClass('custom-top');
                    }
                    $('.error-message').addClass('text-danger');
                    toastr.options.timeOut = 10000;
                    toastr.error(res.message);

                    playErrorAudio();


                }


            }
        },
        error: function (xhr, status, error) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $('#processing').attr('disabled', false);
                $('#processing').html('Send Verification code');

                // Loop through each error in the response
                $.each(xhr.responseJSON.errors, function (key, value) {
                    // Get the corresponding input field and its error container
                    var inputField = $('[name="' + key + '"]');
                    if (key == 'password') {
                        $('.toggle-password').addClass('custom-top');
                        $('.toggle-password').addClass('custom-right');
                    } else {
                        $('.toggle-password').removeClass('custom-top');
                        $('.toggle-password').removeClass('custom-right');
                    }
                    var errorContainer = $('#' + key + '-error');
                    // Display the error message below the input field
                    toastr.options.timeOut = 10000;
                    toastr.error(value[0]);
                    // Add a CSS class to style the error message
                    errorContainer.addClass('text-danger');
                    // Optionally, you can also add red border to the input field
                    inputField.addClass('is-invalid');
                    playErrorAudio();


                });
            } else {
                $('#processing').attr('disabled', false);

                alert("An error occurred. Please try again later.");
            }
        }
    })

});



$('#forgotauth').on('submit', function (e) {
    e.preventDefault();
    const Formdata = new FormData(this);
    $('.error-message').empty().removeClass('text-danger');
    $('.is-invalid').removeClass('is-invalid');
    $('#processing').html('Please Wait....');
    $('#processing').attr('disabled', true);

    $.ajax({
        method: 'POST',
        url: $(this).attr('action'),
        data: Formdata,
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Prevent jQuery from setting the Content-Type header
        success: function (res) {
            $('#processing').attr('disabled', false);
            $('#processing').html('Send Verification');
            $('#processing').html('Send Verification code');

            if (res.code == 200) {

                $('#processing').html('Verification Code  has been sent to your email');
                $('#success').html(res.message);
                $('#emailsent').val(1);
                setTimeout(() => {
                    $('#otpsection').show();
                    $('#processing').html('Enter Code!');

                }, 500)
                $('#email').attr('readonly', true);
            } else {

                if (res.code == 201) {
                    $('#forgotauth').hide();
                    $('#newpasswordform').show();
                } else {
                    if (res.code == 403) {
                        $('#otp-error').html(res.message);
                        $('.error-message').addClass('text-danger');
                    } else {
                        $('#password-error').html(res.message);
                        $('.error-message').addClass('text-danger');
                    }
                }




            }
        },
        error: function (xhr, status, error) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $('#processing').attr('disabled', false);
                $('#processing').html('Send Verification code');

                // Loop through each error in the response
                $.each(xhr.responseJSON.errors, function (key, value) {
                    // Get the corresponding input field and its error container
                    var inputField = $('[name="' + key + '"]');
                    var errorContainer = $('#' + key + '-error');
                    // Display the error message below the input field
                    errorContainer.html(value[0]);
                    // Add a CSS class to style the error message
                    errorContainer.addClass('text-danger');
                    // Optionally, you can also add red border to the input field
                    inputField.addClass('is-invalid');
                });
            } else {
                $('#processing').attr('disabled', false);

                alert("An error occurred. Please try again later.");
            }
        }
    })

});


$('#newpasswordform').on('submit', function (e) {
    e.preventDefault();
    var email = $('#email').val();
    const Formdata = new FormData(this);
    Formdata.append('email', email);
    $('.error-message').empty().removeClass('text-danger');
    $('.is-invalid').removeClass('is-invalid');
    $('#processing1').html('Please Wait....');
    $('#processing1').attr('disabled', true);

    $.ajax({
        method: 'POST',
        url: $(this).attr('action'),
        data: Formdata,
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Prevent jQuery from setting the Content-Type header
        success: function (res) {
            $('#processing1').attr('disabled', false);
            $('#processing1').html('Submit');

            if (res.code == 200) {
                $('#successreset').html(res.message);
                setTimeout(() => {
                    window.location.href = window.origin;

                }, 800)

            } else {


                if (res.code == 403) {
                    $('#otp-error').html(res.message);
                    $('.error-message').addClass('text-danger');
                } else {
                    $('#newpassword-error').html(res.message);
                    $('.error-message').addClass('text-danger');
                }


            }
        },
        error: function (xhr, status, error) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $('#processing').attr('disabled', false);
                $('#processing').html('Send Verification code');

                // Loop through each error in the response
                $.each(xhr.responseJSON.errors, function (key, value) {
                    // Get the corresponding input field and its error container
                    var inputField = $('[name="' + key + '"]');
                    var errorContainer = $('#' + key + '-error');
                    // Display the error message below the input field
                    errorContainer.html(value[0]);
                    // Add a CSS class to style the error message
                    errorContainer.addClass('text-danger');
                    // Optionally, you can also add red border to the input field
                    inputField.addClass('is-invalid');
                });
            } else {
                $('#processing').attr('disabled', false);

                alert("An error occurred. Please try again later.");
            }
        }
    })

});
$('#regsiterauth').on('submit', function (e) {
    e.preventDefault();
    const Formdata = new FormData(this);
    Formdata.append('role', 'company_admin');
    $('.error-message').empty().removeClass('text-danger');
    $('.is-invalid').removeClass('is-invalid');
    $.ajax({
        method: 'POST',
        url: $(this).attr('action'),
        data: Formdata,
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Prevent jQuery from setting the Content-Type header
        success: function (res) {
            if (res.code == 200) {
                $('#success').html(res.message);
                redirectpage('admin/dashboard');

            } else {
                $('#password-error').html(res.message);
                $('.error-message').addClass('text-danger');
            }
        },
        error: function (xhr, status, error) {
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                // Loop through each error in the response
                $.each(xhr.responseJSON.errors, function (key, value) {
                    // Get the corresponding input field and its error container
                    var inputField = $('[name="' + key + '"]');
                    var errorContainer = $('#' + key + '-error');
                    // Display the error message below the input field
                    errorContainer.html(value[0]);
                    // Add a CSS class to style the error message
                    errorContainer.addClass('text-danger');
                    // Optionally, you can also add red border to the input field
                    inputField.addClass('is-invalid');
                });
            } else {
                alert("An error occurred. Please try again later.");
            }
        }
    })

});