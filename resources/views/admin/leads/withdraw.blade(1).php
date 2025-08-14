@extends('admin.layout')
@section('content')
<style>
    table thead {
        background-color: black;
        color: white;
    }
</style>
@if($amount > 0 )
<form action="{{route('leads.withdrawrequest')}}" id="companyadmin" method="post">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-xxl-12 col-xl-10 col-lg-12">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Make withdraw Request</h4>

                            <div class="text-center text-warning">
                                Note : You can withdraw max to max ₹ {{$amount}} Rupees

                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        @csrf
                        <div class="row g-4">

                            <!-- Firm & Transporter Selection -->

                            <!-- Driver Information -->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="number" class="form-control" oninput="validateWithdrawAmount(this)" id="withdraw" name="withdraw" max="{{$amount}}" placeholder="Enter withdraw Amont">
                                    <label for="withdraw">Make Amount Request </label>
                                    <div class="error-message mt-1" id="withdraw-error"></div>
                                </div>
                            </div>

                            <!-- Financial Section -->




                            <!-- Submission Button -->
                            <div class="col-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-dark btn-lg  px-4" id="changetext">Submit </button>
                            </div>
                        </div>
</form>

@else
<div class="card">
    <div class="card-header">

        <div class="alert alert-warning">
            Opps! you don't have any enough amount to make withdrawal request

        </div>
    </div>
</div>

@endif()

<div class="card-body">
    <div class="live-preview">
        <div class="table-responsive">


            <table class="table table-bordered  mb-0">
                <thead>
                    <tr>
                        <th data-sort="date">Sno <span class="sort-arrow">&uarr;</span></th>
                        <th data-sort="string">Amount<span class="sort-arrow">&uarr;</span></th>
                        <th data-sort="string">Status<span class="sort-arrow">&uarr;</span></th>
                        <th data-sort="string">Payment proof <span class="sort-arrow">&uarr;</span></th>
                        <th data-sort="string">Created At <span class="sort-arrow">&uarr;</span></th>

                    </tr>
                </thead>
                <tbody id="appendleads">

                    @if(!empty($withdrawdata))
                    @foreach($withdrawdata as $index => $list)
                    <tr id="lead-row-{{ $list->id }}">
                        <td>{{ ++ $index }}</td>
                        <td>{{ $list->amount ?? '' }}</td>
                        <td>
                            @if(!empty($list->status))
                            <span class="btn btn-sm 
                                                @switch($list->status)
                                                    @case('Pending')
                                                        btn-warning
                                                        @break
                                                    @case('Completed')
                                                        btn-success
                                                        @break
                                                    @case('On the way for Loading')
                                                        btn-primary
                                                        @break
                                                    @case('Vehicle Loading')
                                                        btn-info
                                                        @break
                                                    @case('Loading Completed')
                                                        btn-dark
                                                        @break
                                                    @case('In Transit')
                                                        btn-secondary
                                                        @break
                                                    @case('Reached Destination')
                                                        btn-success
                                                        @break
                                                    @case('Waiting For Unloading')
                                                        btn-warning
                                                        @break
                                                    @case('Vehicle Unloading')
                                                        btn-info
                                                        @break
                                                    @case('Waiting for Payment')
                                                        btn-danger
                                                        @break
                                                    @default
                                                        btn-light
                                                @endswitch
                                                ">

                                <span data-bs-target="#updateStatus" onclick="updateLeadStatus('{{ $list->id }}')" data-bs-toggle="modal"> {{ $list->status ?? '' }}</span>

                                @endif
                        </td>

                        <td> @if(!empty($list->proof))
                                    <a href="{{asset($list->proof)}}" target="__blank">
                                        <img src="{{asset($list->proof)}}" width="100" height="100">
                                    </a>
                                    @endif()</td>
                        <td>{{ $list->created_at ?? '' }}</td>


                        
                    </tr>


                    @endforeach

                    @endif
                </tbody>

            </table>

            <div class="d-flex justify-content-end mt-2 ">

                @if(!empty($leads))
                {{$leads->links()}}
                @endif()
            </div>

        </div>
    </div>
</div><!-- end card-body -->
<!-- end col -->

<script src="{{asset('admin/js/ajax/leads.js')}}"></script>

<script>
    function validateWithdrawAmount(input) {
        const maxAmount =
            "{{$amount}}";
        const errorElement = document.getElementById('withdraw-error');

        if (input.value > maxAmount) {
            // Show error message if the value exceeds the max amount
            errorElement.textContent = `The maximum allowed amount is ${maxAmount}.`;
            input.classList.add('is-invalid'); // Add a red border for invalid input
        } else {
            // Remove error if the value is valid
            errorElement.textContent = '';
            input.classList.remove('is-invalid');
        }
    }
</script>
</div>
@endsection