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
                        <h4 class="card-title mb-0 flex-grow-1">Add New Manager</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <form action="{{route('manageradd')}}" id="companyadmin" method="post">
                                @csrf()
                                <div class="row">
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">
                                              Manager  Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Manager Name" id="firstNameinput">
                                            <div class="error-message" id="name-error"></div>

                                        </div>
                                    </div>
                                   
                                    <!--end col-->
                                   
                                    <!--end col-->


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phonenumberInput" class="form-label">Phone
                                                Number</label>
                                            <input type="tel" class="form-control onlyNumeric" name="phone" placeholder="Enter mobile number" id="phonenumberInput">
                                            <div class="error-message" id="phone-error"></div>
                                            <input type="hidden" name="role" value="manager">

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
                                    <!--end col-->

                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="ForminputState" class="form-label">Password</label>
                                            <input type="text" class="form-control" name="password" placeholder="Password" id="emailidInput">
                                            <div class="error-message" id="password-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Work Area</label>
                                            <textarea type="text" class="form-control" name="work_area" placeholder="Enter Work Area" id="gst"></textarea>
                                            <div class="error-message" id="work_area-error"></div>

                                        </div>
                                    </div>
                                     <div class="row p-3">
                            <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1 mb-2">Allow Permissions to Manager</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->
                                <div class="card ">
                                     <div class="table-responsive table-card">
                                     <table class="table table-nowrap ">
                        <thead class="table-info">
                            <tr>
                               
                                <th scope="col">1</th>
                                <th scope="col">CREATE MR</th>
                                <th scope="col"> <th scope="col">
                                    <div class="form-check">
                                        <input class="form-check-input p-3" name="can_create_mr" type="checkbox"  value="1" id="cardtableCheck">
                                        <label class="form-check-label" for="cardtableCheck"></label>
                                    </div>
                                </th></th>
                              
                            </tr>
                             <tr>
                               
                                <th scope="col">2</th>
                                <th scope="col">CREATE BOOKS</th>
                                <th scope="col"> <th scope="col">
                                    <div class="form-check">
                                        <input class="form-check-input p-3" name="can_create_book" type="checkbox"  value="1" id="cardtableCheck">
                                        <label class="form-check-label" for="cardtableCheck"></label>
                                    </div>
                                </th></th>
                              
                            </tr>
                        </thead>
                        <tbody>
           
                        </tbody>
                    </table>
                                </div>
                                    
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
<!-- end col -->

<script src="{{asset('admin/js/ajax/manager.js')}}"></script>


</div>
@endsection