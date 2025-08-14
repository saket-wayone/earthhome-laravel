@extends('admin.layout')
@section('content')
<style>
    table thead {
        background-color: black;
        color: white;
    }
</style>
<script>
    window.onload = function() {

        advanceDoneBy("{{$lead->advanceby}}")

    }
</script>
<form action="{{route('leads.update')}}" id="companyadminedit" method="post">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-xxl-12 col-xl-10 col-lg-12">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Edit Job</h4>
                            <span class="invoice-number text-muted">Invoice #

                                <input type="text" class="form-control" id="invoicenumber" value="{{$lead->invoicenumber ?? ''}}" name="invoicenumber" placeholder="Invoice Number">
                                <input type="hidden" class="form-control" id="user_id" value="{{$lead->id ?? ''}}" name="user_id" placeholder="Invoice Number">

                                <div class="error-message mt-1" id="invoicenumber-error"></div>




                            </span>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @csrf
                        <div class="row g-4">

                            <!-- Firm & Transporter Selection -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="firm" class="form-select">
                                        <option value="">Select Firm</option>
                                        @if(!empty($firms))
                                        @foreach($firms as $list)
                                        <option value="{{$list->id}}" @if ($lead->firm ==$list->id)
                                            {{'selected'}}
                                            @endif>{{$list->name}}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <label for="source">Select Firm</label>
                                    <div class="error-message mt-1" id="firm-error"></div>
                                </div>
                            </div>
                            <input type="hidden" name="lead_id" value="{{$lead->id}}">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="transporter" class="form-select">
                                        <option value="">Select Transporter</option>
                                        @if(!empty($users))
                                        @foreach($users as $list)
                                        <option value="{{$list->id}}" @if ($lead->transporter ==$list->id)
                                            {{'selected'}}
                                            @endif >{{$list->name}}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <label for="user">Select Transporter</label>
                                    <div class="error-message mt-1" id="transporter-error"></div>
                                </div>
                            </div>

                            <!-- Driver Information -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" value="{{$lead->name ?? ''}}" id="driverName" name="name" placeholder="Driver Name">
                                    <label for="driverName">Driver Name</label>
                                    <div class="error-message mt-1" id="name-error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control onlyNumeric" value="{{$lead->phone ?? ''}}" id="driverPhone" name="phone" placeholder="Phone Number" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                    <label for="driverPhone">Driver Phone Number</label>
                                    <div class="error-message mt-1" id="phone-error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="purchasedfrom" value="{{$lead->purchasedfrom ?? ''}}" name="purchasedfrom" placeholder="Purchased From">
                                    <label for="purchasedfrom">Purchased From</label>
                                    <div class="error-message mt-1" id="purchasedfrom-error"></div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="truck_no" value="{{$lead->truck_no ?? ''}}" name="truck_no" placeholder="Truck No.f">
                                    <label for="truck">Truck No. </label>
                                    <div class="error-message mt-1" id="truck_no-error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select name="status" class="form-select">
                                        <option value="">Select Status</option>
                                        @if(!empty($status))
                                        @foreach($status as $list)
                                        <option value="{{$list->status}}" @if ($list->status ==$lead->status) {{'selected'}} @endif>{{$list->status}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <label for="status">Job Status</label>
                                    <div class="error-message mt-1" id="status-error"></div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" class="form-control" step="any" value="{{$lead->quantity ?? ''}}" id="quantity" name="quantity" placeholder="Quantity">
                                    <label for="quantity">Quantity</label>
                                    <div class="error-message mt-1" id="quantity-error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" class="form-control" step="any" value="{{$lead->rate ?? ''}}" id="rate" name="rate" placeholder="Rate">
                                    <label for="rate">Rate</label>
                                    <div class="error-message mt-1" id="rate-error"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" class="form-control" step="any" id="total" value="{{$lead->total ?? ''}}" name="total" placeholder="Total Amount">
                                    <label for="total">Total Amount</label>
                                    <div class="error-message mt-1" id="total-error"></div>
                                </div>
                            </div>
                            <!-- Job & Payment Status -->

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="payment_status" class="form-select">
                                        <option value="">Select Payment Status</option>
                                        <option value="Pending" @if ($lead->payment_status =='Pending') {{'selected'}} @endif>Pending</option>
                                        <option value="Completed" @if ($lead->payment_status =='Completed') {{'selected'}} @endif>Completed</option>
                                    </select>
                                    <label for="payment_status">Payment Status</label>
                                    <div class="error-message mt-1" id="payment-status-error"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" value="{{$lead->invoice_date ?? ''}}" class="form-control" id="invoice_date" name="invoice_date" placeholder="Advance">

                                    <label for="payment_status">Invoice Date</label>
                                    <div class="error-message mt-1" id="payment-status-error"></div>
                                </div>
                            </div>
                            <hr>
                            <!-- Job Details Section -->


                            <!-- Financial Section -->
                            <div class="container">
                                <table class="table table-bordered">
                                    <tbody>
                                        <!-- Advance -->
                                        <tr>
                                            <td><label for="advance">Advance</label></td>
                                            <td>
                                                <input type="number" step="any" class="form-control" value="{{$lead->advance}}" id="advance" name="advance" placeholder="Advance">
                                                <div class="error-message mt-1" id="advance-error"></div>
                                            </td>
                                        </tr>

                                        <!-- Advance Done By -->
                                        <tr>
                                            <td><label for="advancebyid">Advance Done By</label></td>
                                            <td>
                                                <select name="advanceby" onchange="advanceDoneBy(this.value)" id="advancebyid" class="form-select">
                                                    <option value="">Advance Done By</option>
                                                    <option value="Self" @if ($lead->advanceby == 'Self')
                                                        {{'selected'}}

                                                        @endif>Self
                                                    </option>
                                                    <option value="Other Party" @if ($lead->advanceby == 'Other Party')
                                                        {{'selected'}}

                                                        @endif>Other Party
                                                    </option>
                                                </select>
                                                <div class="error-message mt-1" id="advanceby-error"></div>
                                            </td>
                                        </tr>

                                        <!-- Party Name (Conditional) -->
                                        <tr id="partydiv" style="display: none;">
                                            <td><label for="advancebyname">Party Name</label></td>
                                            <td>
                                                <input type="text" value="{{$lead->advancebyname ?? ''}}" class="form-control" id="advancebyname" name="advancebyname" placeholder="Party Name">
                                                <div class="error-message mt-1" id="advancebyname-error"></div>
                                            </td>
                                        </tr>

                                        <!-- TDS Percentage -->
                                        <tr>
                                            <td><label for="tds">TDS (%)</label></td>
                                            <td>
                                                <input type="number" step="any" class="form-control" id="tds" value="{{$lead->tds}}" name="tds" placeholder="TDS Percentage">
                                                <div class="error-message mt-1" id="tds-error"></div>
                                            </td>
                                        </tr>

                                        <!-- Transporter Commission -->
                                        <tr>
                                            <td><label for="commission">Transporter Commission</label></td>
                                            <td>
                                                <input type="number" step="any" class="form-control" value="{{$lead->commission}}" id="commission" name="commission" placeholder="Transporter Commission">
                                                <div class="error-message mt-1" id="commission-error"></div>
                                            </td>
                                        </tr>

                                        <!-- Amount to be Added to Wallet -->
                                        <tr>
                                            <td><label for="amounttobeadd">Amount to be Add in Wallet?</label></td>
                                            <td>
                                                <select name="amounttobeadd" class="form-select">
                                                    <option value="">Amount to be add in wallet?</option>
                                                    <option value="Yes" @if ($lead->amounttobeadd == 'Yes')
                                                        {{'selected'}}

                                                        @endif>Yes
                                                    </option>
                                                    <option value="No" @if ($lead->amounttobeadd == 'No')
                                                        {{'selected'}}

                                                        @endif>No
                                                    </option>
                                                </select>
                                                <div class="error-message mt-1" id="amounttobeadd-error"></div>
                                            </td>
                                        </tr>

                                        <!-- Hold Amount -->
                                        <tr>
                                            <td><label for="holdAmount">Hold Amount</label></td>
                                            <td>
                                                <input type="number" step="any" class="form-control" id="holdAmount" value="{{$lead->hold_amount}}" name="hold_amount" placeholder="Hold Amount">
                                                <div class="error-message mt-1" id="hold-error"></div>
                                            </td>
                                        </tr>

                                        <!-- Mandi Kagaj -->
                                        <tr>
                                            <td><label for="mandiKagaj">Mandi Kagaj</label></td>
                                            <td>
                                                <input type="number"  step="any" class="form-control" id="mandiKagaj" value="{{$lead->mandi_kagaj}}" name="mandi_kagaj" placeholder="Mandi Kagaj">
                                                <div class="error-message mt-1" id="mandi-kagaj-error"></div>
                                            </td>
                                        </tr>

                                        <!-- Dharamkanta -->
                                        <tr>
                                            <td><label for="Dharamkanta">Dharamkanta</label></td>
                                            <td>
                                                <input type="number" step="any" class="form-control" id="Dharamkanta" value="{{$lead->dharamkanta}}" name="dharamkanta" placeholder="Dharamkanta">
                                                <div class="error-message mt-1" id="dharamkanta-error"></div>
                                            </td>
                                        </tr>

                                        <!-- Labour Charge -->
                                        <tr>
                                            <td><label for="hammali">Labour Charge</label></td>
                                            <td>
                                                <input type="number" step="any" class="form-control" value="{{$lead->hammali}}" id="hammali" name="hammali" placeholder="Hammali Charges">
                                                <div class="error-message mt-1" id="hammali-error"></div>
                                            </td>
                                        </tr>

                                        <!-- Miscellaneous Expense -->
                                        <tr>
                                            <td><label for="miscellaneous">Miscellaneous Expense?</label></td>
                                            <td>
                                                <input type="text" class="form-control" value="{{$lead->miscellaneous}}" id="miscellaneous" name="miscellaneous" placeholder="Miscellaneous">
                                                <div class="error-message mt-1" id="miscellaneous-error"></div>
                                            </td>
                                        </tr>

                                        <!-- Miscellaneous Expense Amount -->
                                        <tr>
                                            <td><label for="miscellaneousexpense">Miscellaneous Amount</label></td>
                                            <td>
                                                <input type="number" step="any" class="form-control" value="{{$lead->miscellaneousexpense}}" id="miscellaneousexpense" name="miscellaneousexpense" placeholder="Miscellaneous Amount">
                                                <div class="error-message mt-1" id="miscellaneousexpense-error"></div>
                                            </td>
                                        </tr>

                                        <!-- Remaining Amount -->
                                        <tr>
                                            <td><label for="remaining">Remaining Amount</label></td>
                                            <td>
                                                <input type="number" step="any" class="form-control" id="remaining" value="{{$lead->remaining}}" name="remaining" placeholder="Remaining Amount">
                                                <div class="error-message mt-1" id="remaining-error"></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>



                            <!-- Submission Button -->
                            <div class="col-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-dark btn-lg  px-4" id="changetext">Submit Job</button>&nbsp;
                                <a href="{{route('leads.invoice',$lead->id)}}"  class="btn btn-dark btn-lg  px-4">Print</a>
                            </div>
                        </div>
</form>
</div>
</div>
</div>
</div>
</div>

<!-- end col -->

<script src="{{asset('admin/js/ajax/leads.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const followUpInput = document.getElementById('followUpInput');
        const today = new Date().toISOString().split('T')[0]; // Get today's date in 'YYYY-MM-DD' format
        followUpInput.setAttribute('min', today);
    });
    const elementRate = document.getElementById('rate');
    const elementQty = document.getElementById('quantity');
    const elementTDSAmount = document.getElementById('tds');
    const elementTotalAmount = document.getElementById('total');
    const elementAdvanceAmount = document.getElementById('advance');
    const elementHammaliAmount = document.getElementById('hammali');
    const elementCommissionAmount = document.getElementById('commission');
    const elementHoldAmountAmount = document.getElementById('holdAmount');
    const elementMandiKagajAmount = document.getElementById('mandiKagaj');
    const elementDharamkantaAmount = document.getElementById('Dharamkanta');
    const elementRemainingAmount = document.getElementById('remaining');
    const elementmiscellaneousexpense = document.getElementById('miscellaneousexpense');
    const elementTotalError = document.getElementById('total-error');

    // Default TDS percentage
    // let tdsPercentage = 2;

    function calculateTotal() {
        const quantity = parseFloat(elementQty.value) || 0;
        const rate = parseFloat(elementRate.value) || 0;

        // Calculate the total amount based on quantity and rate
        if (!isNaN(quantity) && !isNaN(rate)) {
            const totalAmount = quantity * rate;
            if (totalAmount % 1 !== 0) {
                elementTotalAmount.value = totalAmount.toFixed(2);
            } else {
                elementTotalAmount.value = totalAmount;
            }
        } else {
            elementTotalAmount.value = '';
        }

        // Calculate and update the remaining amount
        updateRemainingAmount();
    }

    function updateRemainingAmount() {
        const totalAmount = parseFloat(elementTotalAmount.value) || 0;
        const advanceAmount = parseFloat(elementAdvanceAmount.value) || 0;
        const commissionAmount = parseFloat(elementCommissionAmount.value) || 0;
        const miscellaneousexpenseAmount = parseFloat(elementmiscellaneousexpense.value) || 0;
        const holdAmount = parseFloat(elementHoldAmountAmount.value) || 0;
        const mandiKagajAmount = parseFloat(elementMandiKagajAmount.value) || 0;
        const hammaliAmount = parseFloat(elementHammaliAmount.value) || 0;
        const dharamkantaAmount = parseFloat(elementDharamkantaAmount.value) || 0;elementTDSAmount
        const tDSAmount = parseFloat(elementTDSAmount.value) || 0;

        // Dynamically calculate TDS
        // const tdsAmount = (totalAmount * (tdsPercentage / 100));

        // Update the TDS field (optional - only if you want to display the TDS separately)
        // elementTDSAmount.value = tdsPercentage;

        // Calculate the remaining amount after subtracting all relevant values
        let remainingAmount = totalAmount - advanceAmount - tDSAmount - commissionAmount - holdAmount - mandiKagajAmount - dharamkantaAmount - hammaliAmount - miscellaneousexpenseAmount;

        // Update the remaining amount input field
        if (!isNaN(remainingAmount)) {
            elementRemainingAmount.value = remainingAmount.toFixed(2);

            // Check if remaining amount is negative and show error if needed
            if (remainingAmount < 0) {
                elementTotalError.textContent = 'Remaining amount cannot be negative!';
                elementTotalError.style.color = 'red';
            } else {
                elementTotalError.textContent = '';
            }
        } else {
            elementRemainingAmount.value = '';
            elementTotalError.textContent = '';
        }
    }

    // Event listeners
    if (elementQty) elementQty.addEventListener('input', calculateTotal);
    if (elementRate) elementRate.addEventListener('input', calculateTotal);
    if (elementmiscellaneousexpense) elementmiscellaneousexpense.addEventListener('input', updateRemainingAmount);
    if (elementAdvanceAmount) elementAdvanceAmount.addEventListener('input', updateRemainingAmount);
    if (elementCommissionAmount) elementCommissionAmount.addEventListener('input', updateRemainingAmount);
    if (elementHoldAmountAmount) elementHoldAmountAmount.addEventListener('input', updateRemainingAmount);
    if (elementMandiKagajAmount) elementMandiKagajAmount.addEventListener('input', updateRemainingAmount);
    if (elementHammaliAmount) elementHammaliAmount.addEventListener('input', updateRemainingAmount);
    if (elementDharamkantaAmount) elementDharamkantaAmount.addEventListener('input', updateRemainingAmount);
    if (elementTDSAmount) elementTDSAmount.addEventListener('input', updateRemainingAmount);

    // document.getElementById('tds').addEventListener('input', function(event) {
    //     tdsPercentage = parseFloat(event.target.value) || 0; // Default to 2% if invalid input
    //     updateRemainingAmount();
    // });
</script>

</div>
@endsection