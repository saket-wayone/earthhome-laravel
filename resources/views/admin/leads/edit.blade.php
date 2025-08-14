@extends('admin.layout')
@section('content')
<style>
    table thead {
        background-color: black;
        color: white;
    }
        .custom-multiselect {
        position: relative;
        width: 100%;
    }

    .custom-multiselect input {
        width: 100%;
        padding: 10px;
        border: 2px solid #6c757d;
        border-radius: 8px;
        outline: none;
    }

    .custom-multiselect .dropdown {
        position: absolute;
        width: 100%;
        background: white;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-height: 200px;
        overflow-y: auto;
        display: none;
        z-index: 10;
    }

    .custom-multiselect .dropdown div {
        padding: 8px;
        cursor: pointer;
        transition: 0.3s;
    }

    .custom-multiselect .dropdown div:hover {
        background: #007bff;
        color: white;
    }

    .custom-multiselect .selected-items {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
        margin-top: 5px;
    }

    .custom-multiselect .selected-item {
        background: #007bff;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .custom-multiselect .selected-item span {
        cursor: pointer;
        font-weight: bold;
    }

</style>
<form action="{{ route(name: 'leads.update') }}" id="companyadmin" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="lead_id" value="{{ $lead->id }}">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-xxl-12 col-xl-10 col-lg-12">
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-header bg-gradient-primary text-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Update Project</h4>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="row g-4">
                              <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" value="{{$lead->name}}" class="form-control" name="name">
                                    <label for="name">Project Name</label>
                                    <div class="error-message mt-1" id="name-error"></div>
                                </div>
                                
                            </div>
                             <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" value="{{$lead->address}}" class="form-control" name="address">
                                    <label for="address">Project Address</label>
                                    <div class="error-message mt-1" id="address-error"></div>
                                </div>
                            </div>

                            <!-- Select User -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="user_id" class="form-select">
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ ($lead->user_id ==$user->id ) ? 'selected' : ''}}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="user_id">Select User</label>
                                    <div class="error-message mt-1" id="user_id-error"></div>
                                </div>
                            </div>

                            <!-- Project Status -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="project_status" class="form-select">
                                        <option value="">Select Status</option>
                                        <option value="Pending" {{ ($lead->status =='Pending' ) ? 'selected' : ''}}>Pending</option>
                                        <option value="Completed" {{ ($lead->status =='Completed' ) ? 'selected' : ''}}>Completed</option>
                                    </select>
                                    <label for="project_status">Overall Project Status</label>
                                    <div class="error-message mt-1" id="project_status-error"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
    <label for="agents">Select Agents</label>
    <div class="custom-multiselect">
        <input type="text" id="agent-search" placeholder="Search Agents...">
        <div class="dropdown" id="agent-dropdown">
            @if(!empty($agent))
            @foreach ($agent as $in=>$alist)
            <div data-value="{{ $alist->name }}">{{ $alist->name }} ({{ $alist->role }})</div>
            @endforeach
            @endif
        </div>
        <div class="selected-items" id="selected-agents">

        </div>
        <!-- Hidden Input for JSON Array -->
        <input type="hidden" name="agents" id="selected-agents-input" 
               value="{{ $lead->agents }}">
    </div>
</div>


                            <!-- Upload Agreement -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="file" class="form-control" name="agreement_file">
                                    <label for="agreement_file">Upload Agreement</label>
                                    <div class="error-message mt-1" id="agreement_file-error"></div>
                                </div>
                                <div class="mb-2 mt-2">
                                    @if($lead->agreement_file !='')
                                    <a href="{{ url($lead->agreement_file) }}" target="__blank">
                                        View
                                        <!--<img src="{{ url($lead->agreement_file) }}" width="50" height="50">-->
                                    </a>
                                    @endif()
                                </div>
                            </div>


                            <!-- Upload Quotation -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="file" class="form-control" name="quotation_file">
                                    <label for="quotation_file">Upload Quotation</label>
                                    <div class="error-message mt-1" id="quotation_file-error"></div>
                                </div>
                                <div class="mb-2 mt-2">
                                    @if($lead->quotation_file !='')
                                    <a href="{{ url($lead->quotation_file) }}" target="__blank">
                                        View

                                        <!--<img src="{{ url($lead->quotation_file) }}" width="50" height="50">-->
                                    </a>
                                    @endif()
                                </div>
                            </div>

                            <!-- Financial Section -->
                            <div class="container">
                                <table class="table table-bordered">
                                    <tbody>
                                        @if(count($catProducts) > 0)
                                        @foreach ($catProducts as $key => $category)
                                        <tr>
                                            <td><label>{{ ++$key }}. {{ $category->category ?? '' }}</label></td>
                                            <input type="hidden" value="{{ $category->category ?? '' }}" class="form-control" name="category[]">

                                            <td>
                                                <label>Enter Price for this phase</label>
                                                <input type="number" value="{{ $category->price }}" class="form-control" name="price[]" placeholder="Price">
                                            </td>
                                            <td>
                                                <label>Expected Completion Date</label>
                                                <input type="date" value="{{ $category->completion_date }}" class="form-control" name="completion_date[]">
                                            </td>
                                            <td>
                                                <label>Overall Status</label>
                                                <select class="form-control" name="status[]">
                                                    <option value="Pending" {{ ($category->status =='Pending') ? 'selected' : '' }}>Pending</option>
                                                    <option value="Completed" {{ ($category->status =='Completed') ? 'selected' : '' }}>Completed</option>
                                                </select>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        @foreach ($category as $key => $category)
                                        <tr>
                                            <td><img src="{{ url($category->image) }}" width="40" height="40"></td>
                                            <td><label>{{ ++$key }}. {{ $category->source ?? '' }}</label></td>
                                            <input type="hidden" value="{{ $category->source ?? '' }}" class="form-control" name="category[]">

                                            <td>
                                                <label>Enter Price for this phase</label>
                                                <input type="number" class="form-control" name="price[]" placeholder="Price">
                                            </td>
                                            <td>
                                                <label>Expected Completion Date</label>
                                                <input type="date" class="form-control" name="completion_date[]">
                                            </td>
                                            <td>
                                                <label>Overall Status</label>
                                                <select class="form-control" name="status[]">
                                                    <option value="Pending">Pending</option>
                                                    <option value="Completed">Completed</option>
                                                </select>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif()

                                        <!-- Total Amount -->
                                        <tr>
                                            <td><label for="total_amount">Total Amount</label></td>
                                            <td colspan="4">
                                                <input type="number" value="{{ $lead->total }}" class="form-control" name="total_amount" placeholder="Total Amount">
                                                <div class="error-message mt-1" id="total_amount-error"></div>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12 d-flex justify-content-center">
                                <button type="submit" class="btn btn-dark btn-lg px-4" id="changetext">Submit Project</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
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
      document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.getElementById("agent-search");
    const dropdown = document.getElementById("agent-dropdown");
    const selectedItemsContainer = document.getElementById("selected-agents");
    const hiddenInput = document.getElementById("selected-agents-input");

    let selectedValues = hiddenInput.value ? JSON.parse(hiddenInput.value) : [];

    function updateSelectedItems() {
        selectedItemsContainer.innerHTML = "";
        selectedValues.forEach(value => {
            const item = document.createElement("div");
            item.classList.add("selected-item");
            item.innerHTML = `${value} <span data-value="${value}">&times;</span>`;
            selectedItemsContainer.appendChild(item);
        });
        hiddenInput.value = JSON.stringify(selectedValues); // **JSON array format**
    }

    updateSelectedItems(); // **Ensure previously selected agents show up**

    searchInput.addEventListener("focus", function () {
        dropdown.style.display = "block";
    });

    searchInput.addEventListener("input", function () {
        const filter = searchInput.value.toLowerCase();
        const items = dropdown.querySelectorAll("div");
        items.forEach(item => {
            if (item.textContent.toLowerCase().includes(filter)) {
                item.style.display = "block";
            } else {
                item.style.display = "none";
            }
        });
    });

    dropdown.addEventListener("click", function (event) {
        if (event.target.tagName === "DIV") {
            const value = event.target.getAttribute("data-value");
            if (!selectedValues.includes(value)) {
                selectedValues.push(value);
                updateSelectedItems();
            }
            searchInput.value = "";
            dropdown.style.display = "none";
        }
    });

    selectedItemsContainer.addEventListener("click", function (event) {
        if (event.target.tagName === "SPAN") {
            const value = event.target.getAttribute("data-value");
            selectedValues = selectedValues.filter(val => val !== value);
            updateSelectedItems();
        }
    });

    document.addEventListener("click", function (event) {
        if (!dropdown.contains(event.target) && event.target !== searchInput) {
            dropdown.style.display = "none";
        }
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