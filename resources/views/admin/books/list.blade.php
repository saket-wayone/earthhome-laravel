@extends('admin.layout')
@section('content')
<style>
    table thead {
        background-color: black;
        color: white;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Books</h4>
                    <div class="flex-shrink-0">
                        <a href="{{route('books.create')}}" class="btn btn-dark  btn-sm">Add new Book </a>
                        <a href="{{route('books.notify')}}" class="btn btn-dark  btn-sm">Notify MR for new Book Update</a>

                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Book Title</th>
                                        <th>Book Cover Image</th>
                                        <th>View Pages</th>
                                        <th>Add New Page</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($books))
                                    @foreach($books as $key=> $listing)

                                    <tr>
                                        <th>{{ ++$key}}</th>
                                        <td>{{ $listing->title ?? ''}}</td>
                                        <td>
                                            <a href="{{url( $listing->cover_image)}}" target="__blank">
                                            <img src="{{url( $listing->cover_image)}}" style="width: 100px; height:120px">

                                            </a>
                                        
                                        
                                        </td>
                                        <td><a href="{{route('books.page.all',$listing->id)}}" class="btn btn-primary btn-sm">View</a></td>
                                        <td><a href="{{route('books.page.create' ,$listing->id)}}" class="btn btn-success btn-sm">Add</a></td>

                                        <td>{{date('d-m-Y', strtotime($listing->created_at))}}</td>
                                        <td style="align-items: end; text-align:end;">

                                            <div class="d-flex gap-2">

                                                <div class="remove">
                                                    <button  onclick="confirmDelete('{{$listing->id}}','remove')" class="btn btn-sm btn-danger remove-item-btn"><i class="ti ti-trash"></i></button>
                                                </div>
                                                <div class="edit">
                                                    <a href="{{route('book.edit',$listing->id)}}" class="btn btn-sm btn-success edit-item-btn"> <i class="ti ti-pencil"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </td>

                                    </tr>


                                    @endforeach()
                                    @endif()


                                </tbody>
                            </table>
                        </div>
                    </div>


                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->

        <script src="{{asset('admin/js/ajax/bookscreate.js')}}"></script>


    </div>

    @endsection