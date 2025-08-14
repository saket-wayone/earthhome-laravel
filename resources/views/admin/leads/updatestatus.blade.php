<input type="hidden" class="form-control" name="rowid" id="leadid" value="{{ $lead->id }}">

<div class="row">
    <div class="col-lg-12 mb-3">
        <div class="">
            <label for="teammembersName" class="form-label">Update Status </label>
            <select class="form-control" name="status" id="status" style="width: 100%">
                <option value="">Select Status</option>

                @if(!empty($status))
                @foreach($status as $list)
                <option value="{{$list->status}}" @if ($list->status ==$lead->status)
                    {{'selected'}}
                    @endif>{{$list->status}}
                </option>
                @endforeach()
                @endif()
            </select>
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
        let token = $('meta[name="csrf-token"]').attr('content');
        let status =  $('#status').val();
        let leadid =  $('#leadid').val();
        $.ajax({
                url: "{{ url('admin/leads/updatestatus')}}" ,
                type: 'POST',
                data : {_token : token ,status : status,leadid :  leadid },
                success: function(res) {
                    if (res.code == 401) {
                $('.appendView').html(res.message);  // Display the error message
            } else if (res.code == 200) {
                $('#updatestatusinfo').html(res.message);  // Append the HTML returned from the server
                setTimeout(()=>{
                    window.location.href= window.location.href;

                },1000)
            } else {
                alert('Unexpected response code: ' + res.code);
            }
                },
            })
        
        
    });
</script>