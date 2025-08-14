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
                 
                    <div class="card-body">

                        <div class="live-preview">
                            <form action="{{route('prices.update')}}" id="companyadmin" method="post">
                                @csrf()
                                <div class="row">
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">
                                                Select Type</label>
                                            <select name="type" class="form-control">
                                                <option value="">Select Type</option>
                                              

                                                @if(!empty($plans))
                                                @foreach($plans as $listing)
                                                <option value="{{$listing->name ?? ''}}" @if($prices->type ==$listing->name) {{'selected'}}  @endif()>{{$listing->name ?? ''}}</option>
                                                @endforeach()

                                                @endif()
                                               
                                                
                                            </select>
                                            <div class="error-message" id="type-error"></div>

                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{$prices->id}}">

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="compnayNameinput" class="form-label">Enter Price</label>
                                            <input type="number" value="{{$prices->price ?? ''}}" class="form-control" name="price" placeholder="Enter price" id="compnayNameinput">
                                            <div class="error-message" id="price-error"></div>

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