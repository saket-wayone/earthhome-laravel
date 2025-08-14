@extends('admin.layout')
@section('content')
<style>
    table thead {
        background-color: black;
        color: white;
    }
    input {
    width: 75% !important;
}
select {
    width: 75% !important;
}
textarea {
    width: 75% !important;
}
</style>


<div class="row">

    <div class="row">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Add New User</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <form action="{{route('useradd')}}" id="companyadmin" method="post">
                                @csrf()
                                <div class="row">
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">
                                             Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter  Name" id="firstNameinput">
                                            <div class="error-message" id="name-error"></div>

                                        </div>
                                    </div>
                                   
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phonenumberInput" class="form-label">Select Role
                                                </label>
                                                <select name="role"  class="form-control">
                                                <option value="">Select Role</option>

                                            
                                                        <option value="user">User</option>
                                                        <option value="agent">Agent</option>
                                                        

                                                

                                                </select>




                                            <div class="error-message" id="role-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phonenumberInput" class="form-label">Phone
                                                Number</label>

                                               
                                            <input type="tel" class="form-control onlyNumeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="phone" placeholder="Enter mobile number" id="phonenumberInput">
                                            <div class="error-message" id="phone-error"></div>

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Email
                                                Address</label>
                                            <input type="email" class="form-control" name="email" placeholder="example@gmail.com" id="emailidInput">
                                            <div class="error-message" id="email-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="ForminputState" class="form-label">Create Password</label>
                                            <input type="text" class="form-control" name="password" placeholder="Password" id="emailidInput">
                                            <div class="error-message" id="password-error"></div>

                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="ForminputState" class="form-label">Joining Date</label>
                                            <input type="date" class="form-control" name="joining_date"  id="emailidInput">
                                            <div class="error-message" id="joining_date-error"></div>

                                        </div>
                                    </div> -->
                                    <!-- <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="ForminputState" class="form-label">DOB</label>
                                            <input type="date" class="form-control" name="dob"  id="emailidInput">
                                            <div class="error-message" id="dob-error"></div>

                                        </div>
                                    </div> -->
                                    
                                  
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Address
                                                </label>
                                            <textarea type="text" class="form-control" name="registered_office" placeholder="Enter Address" id="registered_office"></textarea>
                                            <div class="error-message" id="registered_office-error"></div>

                                        </div>
                                    </div>
                                   
                                   
                                    <!--end col-->
                                   
                                    <!--end col-->


                                   
                                    <!--end col-->

                                    <!--end col-->
                                  

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <!-- <label for="ForminputState" class="form-label">License Cost</label> -->
                                            <input type="hidden" class="form-control" name="license_cost" value="0" placeholder="Enter License Cost" id="emailidInput">
                                            <div class="error-message" id="license_cost-error"></div>

                                        </div>
                                    </div>
                                    
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                        <div class="text-success" id="success"></div>

                                            <button type="submit" class="btn btn-dark w-25" id="changetext">Submit</button>
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
<!-- end col -->

<script src="{{asset('admin/js/ajax/usercreate.js')}}"></script>


</div>
@endsection