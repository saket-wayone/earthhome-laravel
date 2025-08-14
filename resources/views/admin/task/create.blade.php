@extends('admin.layout')
@section('content')

<!-- Include jQuery -->

<!-- Include Select2 CSS & JS -->

<style>
    table thead {
        background-color: black;
        color: white;
    }
</style>
<form action="{{ route(name: 'task.store') }}" id="companyadmin" method="post" enctype="multipart/form-data">
    @csrf
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-xxl-12 col-xl-10 col-lg-12">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Upload Task</h4>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">

                            <!-- Select User -->

                            <!-- Project Status -->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <select class="form-control" name="category">
                                        <option value="">Select Category</option>z

                                        @if(!empty($categories))
                                        @foreach($categories as $listing)
                                        <option value="{{$listing->id ?? ''}}">{{$listing->source ?? ''}}</option>z
                                        @endforeach()

                                        @endif()
                                    </select>
                                    <label>Select Category</label>
                                    <div class="error-message mt-1" id="category-error"></div>



                                </div>
                            </div>
                            <!-- Project Status -->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea name="description" class="form-control" placeholde="Enter Description"></textarea>
                                    <label for="quotation_file">Enter Description</label>
                                    <div class="error-message mt-1" id="description-error"></div>


                                </div>
                            </div>


                            <!-- Upload Agreement -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="file" class="form-control" accept="image/*" name="before[]" multiple>
                                    <label for="before">Before Photo / Morning</label>
                                    <div class="error-message mt-1" id="agreement_file-error"></div>
                                </div>
                            </div>

                            <!-- Upload Quotation -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="file" class="form-control" accept="image/*" name="after[]" multiple>
                                    <label for="after">After Photo / Evening</label>
                                    <div class="error-message mt-1" id="after-error"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="date" name="task_date" class="form-control" name="task_date">
                                    <input type="hidden" value="{{$leadid }}" class="form-control" name="lead_id">
                                    <label for="quotation_file">Add Task Date</label>
                                    <div class="error-message mt-1" id="task_date-error"></div>
                                </div>
                            </div>

                            <!-- Financial Section -->


                            <!-- Submit Button -->
                            <div class="col-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-dark btn-lg px-4" id="changetext">Submit </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>

<!-- end col -->

<script src="{{asset('admin/js/ajax/leads.js')}}"></script>

<script>
    $(document).ready(function() {
        $(".select2").select2({
            placeholder: "Select Status",
            allowClear: true,
            width: "100%"
        });
    });

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
        // if (!isNaN(quantity) && !isNaN(rate)) {
        //     const totalAmount = quantity * rate;
        //     if (totalAmount % 1 !== 0) {
        //         elementTotalAmount.value = totalAmount.toFixed(2);
        //     } else {
        //         elementTotalAmount.value = totalAmount;
        //     }
        // } else {
        //     elementTotalAmount.value = '';
        // }

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
        const dharamkantaAmount = parseFloat(elementDharamkantaAmount.value) || 0;
        const tDSAmount = parseFloat(elementTDSAmount.value) || 0;

        // Dynamically calculate TDS
        // const tdsAmount = totalAmount - tdsPercentage;

        // Update the TDS field (optional - only if you want to display the TDS separately)
        // elementTDSAmount.value = tdsPercentage;

        // Calculate the remaining amount after subtracting all relevant values
        let remainingAmount = totalAmount - tDSAmount - advanceAmount - commissionAmount - holdAmount - mandiKagajAmount - dharamkantaAmount - hammaliAmount - miscellaneousexpenseAmount;

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