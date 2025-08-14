<input type="hidden" class="form-control" name="rowid" id="leadid" value="{{ $lead->id }}">
@csrf()
<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="">
            <label for="teammembersName" class="form-label">Update Status </label>
            <select class="form-control" name="status" id="status" style="width: 100%">
                <option value="">Select Status</option>

                <option value="Pending" @if ($lead->status =='Pending')
                    {{'selected'}}
                    @endif>Pending
                </option>
                <option value="Completed" @if ($lead->status =='Completed')
                    {{'selected'}}
                    @endif>Completed
                </option>

            </select>
        </div>
        <div class="error" id="new_password_error"></div>
        <div class="success  text-success" id="updatestatusinfo"></div>
    </div>
    
    <div class="col-lg-12 mb-3">
        <div class="">
            <label for="payment_mode2" class="form-label">Payment Mode </label>
            <select class="form-control" name="payment_mode2" id="payment_mode2" style="width: 100%">
                <option value="">Select Payment Mode</option>

                <option value="Cash" @if ($lead->payment_mode2 =='Cash')
                    {{'selected'}}
                    @endif>Cash
                </option>
                <option value="Online" @if ($lead->payment_mode2 =='Online')
                    {{'selected'}}
                    @endif>Online
                </option>

            </select>
        </div>
        <div class="error" id="new_password_error"></div>
        <div class="success  text-success" id="updatestatusinfo"></div>
    </div>
    <div class="col-lg-12 mb-3">
        <div class="">
            <label for="teammembersName" class="form-label">Proof of Payment </label>
            <input type="file" class="form-control" id="proof" imaaccept="image/*" name="proof">
            <div class="error-message mt-1" id="proof-error"></div>

        </div>
        <div class="error" id="new_password_error"></div>
        <div class="success  text-success" id="updatestatusinfo"></div>
    </div>

</div>
<div class="d-flex gap-2 justify-content-center mt-4 mb-2">
    <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
    <button type="button" class="btn w-sm btn-success " id="submitStatusForm">Update Status</button>
</div>

<script>
      $('#submitStatusForm').on('click', function(e) {
        e.preventDefault();

        // Create FormData object to handle form data including file uploads
        let formData = new FormData();
        let token = $('meta[name="csrf-token"]').attr('content');
        let status = $('#status').val();
        let payment_mode2 = $('#payment_mode2').val();
        let leadid = $('#leadid').val();
        let proofFile = $('#proof')[0].files[0]; // Get the file input

        // Append form data
        formData.append('_token', token);
        formData.append('status', status);
        formData.append('leadid', leadid);
        formData.append('payment_mode2', payment_mode2);
        if (proofFile) {
            formData.append('proof', proofFile); // Append file if it exists
        }

        // Perform AJAX request
        $.ajax({
            url: "{{ url('admin/withdraw/updatestatus') }}",
            type: 'POST',
            data: formData,
            processData: false, // Important: do not process data
            contentType: false, // Important: set contentType to false for file upload
            success: function(res) {
                if (res.code == 401) {
                    $('.appendView').html(res.message); // Display the error message
                } else if (res.code == 200) {
                    $('#updatestatusinfo').html(res.message); // Show success message
                    setTimeout(() => {
                        window.location.href = window.location.href; // Refresh the page
                    }, 1000);
                } else {
                    alert('Unexpected response code: ' + res.code);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle any AJAX errors
                alert('An error occurred: ' + textStatus + ' - ' + errorThrown);
            }
        });
    });
</script>