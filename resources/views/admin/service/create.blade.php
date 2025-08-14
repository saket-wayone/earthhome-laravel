@extends('admin.layout')
@section('content')
<style>
    table thead {
        background-color: black;
        color: white;
    }

    input {
    width: 75% !important;
}
select {
    width: 75% !important;
}
textarea {
    width: 75% !important;
}

    .form-bottom {
        border: 2.2px solid black;
        padding: 20px;
        margin-bottom: 10px;
    }

    label {
        color: black;
    }

    input[type="radio"] {
        width: 20px;
        height: 20px;
        margin-right: 10px;
        /* Add some spacing between the radio button and the text */
    }

    .control-label {
        font-size: 16px;
    }

    .form-group {
        margin-top: 10px;
    }

   
    .custom-radio .custom-control-label {
        padding-left: 2rem;
        line-height: 1.5rem;
    }
    label{
        margin :10px 0px;
    
        }

    .custom-control-label::before,
    .custom-control-label::after {
        top: 0.25rem;
        width: 1.5rem;
        height: 1.5rem;
    }

    .showquestion {
        display: none;
    }
</style>


<div class="row">

    <div class="row">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">SERVICE AGREEMENT
                        </h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <div class="container">
                                <form class="service-agreement-form" action="{{route('serviceagreement.store')}}" method="post" id="companyadmin">

                                @csrf()
                                <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="date-of-joining">Date Of Joining</label>
                                                <input type="date" class="form-control" name="joining_date">
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="package-name">Package Name</label>
                                                <select class="form-control" class="form-control" name="package">
                                                    <option value="">Select</option>
                                                    <option value="MOMEMTUM IN EQUITY">MOMEMTUM IN EQUITY</option>
                                                    <option value="CUSTOMISED EQUITY & DERIVATIVES">CUSTOMISED EQUITY & DERIVATIVES</option>
                                                    <option value="HEDGING & OPTION STRATEGIES">HEDGING & OPTION STRATEGIES</option>
                                                    <option value="MOMEMTUM IN INDEX & STOCK OPTIONS">MOMEMTUM IN INDEX & STOCK OPTIONS</option>
                                                    <option value="MEDIUM TO LONG TERM EQUITY">MEDIUM TO LONG TERM EQUITY</option>
                                                    <option value="MOMENTUM IN COMMODITY & CURRENCY">MOMENTUM IN COMMODITY & CURRENCY</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="client-type">Client Type</label>
                                                <select class="form-control" class="form-control" name="client_type" >
                                                    <option value="">Select</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Premium">Premium</option>
                                                    <option value="Premium Plus">Premium Plus</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">


                                            <div class="form-group">
                                                <label for="tenure-in-days" class="text-danger">Tenure in Days</label>
                                                <select class="form-control" id="tenure-in-days" class="form-control" name="days">
                                                    <option value="">Select Tenure</option>
                                                    @for($i=1; $i<=100;$i++) <option value="{{$i}}">{{$i}}</option>

                                                        @endfor


                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">


                                            <div class="form-group">
                                                <label for="tenure-in-months" class="text-danger">Tenure in Months</label>
                                                <select class="form-control" id="tenure-in-months" class="form-control" name="months">
                                                    <option value="">Select Tenure</option>
                                                    @for($i=1; $i<=12;$i++) <option value="{{$i}}">{{$i}}</option>

                                                        @endfor


                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">


                                            <div class="form-group">
                                                <label for="client-name">Client Name</label>
                                                <input type="text" class="form-control" value="{{$getdata->name ?? ''}}" readonly name="clientname">
                                            </div>
                                        </div>
                                        
                                        
                                         
                                         <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Gender
                                            </label>
                                            <select class="form-control" name="gender">
                                                <option name="">Select Gender</option>
                                                <option name="Male">Male</option>
                                                <option name="Female">Female</option>
                                                <option name="Other">Other</option>
                                            </select>
                                            <div class="error-message" id="gender-error"></div>

                                        </div>
                                    </div>
                                        
                                         

                                
                                        
                                        <div class="col-md-6">

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" value="{{$getdata->email ?? ''}}" readonly id="email" name="email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">


                                            <div class="form-group">
                                                <label for="pan-card">Pan Card</label>
                                                <input type="text" class="form-control" id="pan-card" name="pancard">
                                            </div>
                                        </div>
                                        <div class="col-md-6">


                                            <div class="form-group">
                                                <label for="mobile">Mobile</label>
                                                <input type="tel" class="form-control" value="{{$getdata->phone ?? ''}}" readonly name="mobile">
                                            </div>
                                        </div>
                                        <div class="col-md-6">


                                            <div class="form-group">
                                                <label for="invest-amount">Invest Amount</label>
                                                <input type="number" class="form-control" id="invest-amount" name="investamount" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">


                                            <div class="form-group">
                                                <label for="expiry-date">Expiry Date</label>
                                                <input type="date" id="expiry-date" class="form-control" name="expirydate">
                                            </div>
                                        </div>
                                        <div class="col-md-6">


                                            <div class="form-group">
                                                <label for="client-place">Client Place</label>
                                                <input type="text" class="form-control" name="clientplace">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="booking-profit-amount">Booking Profit Amount</label>
                                                <input type="number" class="form-control" id="booking-profit-amount" name="bookingprofitamount">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="package-amount">Package Amount</label>
                                                <input type="number" class="form-control" id="package-amount" name="packageamount">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="discount-amount">Discount Amount</label>
                                                <input type="number" class="form-control" id="discount-amount" name="discountamount">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="discount-percentage">Discount Percentage</label>
                                                <input type="number" class="form-control" id="discount-percentage" readonly name="discountpercentage">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="paid-amount">Paid Amount</label>
                                                <input type="number" class="form-control" id="paid-amount" name="paidamount">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="balance-amount">Balance Amount</label>
                                                <input type="number" class="form-control" id="balance-amount" name="balanceamount">
                                            </div>
                                        </div>
                                        <input type="hidden" name="risk_id" value="{{$getdata->id}}">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="risk-score">Risk Score</label>
                                                <input type="number" value="{{$getdata->totalpoints ?? ''}}" class="form-control" readonly id="risk-score" name="riskscore">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-success" id="success"></div>
                                    <div style="display: flex;justify-content:center;">

                                    <button type="submit"  id="changetext" style="width: 20%;" class="btn mt-3   btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->


            </div>
        </div>
    </div> <!-- end col -->
</div>       
 <script src="{{asset('admin/js/ajax/service.js')}}"></script>

<!-- end col -->


</div>
@endsection