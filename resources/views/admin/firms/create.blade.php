@extends('admin.layout')
@section('content')
<style>
    table thead {
        background-color: black;
        color: white;
    }
</style>


<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row">

    <div class="row">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Add New Firm</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <form action="{{route('firms.store')}}"  enctype="multipart/form-data" id="companyadmin" method="post">
                                @csrf()
                                <div class="row">
                                    <!--end col-->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Firm Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter Firm Name" id="name">
                                            <div class="error-message" id="name-error"></div>

                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Firm Address</label>
                                            <input type="text" class="form-control" name="address" placeholder="Enter Firm Address" id="address">
                                            <div class="error-message" id="address-error"></div>

                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="gst" class="form-label">GST Number</label>
                                            <input type="text" class="form-control" name="gst" placeholder="Enter GST Number" id="gst">
                                            <div class="error-message" id="gst-error"></div>

                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" name="phone" placeholder="Enter phone number" id="phone">
                                            <div class="error-message" id="phone-error"></div>

                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="logo" class="form-label">Firm Logo</label>
                                            <input type="file" class="form-control" name="logo" accept="image/*" placeholder="Enter Firm Address" id="logo">
                                            <div class="error-message" id="logo-error"></div>

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


<script src="{{asset('admin/js/ajax/pricevalidate.js')}}"></script>


</div>
@endsection