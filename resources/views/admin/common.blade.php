@extends('admin.layout')
@section('content')
<style>
    table thead {
        background-color: black;
        color: white;
    }
</style>


<div class="row">

    <div class="row">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Update Note</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <form action="{{route('comman.store')}}" id="companyadmin" method="post">
                                @csrf()
                                <div class="row">
                                    <!--end col-->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="compnayNameinput" class="form-label">Note</label>
                                            <input type="text" class="form-control" name="note" value="{{$note->note ?? ''}}" placeholder="Enter note" id="compnayNameinput">
                                            <div class="error-message" id="note-error"></div>

                                        </div>
                                    </div>




                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="text-start">
                                            <div class="text-success" id="success"></div>

                                            <button type="submit" class="btn btn-dark" id="changetext">Submit</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->


        </div>
    </div>
</div> <!-- end col -->
</div>


<script> 
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
                    window.location.href = window.location.href;

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

</script>

</div>
@endsection