@extends('admin.layout')
@section('content')
<style>
    .badge {
        margin-left: 10px;
        /* Spacing for badge */
    }

    .removeBtn {
        margin-left: 10px;
        /* Space between badge and button */
    }

    .list-group-item {
        display: flex;
        /* Flex for alignment */
        justify-content: space-between;
        /* Space between elements */
        align-items: center;
        /* Center vertically */
        padding: 15px;
        /* Increased padding for better click area */
    }

    .list-group-item:hover {
        background-color: #f8f9fa;
        /* Hover effect */
    }

    .btn-primary {
        background-color: #007bff;
        /* Bootstrap primary color */
        border: none;
        /* Remove border */
    }

    .btn-primary:hover {
        background-color: #0056b3;
        /* Darker blue on hover */
    }

    input {
        width: 75% !important;
    }

    .totals {
        margin-top: 20px;
        /* Spacing for totals */
        font-size: 13px !important;
        text-align: end;
        /* Increased font size for visibility */
        color: #333;
    }

    .totals span {
        font-weight: bold;
        /* Bold for emphasis */
    }
</style>


<div class="row">

    <div class="row">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Create Invoice</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <form action="{{route('invoices.store')}}" id="invoice" method="post">
                                @csrf()
                                <div class="row">

                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="coinput" class="form-label">
                                                C/O Name</label>
                                            <input type="text" class="form-control" name="co" placeholder="Mr. Bhavesh Kapoor" id="coinput">
                                            <div class="error-message" id="co-error"></div>

                                        </div>
                                    </div>

                                    <!--end col-->

                                    <!--end col-->


                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="companyName" class="form-label">Client Company Name if any ?
                                            </label>
                                            <input type="text" class="form-control" name="company" placeholder="Enter Client Company Name" id="companyName">
                                            <div class="error-message" id="company-error"></div>

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="gst" class="form-label">Client
                                                GST</label>
                                            <input type="text" class="form-control" name="gst" placeholder="Client GST" id="gst">
                                            <div class="error-message" id="gst-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="emailidInput" class="form-label">Client Address</label>
                                            <textarea type="text" class="form-control" name="address" placeholder="Client Address" id="address"></textarea>
                                            <div class="error-message" id="address-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="gst" class="form-label">Invoice Date</label>
                                            <input type="date" value="{{date('Y-m-d')}}" class="form-control" name="invoice_date"  id="gst">
                                            <div class="error-message" id="invoice_date-error"></div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="gst" class="form-label">Invoice Due Date</label>
                                            <input type="date" class="form-control" name="invoice_due"  id="gst">
                                            <div class="error-message" id="invoice_due-error"></div>

                                        </div>
                                    </div>









                                    <div class="container mt-5">
                                        <div class="col-md-12 mt-2">
                                            <h1 class="text-uppercase text-center"> Services</h1>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <input type="text" id="serviceDescription" style="width: 100% !important;" class="form-control" placeholder="Explain service">
                                                </div>
                                                <div class="col-md-1" style="margin: auto 0px; width:10px">₹</div>
                                                <div class="col-md-2">
                                                    <input type="number" id="serviceAmount" style="width: 100% !important;" class="form-control" placeholder="Enter Amount">
                                                </div>
                                            </div>
                                            <button id="addServiceBtn" type="button" class="btn btn-primary mt-3">Add</button>
                                        </div>

                                        <div class="col-md-12 mt-4">
                                            <h2>Added Services</h2>
                                            <ul id="serviceList" class="list-group">
                                                <!-- Added services will appear here -->
                                            </ul>
                                            <div class="totals ">
                                                <h4>Subtotal: <span id="subtotal">₹0</span></h4>
                                                <h4>IGST (18%): <span id="igst">₹0</span></h4>
                                                <h4>Total Cost: <span id="totalCost">₹0</span></h4>
                                            </div>
                                        </div>
                                    </div>







                                    <!--end col-->
                                    <div class="col-lg-12 mt-5">
                                        <div style="text-align: center;">
                                            <div class="text-success" id="success"></div>

                                            <button type="submit" style="width: 20%;" class="btn btn-dark" id="changetext">Submit</button>
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
<!-- end col -->
<script src="{{asset('admin/js/ajax/invoice.js')}}"></script>

</div>
@endsection