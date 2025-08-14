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
                    <h4 class="card-title mb-0 flex-grow-1">Service Aggrment Detail



                    </h4>
                    <div style="
    margin-right: 15px;
">
                        <a href="{{route('serviceaggrement.edit',$service->id)}}" class="btn btn-sm btn-warning edit-item-btn"> <i></i>Edit 
                        </a>

                    </div>
                    
                      <div>
                        <a href="{{route('downloadscore',$service->risk_id)}}" class="btn btn-sm btn-dark edit-item-btn"> <i></i>Download Score
                        </a>

                    </div>
                    <div style="margin-left: 10px;">
                        <a href="{{route('riskassementview',$service->risk_id)}}" class="btn btn-sm btn-success edit-item-btn"> <i></i>View Risk Aggrement
                        </a>
                    </div>

                    <div style="margin-left: 10px;">
                        @if(in_array(Auth::user()->role, ['admin', 'Compliance']))

                        <button type="button" id="deleteaggrement" class="btn btn-sm btn-danger edit-item-btn"> <i></i>Delete Service Aggrement
                        </button>

                        @endif()

                        <input type="hidden" id="servicemainid" value="{{$service->id}}">

                    </div>






                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="col-7">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{$service->clientname ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{$service->email ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Mobile Number</td>
                                        <td>{{$service->mobile ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Pancard</td>
                                        <td>{{$service->pancard ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Joining Date</td>
                                        <td>  {{date('d-m-y ' , strtotime($service->joining_date ))}} </td>
                                    </tr>
                                    <tr>
                                        <td>Package</td>
                                        <td><b>{{$service->package ?? ''}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Package Amount</td>
                                        <td>₹ {{$service->packageamount ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Paid Amount</td>
                                        <td>₹ {{$service->paidamount ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Invest Amount</td>
                                        <td>₹ {{$service->investamount ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Expiry Date</td>
                                        <td><b>{{$service->expirydate ?? ''}}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Days</td>
                                        <td>{{$service->days ?? ''}}</td>
                                    </tr>
                                    <tr>
                                        <td>Month</td>
                                        <td>{{$service->months ?? ''}}</td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>


                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->



    </div>

    @endsection



    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <script src="{{asset('admin/js/ajax/service.js')}}"></script>