@extends('admin.layout')
@section('content')
<style>
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

    .ifbank {
        display: none;
        ;
    }

    .ifphonepay {
        display: none;
        ;
    }

    .card {
        border: 1px solid #ccc;
        border-radius: 8px;
        margin: 20px 0;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f7f7f7;
        border-bottom: 1px solid #ccc;
        padding: 10px;
    }

    #samebankId {
        display: none;
    }

    .card-title {
        font-size: 24px;
        font-weight: bold;
    }

    .table {
        width: 100%;
        margin: 20px 0;
    }

    .table th,
    .table td {
        padding: 8px 12px;
        text-align: left;
    }

    .table th {
        background-color: #f1f1f1;
        font-weight: bold;
    }

    #paymentSection {
        display: none;
    }
</style>
<script>
    window.onload = function() {
        showpaymentmode("{{ $lead->paymode }}");
        samebankfunction("{{$lead->samebank}}")
        selectPaymentMethod("{{$lead->payment_option1}}")
    };
</script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Hold Amount : ₹ {{$lead->hold_amount ?? '' }}</h4>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{route('leads.hold-payment.update')}}" id="companyadmin" enctype="multipart/form-data" method="post">

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xxl-12 col-xl-10 col-lg-12">
                            <div class="card shadow-sm border-0 rounded-3">

                                <div class="card-body">
                                    @csrf
                                    <div class="row ">




                                        <!-- Financial Section -->
                                        <div class="container">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    @if(Auth::user()->role =='Transporter')
                                                    <tr>
                                                        <td><label for="advancebyid">Status of payment</label></td>
                                                        <td>
                                                            {{ $lead->hold_amount_status  ?? '' }}

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="less_quantity"> Quantity Supplied </label></td>
                                                        <td>
                                                            <div class="text-left">
                                                                {{$lead->quantity}}

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Advance -->
                                                    <tr>
                                                        <td><label for="less_quantity">Net Quantity delivered </label></td>
                                                        <td>

                                                            {{$lead->less_quantity ?? ''}}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><label for="difference">Difference in Quantity </label></td>
                                                        <td>
                                                            {{$lead->difference}}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><label for="updated_rate">Billing rate</label></td>
                                                        <td>
                                                            {{$lead->updated_rate}}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><label for="Remaining Amount ">Net Amount to be paid after POD </label></td>
                                                        <td>
                                                            {{$lead->remaining_hold_amount}}
                                                        </td>
                                                    </tr>

                                                    <!-- Transporter Commission -->

                                                    <tr>
                                                        <td><label for="account_number">Upload Proof of Delivery </label></td>
                                                        <td>
                                                            <input type="file" class="form-control" id="proof" name="proof[]" accept="image/*" multiple>
                                                            <div class="error-message mt-1" id="proof-error"></div>
                                                        </td>
                                                    </tr>
                                                   
                                                    <tr>
                                                        <td><label for="paymode">Payment Mode</label></td>
                                                        <td>
                                                            <select name="paymode" onchange="showpaymentmode(this.value)" class="form-control" id="paymode">
                                                                <option value="">Select Paymode Mode</option>
                                                                <option value="Cash" @if ($lead->paymode == 'Cash')
                                                                    {{'selected'}}
                                                                    @endif>Cash
                                                                </option>
                                                                <option value="Bank" @if ($lead->paymode == 'Bank')
                                                                    {{'selected'}}
                                                                    @endif>Bank
                                                                </option>

                                                            </select>
                                                            <div class="error-message mt-1" id="paymode-error"></div>
                                                        </td>
                                                    </tr>
                                                    <tr id="samebankId">
                                                        <td><label for="samebank">Do you want the payment on the same bank account ? </label></td>
                                                        <td>
                                                            <select name="samebank" onchange="samebankfunction(this.value)" class="form-control" id="samebank">
                                                                <option value="">Select Yes/ No</option>
                                                                <option value="Yes" @if ($lead->samebank == 'Yes')
                                                                    {{'selected'}}
                                                                    @endif>Yes
                                                                </option>
                                                                <option value="No" @if ($lead->samebank == 'No')
                                                                    {{'selected'}}
                                                                    @endif>No
                                                                </option>

                                                            </select>
                                                            <div class="error-message mt-1" id="samebank-error"></div>
                                                        </td>
                                                    </tr>
                                                    <tr id="paymentSection">
                                                        <td><label for="payment_option1">Payment</label></td>
                                                        <td>
                                                            <select name="payment_option1" onchange="selectPaymentMethod(this.value)" class="form-select">
                                                                <option value=""> Select Payment Status</option>
                                                                <option value="Bank" @if ($lead->payment_option1 =='Bank')
                                                                    {{'selected'}}
                                                                    @endif >Bank
                                                                </option>
                                                                <option value="Phone Pay" @if ($lead->payment_option1 =='Phone Pay')
                                                                    {{'selected'}}
                                                                    @endif >Phone Pay
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr class="ifbank ifphonepay">
                                                        <td><label for="holder1">Account Holder Name</label></td>
                                                        <td>
                                                            <input type="text" class="form-control" id="holder1" value="{{$lead->holder1}}" name="holder1" placeholder="Advance Holder Name">
                                                            <div class="error-message mt-1" id="holder1-error"></div>
                                                        </td>
                                                    </tr>


                                                    <tr class="ifbank">
                                                        <td><label for="bankname1">Bank Name</label></td>
                                                        <td>
                                                            <input type="text" value="{{$lead->bankname1}}" class="form-control" id="bankname1" name="bankname1" placeholder="Bank Name">
                                                            <div class="error-message mt-1" id="bankname1-error"></div>
                                                        </td>
                                                    </tr>

                                                    <tr class="ifbank">
                                                        <td><label for="ifsc1">IFSC CODE</label></td>
                                                        <td>
                                                            <input type="ifsc1" class="form-control" id="ifsc1" name="ifsc1" value="{{$lead->ifsc1}}" placeholder="IFSC Code">
                                                            <div class="error-message mt-1" id="ifsc1-error"></div>
                                                        </td>
                                                    </tr>

                                                    <!-- Transporter Commission -->
                                                    <tr class="ifbank">
                                                        <td><label for="account_number">Account Number </label></td>
                                                        <td>
                                                            <input type="text" class="form-control" id="account_number1" value="{{$lead->account_number1}}" name="account_number1" placeholder="Account Number">
                                                            <div class="error-message mt-1" id="account_number1-error"></div>
                                                        </td>
                                                    </tr>
                                                    <tr class="ifphonepay">
                                                        <td><label for="phonepay_number">Phone Number </label></td>
                                                        <td>
                                                            <input type="text" class="form-control" id="phonepay_number1" value="{{$lead->phonepay_number1}}" name="phonepay_number1" placeholder="Account Number">
                                                            <div class="error-message mt-1" id="phonepay_number1-error"></div>
                                                        </td>
                                                    </tr>

                                                    @else

                                                    <tr>
                                                        <td><label for="advancebyid">Status of payment</label></td>
                                                        <td>
                                                            <select name="hold_amount_status" class="form-select">
                                                                <option value=""> Status of payment Status</option>
                                                                <option value="Pending" @if ($lead->hold_amount_status =='Pending')
                                                                    {{'selected'}}
                                                                    @endif >Pending
                                                                </option>
                                                                <option value="Completed" @if ($lead->hold_amount_status =='Completed')
                                                                    {{'selected'}}
                                                                    @endif >Completed
                                                                </option>
                                                            </select>
                                                            <div class="error-message mt-1" id="hold_amount_status-error"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="payment_date2">Payment Date</label></td>
                                                        <td>
                                                            <input type="date" class="form-control" id="payment_date2" value="{{$lead->payment_date2}}" name="payment_date2" placeholder="Payment Date">
                                                            <div class="error-message mt-1" id="payment_date2-error"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="less_quantity"> Quantity Supplied </label></td>
                                                        <td>
                                                            <div class="text-left">
                                                                {{$lead->quantity}}

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Advance -->
                                                    <tr>
                                                        <td><label for="less_quantity">Net Quantity delivered </label></td>
                                                        <td>
                                                            <input type="text" class="form-control" id="less_quantity" value="{{$lead->less_quantity}}" name="less_quantity" placeholder="Net Quantity delivered">
                                                            <div class="error-message mt-1" id="holder-error"></div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><label for="difference">Difference in Quantity </label></td>
                                                        <td>
                                                            <input type="text" class="form-control" id="difference" value="{{$lead->difference}}" name="difference" placeholder="Difference Quantity delivered">
                                                            <div class="error-message mt-1" id="difference-error"></div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><label for="updated_rate">Billing rate</label></td>
                                                        <td>
                                                            <input type="text" value="{{$lead->updated_rate}}" class="form-control" id="updated_rate" name="updated_rate" placeholder="Billing rate">
                                                            <div class="error-message mt-1" id="updated_rate-error"></div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td><label for="Remaining Amount ">Net Amount to be paid after POD </label></td>
                                                        <td>
                                                            <input type="text" class="form-control" id="remaining_hold_amount" name="remaining_hold_amount" value="{{$lead->remaining_hold_amount}}" placeholder="Net Amount to be paid after proof of delivery">
                                                            <div class="error-message mt-1" id="remaining_hold_amount-error"></div>
                                                        </td>
                                                    </tr>

                                                    <!-- Transporter Commission -->
                                                    <tr>
                                                        <td><label for="account_number">Upload Proof of Delivery </label></td>
                                                        <td>
                                                            <input type="file" class="form-control" id="proof" name="proof[]" accept="image/*" multiple>

                                                            <div class="error-message mt-1" id="proof-error"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="paymode">Payment Mode</label></td>
                                                        <td>
                                                            <select name="paymode" onchange="showpaymentmode(this.value)" class="form-control" id="paymode">
                                                                <option value="">Select Paymode Mode</option>
                                                                <option value="Cash" @if ($lead->paymode == 'Cash')
                                                                    {{'selected'}}
                                                                    @endif>Cash
                                                                </option>
                                                                <option value="Bank" @if ($lead->paymode == 'Bank')
                                                                    {{'selected'}}
                                                                    @endif>Bank
                                                                </option>

                                                            </select>
                                                            <div class="error-message mt-1" id="paymode-error"></div>
                                                        </td>
                                                    </tr>
                                                    <tr id="samebankId">
                                                        <td><label for="samebank">Do you want the payment on the same bank account ? </label></td>
                                                        <td>
                                                            <select name="samebank" onchange="samebankfunction(this.value)" class="form-control" id="samebank">
                                                                <option value="">Select Yes/ No</option>
                                                                <option value="Yes" @if ($lead->samebank == 'Yes')
                                                                    {{'selected'}}
                                                                    @endif>Yes
                                                                </option>
                                                                <option value="No" @if ($lead->samebank == 'No')
                                                                    {{'selected'}}
                                                                    @endif>No
                                                                </option>

                                                            </select>
                                                            <div class="error-message mt-1" id="samebank-error"></div>
                                                        </td>
                                                    </tr>
                                                    <tr id="paymentSection">
                                                        <td><label for="payment_option1">Payment</label></td>
                                                        <td>
                                                            <select name="payment_option1" onchange="selectPaymentMethod(this.value)" class="form-select">
                                                                <option value=""> Select Payment Status</option>
                                                                <option value="Bank" @if ($lead->payment_option1 =='Bank')
                                                                    {{'selected'}}
                                                                    @endif >Bank
                                                                </option>
                                                                <option value="Phone Pay" @if ($lead->payment_option1 =='Phone Pay')
                                                                    {{'selected'}}
                                                                    @endif >Phone Pay
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr class="ifbank ifphonepay">
                                                        <td><label for="holder1">Account Holder Name</label></td>
                                                        <td>
                                                            <input type="text" class="form-control" id="holder1" value="{{$lead->holder1}}" name="holder1" placeholder="Advance Holder Name">
                                                            <div class="error-message mt-1" id="holder1-error"></div>
                                                        </td>
                                                    </tr>


                                                    <tr class="ifbank">
                                                        <td><label for="bankname1">Bank Name</label></td>
                                                        <td>
                                                            <input type="text" value="{{$lead->bankname1}}" class="form-control" id="bankname1" name="bankname1" placeholder="Bank Name">
                                                            <div class="error-message mt-1" id="bankname1-error"></div>
                                                        </td>
                                                    </tr>

                                                    <tr class="ifbank">
                                                        <td><label for="ifsc1">IFSC CODE</label></td>
                                                        <td>
                                                            <input type="ifsc1" class="form-control" id="ifsc1" name="ifsc1" value="{{$lead->ifsc1}}" placeholder="IFSC Code">
                                                            <div class="error-message mt-1" id="ifsc1-error"></div>
                                                        </td>
                                                    </tr>

                                                    <!-- Transporter Commission -->
                                                    <tr class="ifbank">
                                                        <td><label for="account_number">Account Number </label></td>
                                                        <td>
                                                            <input type="text" class="form-control" id="account_number1" value="{{$lead->account_number1}}" name="account_number1" placeholder="Account Number">
                                                            <div class="error-message mt-1" id="account_number1-error"></div>
                                                        </td>
                                                    </tr>
                                                    <tr class="ifphonepay">
                                                        <td><label for="phonepay_number">Phone Number </label></td>
                                                        <td>
                                                            <input type="text" class="form-control" id="phonepay_number1" value="{{$lead->phonepay_number1}}" name="phonepay_number1" placeholder="Account Number">
                                                            <div class="error-message mt-1" id="phonepay_number1-error"></div>
                                                        </td>
                                                    </tr>
                                                    @endif()


                                                    <input type="hidden" name="lead_id" value="{{$lead->id}}">
                                                </tbody>
                                            </table>
                                        </div>




                                        <!-- Submission Button -->
                                        <div class="col-12 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-dark btn-lg  px-4" id="changetext">Submit</button>
                                        </div>
                                    </div>
                                    @if(!empty($lead->proof))
    @php
        $proofs = json_decode($lead->proof);

        // Check if $proofs is an array before attempting to loop
        if (is_array($proofs)) {
            foreach ($proofs as $proof) {
                echo '<a href="' . asset($proof) . '" target="__blank"><img src="' . asset($proof) . '" alt="Proof Image" width="100" height="100" /></a>';
            }
        }else{
        
                        echo '<a href="' . asset($lead->proof) . '" target="__blank"><img src="' . asset($lead->proof) . '" alt="Proof Image" width="100" height="100" /></a>';

}
        
    @endphp
@endif

            </form>
        </div>
    </div>
</div>

<script src="{{ asset('admin/js/ajax/leads.js') }}"></script>
<style>
    .table th,
    .table td {
        font-size: 14px;
    }

    .table td {
        font-size: 12px;
    }

    .card-title {
        font-size: 1.5rem;
    }

    .btn {
        padding: 0.25rem 0.5rem;
    }
</style>
@endsection

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    function showpaymentmode(value ='') {
        if(value !=''){
            if (value == 'Bank') {
            $('#samebankId').show();
        } else {
            $('#samebankId').hide();

        }
        }
       
    }

    function samebankfunction(value = '') {
        if (value != '') {
            if (value == 'Yes') {
                $('#holder1').val("{{$lead->holder}}");
                $('#bankname1').val("{{$lead->bankname}}");
                $('#ifsc1').val("{{$lead->ifsc}}");
                $('#account_number1').val("{{$lead->account_number}}");
                $('#phonepay_number1').val("{{$lead->phonepay_number}}");
                $('#payment_option1').val("{{$lead->payment_option}}");
            } else {
                $('#holder1').val("{{$lead->holder1}}");
                $('#bankname1').val("{{$lead->bankname1}}");
                $('#ifsc1').val("{{$lead->ifsc1}}");
                $('#account_number1').val("{{$lead->account_number1}}");
                $('#phonepay_number1').val("{{$lead->phonepay_number1}}");
                $('#payment_option1').val("{{$lead->payment_option1}}");
            }

            $('#paymentSection').show();
        }

    }


    function selectPaymentMethod(value = '') {
        if (value == 'Bank' || value == 'Phone Pay') {
            if (value == 'Bank') {
                $('.ifphonepay').hide();
                $('.ifbank').show();

            } else {
                $('.ifbank').hide();
                $('.ifphonepay').show();

            }
        }

    }

    document.addEventListener('DOMContentLoaded', function() {
        const table = document.querySelector('.table');
        const headers = table.querySelectorAll('th[data-sort]');
        const scrollLeftBtn = document.getElementById('scroll-left');
        const scrollRightBtn = document.getElementById('scroll-right');
        const scrollAmount = 150; // Adjust the scroll amount as needed

        headers.forEach(header => {
            header.addEventListener('click', () => {
                const sortOrder = header.dataset.sortOrder === 'asc' ? 'desc' : 'asc';
                const columnType = header.dataset.sort;
                const columnIndex = Array.from(headers).indexOf(header);

                header.dataset.sortOrder = sortOrder;
                updateSortArrows(header, sortOrder);
                sortTable(table, columnIndex, columnType, sortOrder);
            });
        });

        function sortTable(table, columnIndex, columnType, sortOrder) {
            const rows = Array.from(table.querySelectorAll('tbody > tr'));
            const compare = (a, b) => {
                const cellA = a.children[columnIndex].innerText.toLowerCase();
                const cellB = b.children[columnIndex].innerText.toLowerCase();

                let comparison = 0;
                if (columnType === 'number') {
                    comparison = parseFloat(cellA) - parseFloat(cellB);
                } else if (columnType === 'date') {
                    comparison = new Date(cellA) - new Date(cellB);
                } else {
                    comparison = cellA.localeCompare(cellB);
                }

                return sortOrder === 'asc' ? comparison : -comparison;
            };

            rows.sort(compare);

            const tbody = table.querySelector('tbody');
            rows.forEach(row => tbody.appendChild(row));
        }



        function updateSortArrows(header, sortOrder) {
            headers.forEach(h => {
                h.querySelector('.sort-arrow').innerHTML = '&uarr;';
            });
            header.querySelector('.sort-arrow').innerHTML = sortOrder === 'asc' ? '&uarr;' : '&darr;';
        }

        // function calculateTotal() {
        //     const quantity = parseFloat(elementQty.value) || 0;
        //     const rate = parseFloat(elementRate.value) || 0;
        //     if (!isNaN(quantity) && !isNaN(rate)) {
        //         const totalAmount = quantity * rate;
        //         if (totalAmount % 1 !== 0) {
        //             elementRemainingAmount.value = totalAmount.toFixed(2);
        //         } else {
        //             elementRemainingAmount.value = totalAmount;
        //         }
        //     } else {
        //         elementRemainingAmount.value = '';
        //     }
        // }
        // const elementRate = document.getElementById('updated_rate');
        // const elementQty = document.getElementById('less_quantity');
        // const elementRemainingAmount = document.getElementById('remaining_hold_amount');
        // if (elementQty) elementQty.addEventListener('input', calculateTotal);
        // if (elementRate) elementRate.addEventListener('input', calculateTotal);


        scrollLeftBtn.addEventListener('click', () => {
            const container = document.querySelector('.table-responsive');
            container.scrollBy({
                left: -scrollAmount,
                behavior: 'smooth'
            });
        });

        scrollRightBtn.addEventListener('click', () => {
            const container = document.querySelector('.table-responsive');
            container.scrollBy({
                left: scrollAmount,
                behavior: 'smooth'
            });
        });
    });
</script>