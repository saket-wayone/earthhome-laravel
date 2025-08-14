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

            <marquee>

                <div class="alert alert-warning"> If you <b>unpause any MR </b> then you will not get any benifit of license extension!</div>

            </marquee>

            <div class="card">

                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All MRs</h4>

                    <div class="flex-shrink-0">
                        <a href="{{route('mr.create')}}" class="btn btn-dark  btn-sm">Add new MR </a>

                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>Manager Name</th>
                                        <th>License Code</th>
                                        <th>MR Name</th>
                                        <th>Email </th>
                                        <th>Phone</th>
                                        <th>Work Area</th>
                                        <th>Expired Date</th>
                                        <th>Created On</th>
                                        <th style="width: 200px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($mrlist))
                                    @foreach($mrlist as $key=> $listing)

                                    <tr>
                                        <th>{{++$key}}</th>
                                        <td>

                                            @php
                                            $managerallotment = DB::table('allotmanagers')->join('users','users.id','allotmanagers.manager_id')->where('allotmanagers.mr_id',$listing->id)->first();

                                            @endphp
                                            @if(!empty( $managerallotment))
                                            {{ $managerallotment->name  ?? ''}}

                                            @else
                                            Manager Not Assigned Yet
                                            @endif()




                                        </td>
                                        <td>

                                            {{$listing->unique_code ?? ''}}

                                        </td>
                                        <td>{{$listing->name ?? ''}} </td>
                                        <td>{{$listing->email ?? ''}}</td>
                                        <td>{{$listing->phone ?? ''}}</td>
                                        <td>{{$listing->work_area ?? ''}}</td>
                                        <td>{{date('d-m-Y', strtotime($listing->expiry_date)) }}</td>

                                        <td>{{date('d-m-Y' , strtotime($listing->created_at))}}</td>
                                        <td style="align-items: end; text-align:end;">

                                            <div class="d-flex gap-2">

                                                @if($listing->is_paused)
                                                <div class="remove">
                                                    <a href="#" class="btn btn-sm btn-warning remove-item-btn">Paused till </br> {{date('Y-M-d',strtotime($listing->paused_till)) }}</a>
                                                </div>


                                               

                                                <div class="remove">
                                                    <a href="#" onclick="confirmDelete('{{$listing->id}}','unpaused')" class="btn btn-sm btn-info  remove-item-btn">Want to unpause ?</a>
                                                </div>



                                                @else

                                                @if(date('Y-m-d') > date('Y-m-d', strtotime($listing->expiry_date)))
                                                <div class="remove">
                                                    <a href="#" class="btn btn-sm btn-info remove-item-btn">Expired</a>
                                                </div>






                                                @else

                                                <div class="remove">
                                                    <a href="{{route('mr.pause',$listing->id)}}" class="btn btn-sm btn-danger remove-item-btn">Want to pause</a>
                                                </div>
                                                @endif()

                                                @endif
                                                <div class="edit">
                                                    <a href="{{route('mr.edit',$listing->id)}}" class="btn btn-sm btn-success edit-item-btn"> <i class="ti ti-pencil"></i>
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

        <script src="{{asset('admin/js/ajax/usercreate.js')}}"></script>


    </div>

    @endsection