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
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Doctor </h4>
                <div class="flex-shrink-0">
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-dark  btn-sm">Import Excel </a>
                    <a href="{{url('doctor/add')}}" class="btn btn-dark  btn-sm">Add New </a>

                </div>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="live-preview">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th> Doctor Name</th>
                                    <th>Specialty</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>clinic 1 Address Timings</th>
                                    <th>clinic 2 Address Timings</th>
                                    <th>clinic 3 Address Timings</th>
                                    <th>clinic 4 Address Timings</th>

                                    <th>Created On</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($doctor))
                                @foreach($doctor as $keys=>$list)

                                <tr>
                                    <th>{{++$keys}}</th>
                                    <td>{{$list->doctor_name ?? ''}}</td>
                                    <td>{{$list->specialty ?? ''}}</td>
                                    <td>{{$list->contact_number ?? ''}}</td>
                                    <td>{{$list->email ?? ''}}</td>
                                    <td>{{$list->clinic_1_address_timings ?? ''}}</td>
                                    <td>{{$list->clinic_2_address_timings ?? ''}}</td>
                                    <td>{{$list->clinic_3_address_timings ?? ''}}</td>
                                    <td>{{$list->clinic_4_address_timings ?? ''}}</td>


                                    <td>{{date('d-M-Y' , strtotime($list->created_at ))}}</td>
                                    <!-- <td>

                                            @if($list->can_create_mr ==1)
                                            <img src="{{asset('admin/images/profile.png')}}" style="width:30px">


                                            @endif()
                                            @if($list->can_create_books ==1)
                                            <img src="{{asset('admin/images/book.png')}}" style="width:30px">


                                            @endif()
                                        </td> -->
                                    <td style="align-items: end; text-align:end;">

                                        <div class="d-flex gap-2">

                                            <div class="remove">
                                                <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete('{{$list->id}}','remove')"><i class="ti ti-trash"></i></button>
                                            </div>
                                            <div class="edit">
                                                <a href="{{ url('doctor/edit/' . $list->id) }}" class="btn btn-sm btn-success edit-item-btn"> <i class="ti ti-pencil"></i>
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

    <script src="{{asset('admin/js/ajax/doctor.js')}}"></script>


</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="importexcel">
                    @csrf()

                    <div class="row">
                        <div class="col-lg-12">
                            <div style="float: inline-end;">
                                <a href="{{asset('admin/images/sample excel.xlsx')}}" class="btn btn-primary" download>Download sample Excel</a>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="email" class="form-label">Import Excel</label>
                                <input type="file" class="form-control" name="file" placeholder="DOB" id="file">
                                <span id="file_error" class="text-danger"></span>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" name="submit"class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>




@endsection