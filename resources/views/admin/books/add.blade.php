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
                        <h4 class="card-title mb-0 flex-grow-1">Add New Book</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <form action="{{route('books.addbooks')}}" id="companyadmin" method="post">
                                @csrf()
                                <div class="row">
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstNameinput" class="form-label">
                                              Title  Name</label>
                                            <input type="text" class="form-control" name="title" placeholder="Enter your Book Title" id="firstNameinput">
                                            <div class="error-message" id="title-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="compnayNameinput" class="form-label">Upload Book Cover Image</label>
                                            <input type="file" accept="image/*" class="form-control" name="cover_image" placeholder="Enter company name" id="compnayNameinput">
                                            <div class="error-message" id="cover_image-error"></div>

                                        </div>
                                    </div>
                                    <!--end col-->
                                   
                                    <!--end col-->


                                   
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

<script src="{{asset('admin/js/ajax/bookscreate.js')}}"></script>


</div>
@endsection