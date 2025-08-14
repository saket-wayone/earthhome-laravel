@extends('admin.layout')
@section('content')
<style>
    table thead {
        background-color: black;
        color: white;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 8px;
        margin: 20px 0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .card-header {
        background-color: #f7f7f7;
        border-bottom: 1px solid #ccc;
        padding: 10px;
    }

    .card-title {
        font-size: 24px;
        font-weight: bold;
    }

    .table {
        width: 100%;
        margin: 20px 0;
    }

    .table th, .table td {
        padding: 8px 12px;
        text-align: left;
    }

    .table th {
        background-color: #f1f1f1;
        font-weight: bold;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="row">

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Status</h4>
                    <div class="flex-shrink-0">
                        <a href="{{route('status.create')}}" class="btn btn-dark  btn-sm">Add new Status  </a>

                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Status</th>
                                        <th>Created On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                @if(!empty($status))
                                    @foreach($status as $key=>$list)
                                    <tr>
                                        <th>{{++$key}}</th>
                                        <td>{{$list->status ?? ''}}</td>
                                      
                                        <td>{{date('d-m-y' , strtotime($list->created_at ))}}</td>
                                        <td style="align-items: end; text-align:end;">

                                            <div class="d-flex gap-2">
                                               
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete('{{$list->id}}','remove')"><i class="ti ti-trash"></i></button>
                                                </div>
                                                <div class="edit">
                                                    <a href="{{url('admin/status/edit',$list->id)}}" class="btn btn-sm btn-success edit-item-btn"> <i class="ti ti-pencil"></i>
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

        <script src="{{asset('admin/js/ajax/status.js')}}"></script>


    </div>

    @endsection