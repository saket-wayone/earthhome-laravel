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

    .card-title {
        font-size: 24px;
        font-weight: bold;
    }
    .ifbank{
        display: none;;
    }
    .ifphonepay{
        display: none;;
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
    
</style>
<script>
 window.onload = function() {
        selectPaymentMethod("{{ $lead->payment_option }}");
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
                <h4 class="card-title mb-0 flex-grow-1">Remaining Amount : ₹ {{$lead->remaining ?? '' }}</h4>
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
            <form action="{{route('leads.remaining-payment.update')}}" id="companyadmin" method="post">

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
                                                    @if(Auth::user()->role =='admin')

                                                    <tr>
                                                        <td><label for="advancebyid">Remaining Payment Status</label></td>
                                                        <td>
                                                            <select name="payment_status" class="form-select">
                                                                <option value=""> Remaining Payment Status</option>
                                                                <option value="Pending" @if ($lead->payment_status =='Pending')
                                                                    {{'selected'}}
                                                                    @endif >Pending
                                                                </option>
                                                                <option value="Completed" @if ($lead->payment_status =='Completed')
                                                                    {{'selected'}}
                                                                    @endif >Completed
                                                                </option>
                                                            </select>
                                                            <div class="error-message mt-1" id="payment-status-error"></div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><label for="payment_date">Payment Date</label></td>
                                                        <td>
                                                            <input type="date" class="form-control" id="payment_date" value="{{$lead->payment_date}}" name="payment_date" placeholder="Payment Date">
                                                            <div class="error-message mt-1" id="payment_date-error"></div>
                                                        </td>
                                                    </tr>
                                                    @endif()

                                                    <!-- Advance -->

                                                    <tr>
                                                        <td><label for="paymentoption">Payment</label></td>
                                                        <td>
                                                            <select name="payment_option" onchange="selectPaymentMethod(this.value)" class="form-select">
                                                                <option value=""> Remaining Payment Status</option>
                                                                <option value="Bank" @if ($lead->payment_option =='Bank')
                                                                    {{'selected'}}
                                                                    @endif >Bank
                                                                </option>
                                                                <option value="Phone Pay" @if ($lead->payment_option =='Phone Pay')
                                                                    {{'selected'}}
                                                                    @endif >Phone Pay
                                                                </option>
                                                            </select>
                                                        </td>
                                                    </tr>
                                                        <tr class="ifbank ifphonepay" >
                                                            <td><label for="accountHolderName">Account Holder Name</label></td>
                                                            <td>
                                                                <input type="text" class="form-control" id="accountHolderName" value="{{$lead->holder}}" name="holder" placeholder="Advance Holder Name">
                                                                <div class="error-message mt-1" id="holder-error"></div>
                                                            </td>
                                                        </tr>


                                                        <tr class="ifbank">
                                                            <td><label for="bankname">Bank Name</label></td>
                                                            <td>
                                                                <input type="text" value="{{$lead->bankname}}" class="form-control" id="bankname" name="bankname" placeholder="Bank Name">
                                                                <div class="error-message mt-1" id="bankname-error"></div>
                                                            </td>
                                                        </tr>

                                                        <tr class="ifbank">
                                                            <td><label for="ifsc">IFSC CODE</label></td>
                                                            <td>
                                                                <input type="ifsc" class="form-control" id="ifsc" name="ifsc" value="{{$lead->ifsc}}" placeholder="IFSC Code">
                                                                <div class="error-message mt-1" id="ifsc-error"></div>
                                                            </td>
                                                        </tr>

                                                        <!-- Transporter Commission -->
                                                        <tr class="ifbank">
                                                            <td><label for="account_number">Account Number </label></td>
                                                            <td>
                                                                <input type="text" class="form-control" id="account_number" value="{{$lead->account_number}}" name="account_number" placeholder="Account Number">
                                                                <div class="error-message mt-1" id="account_number-error"></div>
                                                            </td>
                                                        </tr>
                                                        <tr class="ifphonepay">
                                                            <td><label for="phonepay_number">Phone Number </label></td>
                                                            <td>
                                                                <input type="text" class="form-control" id="phonepay_number" value="{{$lead->phonepay_number}}" name="phonepay_number" placeholder="Account Number">
                                                                <div class="error-message mt-1" id="phonepay_number-error"></div>
                                                            </td>
                                                        </tr>

                                                    <input type="hidden" name="lead_id" value="{{$lead->id}}">
                                                </tbody>
                                            </table>
                                        </div>



                                        <!-- Submission Button -->
                                        <div class="col-12 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-dark btn-lg  px-4" id="changetext">Submit</button>
                                        </div>
                                    </div>
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
    function selectPaymentMethod(value='') {
        if(value == 'Bank' ||  value =='Phone Pay'){
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