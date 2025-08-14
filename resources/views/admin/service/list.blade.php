@extends('admin.layout')
@section('content')
<style>
    table thead {
        background-color: black;
        color: white;
    }

    .error {
        color: red !important;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="row">

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Risk Assesment</h4>
                    <div class="flex-shrink-0">
                        <a href="" class="btn btn-dark  btn-sm">Add Risk Assesment </a>

                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0" style="
    font-size: 12px;
">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <!-- <th>Company name</th> -->
                                        <th> Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Assese Name</th>
                                        <th>Risk Score</th>
                                        <!-- <th>License Cost</th> -->
                                        <th>Risk Type</th>
                                        <th>Created At</th>
                                        <th>Download</th>
                                        <th>Create Service Aggrement</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($riskmodel))
                                    @foreach($riskmodel as $key=>$list)
                                    <tr>
                                        <th>{{++$key}}</th>
                                        <td>{{$list->name ?? ''}}</td>
                                        <td>{{$list->email ?? ''}}</td>
                                        <td>{{$list->phone ?? ''}}</td>
                                        <td>{{$list->assess_name ?? ''}}</td>
                                        <td>{{$list->totalpoints ?? ''}}</td>
                                        <td>
                                            @if($list->riskfactor =='Low Risk')
                                            @php
                                            $color = 'success';
                                            @endphp
                                            @elseif($list->riskfactor =='Medium Risk')
                                            @php
                                            $color = 'warning';
                                            @endphp
                                            @else
                                            @php
                                            $color = 'danger';
                                            @endphp

                                            @endif()
                                            <span class="text-{{$color}}">{{$list->riskfactor ?? ''}}</span>



                                        </td>
                                        <td>{{$list->created_at ?? ''}}</td>
                                        <td>
                                            <a href="{{route('risk-assement-download',$list->id)}}" class="btn btn-primary btn-sm"> PDF</a>
                                        </td>
                                        <td>
                                            <a href="{{route('serviceagreement.create',$list->id)}}" class="btn btn-primary btn-sm">Create</a>



                                        </td>
                                       
                                        <td style="align-items: end; text-align:end;">

                                            <div class="d-flex gap-2">

                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete('{{$list->id}}','remove')"><i class="ti ti-trash"></i></button>
                                                </div>
                                                <div class="edit">
                                                    <a href="{{url('admin/risk-assement/edit',$list->id)}}" class="btn btn-sm btn-success edit-item-btn"> <i class="ti ti-pencil"></i>
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

        <script src="{{asset('admin/js/ajax/risk.js')}}"></script>


    </div>

    @endsection


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>