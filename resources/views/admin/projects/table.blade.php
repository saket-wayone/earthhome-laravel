<form id="companyadmin" action="{{route('project.payment.update')}}" enctype="multipart/form-data" method="post">
    @csrf()
    <!-- Project Settlement Section -->
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="totalSettlement" class="form-label">Select Project Phase</label>
            <select class="form-control" name="phase_id" onchange="getbalanceamount(this.value)">
                <option value="">Select Project Phase</option>
                @if(!empty($phases))
                @foreach($phases as $key=> $listing)
                <option value="{{$listing->id ?? ''}}">{{$listing->phase_name ?? ''}}</option>
                @endforeach()
                @endif()
            </select>
        </div>


        <div class="mb-3 col-md-6" id="balanceamountdiv" style="display: none;">

            <h3>Remaining Balance : <b id="balanceamount"></b></h3>

            <label for="totalSettlement" class="form-label">Amount to be Received</label>
            <input type="number" class="form-control" id="paidamount2" name="paidamount" >
            <input type="number" class="form-control" id="lastamount" name="lastamount" style="display: none;">
            <input type="text" class="form-control" id="lead_id2" name="lead_id2" style="display: none;">

            <div class="mt-3 ">
                <label for="quotation" class="form-label">Upload Payment Receipt </label>
                <input type="file" class="form-control"accept="images/*"   name="recepit" required >
            </div>

            

        </div>
       
        <h3> <b ><span id="overallprojectCost"></span></b></h3>

        <div class="tabledata"></div>





        <!-- Modal Footer with Submit Button -->
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-dark pbuton"  id="submitform2"><i class="bi bi-check-circle custom-icon"></i>Submit </button>
        </div>
    </div>

</form>


<script src="{{asset('admin/js/ajax/functions.js')}}"></script>
<script src="{{asset('admin/js/ajax/leads.js')}}"></script>