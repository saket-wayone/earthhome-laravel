@extends('admin.layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">



<div class="row">

    <div class="row">
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-success">
            {{ session('error') }}
        </div>
        @endif
        <div class="row">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Add  Inner Page</h4>
                            <div class="flex-shrink-0">
                                <a href="{{route('books.notify')}}" class="btn btn-dark  btn-sm">Notify MR for new Book Update</a>
                            </div>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <div class="live-preview">
                                <form action="{{route('page.updateinnerpagestore',$innerpage->id )}}" id="companyadmin" method="post">
                                    @csrf()
                                    <div class="row">
                                        <!--end col-->
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">
                                                    Page Title Name</label>
                                                <input type="text" class="form-control"  name="title" placeholder="Enter your Page Title  Name" id="firstNameinput">
                                                <div class="error-message" id="title-error"></div>

                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="compnayNameinput" class="form-label">Upload Book Cover Image</label>
                                                <input type="file" accept="image/jpeg,image/webp" class="form-control" name="inner_image" placeholder="Enter company name" id="compnayNameinput">
                                                <div class="error-message" id="inner_image-error"></div>


                                               


                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">
                                                    Youtube</label>
                                                <input type="url" class="form-control" name="youtube_link" placeholder="Enter your Youtube Link" id="firstNameinput">

                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="firstNameinput" class="form-label">
                                                    Audio File</label>
                                                <input type="file" accept=".mp3,audio/*" class="form-control" name="audio_link" placeholder="Enter your Audio Link" id="firstNameinput">
                                                <div class="error-message" id="title-error"></div>





                                            </div>
                                            @if ($innerpage->audio_file != '')
                                            <audio controls>
                                                <source src="{{ url($innerpage->audio_file) }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                            @endif
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

<script src="{{asset('admin/js/ajax/bookscreate.js')}}"></script>


</div>
@endsection