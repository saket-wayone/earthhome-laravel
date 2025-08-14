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
                        <h4 class="card-title mb-0 flex-grow-1">Add New Doctor</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <form  id="doctor_update" method="post">
                                @csrf()
                                <div class="row">
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="doctor_name" class="form-label">
                                                Doctor Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="doctor_name" placeholder="Enter Doctor Name" id="doctor_name" value="{{$edit->doctor_name ?? ''}}">
                                            
                                            <span id="doctor_name_error" class="text-danger"></span>

                                        </div>
                                    </div>

                                    <!--end col-->

                                    <!--end col-->


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="specialty" class="form-label">Specialty <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="specialty" placeholder="Enter mobile number" id="specialty" value="{{$edit->doctor_name ?? ''}}">
                                            <span id="specialty_error" class="text-danger"></span>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="contact_number" class="form-label">Contact Number</label>
                                            <input type="number" class="form-control" name="contact_number" placeholder="Contact Number" id="contact_number" value="{{$edit->contact_number ?? ''}}">
                                            <span id="contact_number_error" class="text-danger"></span>

                                        </div>
                                    </div>
                                    <!--end col-->

                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Email" id="email" value="{{$edit->email ?? ''}}">
                                            <span id="email_error" class="text-danger"></span>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="anniversary" class="form-label">Anniversary</label>
                                            <input type="date" class="form-control" name="anniversary" placeholder="anniversary" id="anniversary" value="{{$edit->anniversary ?? ''}}">
                                            <span id="anniversary_error" class="text-danger"></span>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">DOB</label>
                                            <input type="date" class="form-control" name="dob" placeholder="DOB" id="dob" value="{{$edit->dob ?? ''}}">
                                            <span id="dob_error" class="text-danger"></span>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Clinic -1 Address-Timings <span class="text-danger">*</span></label>
                                            <textarea type="text" class="form-control" name="clinic_1_address_timings" placeholder="Clinic -1 Address-Timings" id="clinic_1_address_timings" rows="4" >{{$edit->clinic_1_address_timings ?? ''}}</textarea>
                                            <div class="error-message" id="clinic_1_address_timings_error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Clinic -2 Address-Timings </label>
                                            <textarea type="text" class="form-control" name="clinic_2_address_timings" placeholder="Clinic -2 Address-Timings" rows="4" id="clinic_2_address_timings">{{$edit->clinic_2_address_timings ?? ''}}</textarea>
                                            <div class="error-message" id="clinic_2_address_timings_error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Clinic -3 Address-Timings </label>
                                            <textarea type="text" class="form-control" name="clinic_3_address_timings" placeholder="Clinic -3 Address-Timings" rows="4" id="clinic_3_address_timings">{{$edit->clinic_3_address_timings ?? ''}}</textarea>
                                            <div class="error-message" id="clinic_3_address_timings_error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Clinic -4 Address-Timings </label>
                                            <textarea type="text" class="form-control" name="clinic_4_address_timings" placeholder="Clinic -4 Address-Timings" rows="4" id="clinic_4_address_timings">{{$edit->clinic_4_address_timings ?? ''}}</textarea>
                                            <div class="error-message" id="clinic_4_address_timings_error"></div>

                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" name="id" placeholder="DOB" id="id" value="{{$edit->id ?? ''}}">

                                    <!--end col-->
                                    <div class="col-lg-12 " >
                                        <div class="text-end">

                                            <button type="submit" class="btn btn-dark" >Submit</button>
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




</div>
<script src="{{asset('admin/js/ajax/doctor.js')}}"></script>
@endsection