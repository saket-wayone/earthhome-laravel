var base_url = window.location.origin + "/";


$(document).on('submit', '#doctor_add', function(ev) {
    $('.error').html('');

    ev.preventDefault(); // Prevent browers default submit.
    var formData = new FormData(this);
    var error = false;

    if (error == false) {
        $.ajax({
            url: base_url + 'doctor/store',
            type: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(".submitbtn").css('display', 'none');
                $(".spinner-border").css('display', 'block');
            },
            success: function(result) {
                if (result.code == 200) {
                    showsuccess(result.message);
                    setTimeout(function() {
                        window.location.href = base_url + "doctor";
                    }, 1000);
                } else if (result.code == 401) {
                    $.each(result.message, function(prefix, val) {
                        $("#" + prefix + "_error").html(val[0]);
                        showwarning(val[0]);
                    });
                } else {
                    showerror(result.message);
                }
            },
            error: function(xhr) {
                $(".submitbtn").css('display', 'grid');
                $(".spinner-border").css('display', 'none');
            },
            complete: function() {
                $(".submitbtn").css('display', 'grid');
                $(".spinner-border").css('display', 'none');
            },
        })
    }
});

function incrementValues() {
    var elements = document.querySelectorAll('.citydiv .increaseval');
    elements.forEach(function(element) {
        var currentValue = parseInt(element.textContent.trim());
        element.textContent = currentValue + 1;
    });
}


function showeditmodulediv(id) {
    $.ajax({
        url: base_url + "admin/master/city/edit",
        data: {
            id: id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        success: function(result) {
            $(".editstaffdiv").html(result);
        },
    })
}




function showsuccess(msg) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "success",
        title: msg
    });
}

function showerror(msg) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "error",
        title: msg
    });
}

function showwarning(msg) {
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });
    Toast.fire({
        icon: "warning",
        title: msg
    });
}




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
                url: 'doctor/delete/' + id, // Update the URL to your delete route
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



$(document).on('submit', '#doctor_update', function(ev) {
    $('.error').html('');

    ev.preventDefault(); // Prevent browers default submit.
    var formData = new FormData(this);
    var error = false;

    if (error == false) {
        $.ajax({
            url: base_url + 'doctor/update',
            type: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(".submitbtn").css('display', 'none');
                $(".spinner-border").css('display', 'block');
            },
            success: function(result) {
                if (result.code == 200) {
                    showsuccess(result.message);
                    setTimeout(function() {
                        window.location.href = base_url + "doctor";
                    }, 1000);
                } else if (result.code == 401) {
                    $.each(result.message, function(prefix, val) {
                        $('#' + prefix + '_error2').text(val[0]);
                        showwarning(val[0]);
                    });
                } else {
                    showerror(result.message);
                }
            },
            error: function(xhr) {
                $(".submitbtn").css('display', 'grid');
                $(".spinner-border").css('display', 'none');
            },
            complete: function() {
                $(".submitbtn").css('display', 'grid');
                $(".spinner-border").css('display', 'none');
            },
        })
    }
});



$(document).on('submit', '#importexcel', function(ev) {
    $('.error').html('');

    ev.preventDefault(); // Prevent browers default submit.
    var formData = new FormData(this);
    var error = false;

    if (error == false) {
        $.ajax({
            url: base_url + 'doctor/importexcel',
            type: 'post',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $(".submitbtn").css('display', 'none');
                $(".spinner-border").css('display', 'block');
            },
            success: function(result) {
                if (result.code == 200) {
                    showsuccess(result.message);
                    setTimeout(function() {
                        window.location.href = base_url + "doctor";
                    }, 1000);
                } else if (result.code == 401) {
                    $.each(result.message, function(prefix, val) {
                        $("#" + prefix + "_error").html(val[0]);
                        showwarning(val[0]);
                    });
                } else {
                    showerror(result.message);
                }
            },
            error: function(xhr) {
                $(".submitbtn").css('display', 'grid');
                $(".spinner-border").css('display', 'none');
            },
            complete: function() {
                $(".submitbtn").css('display', 'grid');
                $(".spinner-border").css('display', 'none');
            },
        })
    }
});