@extends('admin.layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    table thead {
        background-color: black;
        color: white;
    }

    .progress-container {
        width: 100%;
        height: 20px;
        background-color: #f0f0f0;
        margin-bottom: 10px;
    }

    .progress-bar {
        height: 100%;
        background-color: #4caf50;
        width: 0%;
    }

    .message {
        margin-top: 10px;
    }
</style>


<div class="row">

    <div class="row">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Add New Page</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">

                            <div>
                                <h1 class="progress-bar"></h1>
                                <h1 class="message"></h1>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 click-to-upload">
                                    <div class="card text-center">
                                        <div class="card-body click-to-upload">
                                            <p class="text-muted">Please Upload the pages</p>

                                            <div class="dropzone dz-clickable" >
                                                <div class="dz-message needsclick" style="cursor: pointer;">
                                                    <div class="mb-3">
                                                        <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                    </div>
                                                    <label for="fileInput" class="click-to-upload">click to upload.</label>
                                                    <input type="file" accept="image/jpeg, image/webp ,image/jpg" id="fileInput" style="display: none;" multiple>
                                                </div>
                                            </div>

                                            <ul class="list-unstyled mb-0" id="dropzone-preview"></ul>
                                            <!-- end dropzon-preview -->
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                    <!-- end card -->
                                </div> <!-- end col -->
                            </div>












                            <form action="{{route('useradd')}}" id="companyadmin" method="post" enctype="multipart/form-data">
                                @csrf()
                                <input type="hidden" name="book_id" id="book_id" value="{{$book_id}}">
                                <div class="row">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Sno</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Page Title Name</th>
                                                <th scope="col">Youtube</th>
                                                <th scope="col">Audio File</th>
                                                <th scope="col">Adjust Sequence</th>
                                            </tr>
                                        </thead>
                                        <tbody id="uploadedimageshere">


                                        </tbody>

                                    </table>














                                    <!--end col-->


                                    <!--end col-->

                                    <!--end col-->



                                    <!--end col-->

                                    <!--end col-->
                                </div>
                                <div class="text-center">
                                                                                                       <input type="submit" value="submit" class="btn btn-primary" id="submitBtn">
 
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


<script src="{{asset('admin/js/ajax/bookpages.js')}}"></script>


</div>
@endsection