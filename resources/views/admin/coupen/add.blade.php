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
                        <h4 class="card-title mb-0 flex-grow-1">Add New Coupon</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <form action="{{route('coupen.store')}}" id="companyadmin" method="post">
                                @csrf()
                                <div class="row">
                                    <!--end col-->
                                    
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label for="compnayNameinput" class="form-label">Coupon Code</label>
                                            <input type="text" class="form-control" name="coupen_code" placeholder="Enter Coupen Code" id="compnayNameinput">
                                            <div class="error-message" id="coupen_code-error"></div>

                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                        <label for="compnayNameinput" class="form-label">Discount In percentage %</label>
                                            <input type="number" class="form-control" name="discount" placeholder="Enter Discount In percentage" id="compnayNameinput">
                                            <div class="error-message" id="discount-error"></div>

                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="mb-3">
                                        <label for="valid_upto" class="form-label">Valid Upto</label>
                                            <input type="date" class="form-control"  name="valid_upto" id="valid_upto">
                                            <div class="error-message" id="valid_upto-error"></div>

                                        </div>
                                    </div>
                                     <div class="col-md-3">
                                        <div class="mb-3">
                                        <label for="valid_upto" class="form-label">Number of Usage</label>
                                            <input type="number" class="form-control"  name="usage" placeholder="Number of Usage" id="valid_upto">
                                            <div class="error-message" id="usage-error"></div>

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


<script src="{{asset('admin/js/ajax/coupenvalidation.js')}}"></script>


</div>
@endsection