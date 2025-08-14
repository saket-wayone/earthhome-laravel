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

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Plan Type</h4>
                    <div class="flex-shrink-0">
                        <a href="{{route('prices.create')}}" class="btn btn-dark  btn-sm">Add new Plan Type </a>

                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                      
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                @if(!empty($prices))
                                    @foreach($prices as $key=>$list)
                                    <tr>
                                        <th>{{++$key}}</th>
                                        <td>{{$list->type ?? ''}}</td>
                                        <td>{{$list->price ?? ''}}</td>
                                      
                                        <td>{{date('Y-M-d' , strtotime($list->created_at ))}}</td>
                                        <td style="align-items: end; text-align:end;">

                                            <div class="d-flex gap-2">
                                               
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete('{{$list->id}}','remove')"><i class="ti ti-trash"></i></button>
                                                </div>
                                                <div class="edit">
                                                    <a href="{{url('admin/prices/edit',$list->id)}}" class="btn btn-sm btn-success edit-item-btn"> <i class="ti ti-pencil"></i>
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

        <script src="{{asset('admin/js/ajax/pricevalidate.js')}}"></script>


    </div>

    @endsection