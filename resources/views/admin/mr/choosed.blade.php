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
                    <h4 class="card-title mb-0 flex-grow-1">All MR</h4>
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
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($mrlist))
                                    @foreach($mrlist as $key=> $listing)
                                    
                                    <tr>
                                        <th>{{++$key}}</th>
                                        <td>

                                        @php 
                                            $managerallotment =  DB::table('allotmanagers')->join('users','users.id','allotmanagers.manager_id')->where('allotmanagers.mr_id',$listing->id)->first();

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
                                        <td>{{$listing->expiry_date ?? ''}}</td>
                                        
                                        <td>{{$listing->created_at ?? ''}}</td>
                                        <td style="align-items: end; text-align:end;">

                                            <div class="d-flex gap-2">
                                                
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn" >Want to pause</button>
                                                </div>
                                                <!-- <div class="edit">
                                                    <a href="" class="btn btn-sm btn-success edit-item-btn"> <i class="ti ti-pencil"></i>
                                                    </a>
                                                </div> -->

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