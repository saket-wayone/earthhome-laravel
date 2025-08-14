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
                        <h4 class="card-title mb-0 flex-grow-1">Edit Staus</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <form action="{{route('firms.newupdate')}}" id="companyadminedit" method="post">
                                @csrf()
                                <div class="row">
                                    <!--end col-->

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="compnayNameinput" class="form-label">Firm Name</label>
                                            <input type="text" class="form-control" value="{{$firms->name ?? ''}}" name="name" placeholder="Enter Firm Name" id="compnayNameinput">
                                            <div class="error-message" id="name-error"></div>

                                        </div>
                                    </div>

                                    <input type="hidden" name="id" value="{{$firms->id}}">


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Firm address</label>
                                            <input type="text" class="form-control" value="{{$firms->address ?? ''}}" name="address" placeholder="Enter address" id="address">
                                            <div class="error-message" id="address-error"></div>

                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="gst" class="form-label">GST Number</label>
                                            <input type="text" class="form-control" name="gst" value="{{$firms->gst ?? ''}}" placeholder="Enter GST Number" id="gst">
                                            <div class="error-message" id="gst-error"></div>

                                        </div>
                                    </div>
                                      <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="text" class="form-control" name="phone" value="{{$firms->phone ?? ''}}" placeholder="Enter phone number" id="phone">
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
                                    @if(!empty($firms->logo))
                                    <a href="{{asset($firms->logo)}}" target="__blank">
                                            <img src="{{asset($firms->logo)}}" width="100" height="100">
                                        
                                    </a>
                                    
                                    @endif()








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


<script src="{{asset('admin/js/ajax/firms.js')}}"></script>


</div>
@endsection