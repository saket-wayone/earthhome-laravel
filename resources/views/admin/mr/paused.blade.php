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
                        <h4 class="card-title mb-0 flex-grow-1">Pause MR  {{$mrinfo->name ?? ''}}</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <form action="{{route('pausedmr')}}" id="companyadmin" method="post">
                                @csrf()
                                <div class="row">
                                    <!--end col-->
                                 
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="compnayNameinput" class="form-label">
                                           Number Of Days in which you want to paused MR ? </label>
                                            <input type="number" class="form-control" name="days" placeholder="Enter Number Of Days" id="nameinput">
                                            <div class="error-message" id="days-error"></div>

                                        </div>
                                    </div>
                                    <!--end col-->
                                   
                                    <!--end col-->


                                  
                                    <input type="hidden"  value="{{$mrinfo->id}}" name="mr_id">
                                 
                                    
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="text-start">
                                        <div class="text-success" id="success"></div>
                                        <div class="text-danger" id="password-error"></div>

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

<script src="{{asset('admin/js/ajax/usercreate.js')}}"></script>


</div>
@endsection