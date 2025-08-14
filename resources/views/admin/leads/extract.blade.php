@extends('admin.layout')
@section('content')
<style>
    .table-responsive {
        overflow-x: auto;
        position: relative;
        white-space: nowrap;
        max-width: 100%;
        /* Ensures the container doesn't exceed the width */
        border: 1px solid #dee2e6;
    }

    .table-container {
        position: relative;
        overflow: hidden;
    }

    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        border-collapse: collapse;
    }

    th {
        font-size: 13px !important;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
    }

    .sort-arrow {
        cursor: pointer;
        font-size: 12px;
        margin-left: 5px;
    }

    .scroll-btn {
        position: sticky;
        margin-top: 20px;

        /*top: 1%;*/
        transform: translateY(-50%);
        background: #007bff;
        color: #fff;
        border: none;
        padding: 10px;
        cursor: pointer;
        z-index: 9999;
    }

    #scroll-left {
        left: 0;
    }

    #scroll-right {
        right: 0;
    }

    table thead {
        background-color: black;
        color: white;
    }

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
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<!-- leads import -->

@if(in_array(Auth::user()->role, ['admin', 'BDE']))

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Extract Leads</h4>

            </div><!-- end card header -->

            <div class="card-body">
                <form id="companyadmin" method="POST" action="{{ route('extract.leads') }}">
                    @csrf()

                    <div class="live-preview">
                        <div class="row">
                            @if(Auth::user()->role =='admin')
                            <div class="col-md-4">
                                <label>Select Employee</label>
                                <select class="form-control" name="employee_id[]" id="employee" style="width: 100%" multiple required>
                                    <option value="">Select Employee</option>

                                    @if(!empty($users))
                                    @foreach($users as $list)
                                    <option value="{{$list->id}}">{{$list->name}}- {{$list->role}}</option>
                                    @endforeach()
                                    @endif()
                                </select>

                            </div>
                            @endif()
                            <div class="col-md-4">

                                <label>Select Status</label>
                                <select class="form-control" name="status[]" id="status" style="width: 100%" multiple>
                                    <option value="">Select Status</option>

                                    @if(!empty($status))
                                    @foreach($status as $list)
                                    <option value="{{$list->status}}">{{$list->status}}</option>
                                    @endforeach()
                                    @endif()
                                </select>
                            </div>
                            <div class="col-md-4">


                                <label>Select Source</label>
                                <select class="form-control" name="source[]" id="source" style="width: 100%" multiple>
                                    <option value="">Select Source</option>
                                    @if(!empty($source))
                                    @foreach($source as $list)
                                    <option value="{{$list->source}}">{{$list->source}}</option>
                                    @endforeach()
                                    @endif()
                                </select>

                            </div>




                            <div class="col-md-12 " style="margin-top: 20px !important;">
                                <div class="row">

                                    <div class="col-md-4">
                                        <label> Created /Modified</label>

                                        <select class="form-control" name="created" id="created" multiple>
                                            <option value="">Select Created /Modified</option>
                                           
                                            <option value="1" selected>Created</option>
                                            <option value="2">Modified</option>
                                            <option value="3">Not Modified</option>

                                        </select>
                                    </div>





                                    <div class="col-md-4">
                                        <label>From</label>
                                        <input type="date" name="from" id="fromDate" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label>To</label>
                                        <input type="date" name="to" id="toDate" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 " style="margin-top: 20px !important;">
                                <div class="row">
                                <div class="col-md-4 ">
                                        <label> With or without Description</label>
                                        <select class="form-control" name="description" id="description" required >
                                            <option value="">With or without Description</option>
                                            <option value="1" >With Description</option>
                                            <option value="2">Without Description</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                <label>Transfer to </label>
                                <select class="form-control" name="transferto" id="employee" style="width: 100%" >
                                    <option value="">Select Employee</option>

                                    @if(!empty($users))
                                    @foreach($users as $list)
                                    <option value="{{$list->id}}">{{$list->name}}- {{$list->role}}</option>
                                    @endforeach()
                                    @endif()
                                </select>

                            </div>
                                    
                                </div>

                            </div>

                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary " style="margin-top:10px;width:100px;" id="changetext">Extract </button>

                                <a href="{{url('admin/leads')}}" onclick="clearfilter()" style="margin-top:10px;width:100px;" class="btn btn-dark" id="changetext">Clear Filter</a>


                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>

@endif()
















<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Extract Leads</h4>
               
            </div><!-- end card header -->
            @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card-body">
                <div class="live-preview">
                    <div class="table-responsive">
                       

                        <div id="totalcount"></div>

                       

                        
                    </div>
                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>

<!-- Import Modal -->
<div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Leads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="importForm" method="POST" enctype="multipart/form-data" action="{{ route('leads.import') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label">Upload CSV file</label>
                        <input type="file" class="form-control" accept=".xlsx, .xls, .csv" id="file" name="file" required>
                    </div>
                    <div class="processing-message" id="processingMessage">Processing your file, please wait...</div>
                    <button type="submit" class="btn btn-primary">Import</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('admin/js/ajax/extract.js') }}"></script>

<style>
    .table th,

    .table th {
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $('select').selectize({
            plugins: ['remove_button'],
            sortField: 'text'
        });
    });
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

    function makeCall(phone, rowId) {
        const preloader = $('#preloader-' + rowId);

        // Show the preloader when the request starts
        preloader.show();

        // Make the AJAX POST request to the controller
        $.ajax({
            url: '{{route("make-call")}}',
            type: 'POST',
            data: {
                phone: phone,
                _token: $('meta[name="csrf-token"]').attr('content') // CSRF token for security
            },
            dataType: 'json',
            success: function(response) {
                // Hide the preloader after the request is done
                preloader.hide();

                // Display the response message from the server
                if (response.status === 'success') {
                    alert('Call initiated successfully! Message: ' + response.message);
                } else {
                    alert('Error: ' + response.message);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Hide the preloader in case of error
                preloader.hide();

                // Capture the full error message
                alert('Failed to initiate the call. Status: ' + textStatus + '. Error: ' + errorThrown);
            }
        });
    }
</script>


</script>