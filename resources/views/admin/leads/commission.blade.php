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
        /* z-index: 9999; */
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

@if(in_array(Auth::user()->role, ['admin', 'BDE','Manager']))

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Apply Filter</h4>

            </div><!-- end card header -->

            <div class="card-body">
                <form id="companyadmin" method="POST" action="{{ route('filter.leads') }}">
                    @csrf()

                    <div class="live-preview">
                        <div class="row">
                            @if(Auth::user()->role =='admin')
                            <div class="col-md-3">
                                <label>Select Transporter</label>
                                <select class="form-control" name="employee_id[]" id="employee" style="width: 100%" multiple>
                                    <option value="">Select Transporter</option>

                                    @if(!empty($users))
                                    @foreach($users as $list)
                                    <option value="{{$list->id}}">{{$list->name}}- {{$list->role}}</option>
                                    @endforeach()
                                    @endif()
                                </select>

                            </div>
                            @endif()
                            <div class="col-md-3">

                                <label>Select Job Status</label>
                                <select class="form-control" name="status[]" id="status" style="width: 100%" multiple>
                                    <option value="">Select Status</option>

                                    @if(!empty($status))
                                    @foreach($status as $list)
                                    <option value="{{$list->status}}">{{$list->status}}</option>
                                    @endforeach()
                                    @endif()
                                </select>
                            </div>
                            <div class="col-md-3">


                                <label>Select Firm </label>
                                <select class="form-control" name="firm[]" id="source" style="width: 100%" multiple>
                                    <option value="">Select Firm</option>
                                    @if(!empty($firms))
                                    @foreach($firms as $list)
                                    <option value="{{$list->id}}">{{$list->name}}</option>
                                    @endforeach()
                                    @endif()
                                </select>

                            </div>
                            <!-- <div class="col-md-3">
                            <label> Created /Modified</label> -->
                            <input type="hidden" name="created" value="1">

                            <!-- <select class="form-control" name="created" id="created" multiple>
                                <option value="">Select Created /Modified</option>

                                <option value="1" selected>Created</option>

                            </select> -->
                            <!-- </div> -->

                            <div class="col-md-3">
                                <label>Search by Invoice / Vehicle Number</label>
                                <input type="search" name="search" placeholder="Search Lead Id or  mobile number or name" class="form-control">

                            </div>

                            <div class="col-md-9 " style="margin-top: 20px !important;">
                                <div class="row">






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
                            <div class="col-md-2 mt-4" style="margin-top: 40px !important;">


                            </div>
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn btn-primary " style="margin-top:10px;width:100px;" id="changetext">Apply Filter</button>
                                <button type="button" class="btn btn-primary" onclick="exportleads()" style="margin-top:10px;width:100px;" id="exportLeads">Export</button>

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
                <h4 class="card-title mb-0 flex-grow-1">All Jobs</h4>
                <div class="flex-shrink-0">
                    @if(Auth::user()->role =='admin')

                    <a href="{{ route('leads.create') }}" class="btn btn-dark">Add new Job</a>
                    <!-- <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">Import Leads</button>
                    <a href="{{route('leads.sample-excel')}}" class="btn btn-dark btn-sm">Download Sample excel </a> -->

                    @endif()
                </div>
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
                        <button class="scroll-btn" id="scroll-left">&larr;</button>
                        <button class="scroll-btn" id="scroll-right">&rarr;</button>

                        <div id="totalcount"></div>

                        <table class="table table-bordered  mb-0">
                            <thead>
                                <tr>
                                <th data-sort="date">Created On <span class="sort-arrow">&uarr;</span></th>
                                <th data-sort="string">Invoice Number<span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Firm Name <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Commission <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Vehicle Number <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Total <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Advance Done By <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Remaining Payment Status <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Hold Status <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Job Status <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Action <span class="sort-arrow">&uarr;</span></th>
                                </tr>
                            </thead>
                            <tbody id="appendleads">

                                @if(!empty($leads))
                                @foreach($leads as $index => $list)
                                <tr id="lead-row-{{ $list->id }}">
                                <td>{{ date('d-m-y', timestamp: strtotime($list->created_at)) }}</td>
                                <td>{{ $list->invoicenumber ?? '' }}</td>
                                    <td>{{ $list->firms->name ?? '' }}</td>
                                    <td> ₹ <span style="color:blue">{{ $list->commission ?? ''}}</span></td>
                                    <td>{{ $list->truck_no ?? '' }}</td>

                                    <td>Total : ₹ {{$list->total ??  ''}} </br>
                                        ------
                                        Advance : ₹ {{$list->advance ?? 0}}
                                    </td>
                                    <td>
                                        {{$list->advanceby ?? ''}}
                                        /
                                        {{$list->advancebyname ?? ''}}


                                    </td>
                                    <td><span class="@if($list->payment_status == 'Pending')
                                    {{'text-warning'}}
                                        
                                    @else   {{'text-success'}}  @endif">{{ $list->payment_status ?? '' }}</span></br>
                                    ------</br>
                                   ₹ {{ $list->remaining ?? '' }}

                                    <a href="{{route('leads.updatepayment',$list->id)}}" class="btn btn-dark btn-sm"><i class="ti ti-pencil"></i></a>

                                    </br>
                                        @if(!empty($list->holder) || !empty($list->ifsc) || !empty($list->account_number) || !empty($list->bankname))
                                        <span class="text-success"> Bank Detail uploaded</span>
                                        @endif


                                    </td>
                                    <td><span class="@if($list->hold_amount_status == 'Pending')
                                    {{'text-warning'}}
                                        
                                    @else   {{'text-success'}}  @endif"> {{ $list->hold_amount_status ?? '' }}</span></br>
                                    ------</br>
                                   ₹ {{ $list->hold_amount ?? '' }}


                                    <a href="{{route('leads.holdamountstatus',$list->id)}}" class="btn btn-dark btn-sm"><i class="ti ti-pencil"></i></a>

                                        @if(!empty($list->proof))
                                          <span class="text-success">   Proof Uploaded</span>
                                        @endif()




                                    </td>
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

                                    <td style="align-items: end; text-align:end;">

                                        @if (Auth::user()->role=='Transporter')
                                        <!--<span class="btn btn-info btn-sm " data-bs-target="#updateStatus" onclick="updateLeadStatus('{{ $list->id }}')" data-bs-toggle="modal"><i class="ti ti-edit"></i></span><br>-->
                                        

                                        @else
                                        <div class="d-flex gap-2">
                                            <!-- <div class="edit">
                                                <a href="#">
                                                    <img src="{{asset('admin/images/whatsapp.png')}}" width="25px" height="25px">
                                                </a>
                                            </div>
                                            <div class="edit">
                                                <a href="javascript:void(0)" onclick="makeCall('{{ $list->phone }}', '{{ $list->id }}')">
                                                    <img src="{{asset('admin/images/phone-call.png')}}" width="23px" height="23px">
                                                </a>
                                            </div> -->
                                            @if(Auth::user()->role=='admin')
                                            <div class="remove">
                                                <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete('{{ $list->id }}','remove')">
                                                    <i class="ti ti-trash"></i>
                                                </button>
                                            </div>
                                            @endif()
                                            
                                            <div class="edit">
                                                <a href="{{ url('admin/leads/edit', $list->id) }}" class="btn btn-sm btn-success edit-item-btn">
                                                    <i class="ti ti-pencil"></i>
                                                </a>
                                            </div>
                                           
                                            @endif()
                                            
                                        </div>
                                         <div class="edit">
                                                <a href="{{ url('admin/leads/invoice', $list->id) }}" class="btn btn-sm btn-dark edit-item-btn">
                                                    <i class="ti ti-printer"></i>
                                                </a>
                                            </div>

                                        <!-- Preloader -->
                                        <div class="preloader" id="preloader-{{ $list->id }}" style="display: none;">
                                            <p>Loading....</p>
                                        </div>
                                    </td>
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
        </div><!-- end card -->
    </div><!-- end col -->
</div>

<div class="modal fade zoomIn" id="updateStatus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-soft-info p-3">
                <h5 class="modal-title" id="myModalLabel">Update Job</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
            </div>
            <div class="modal-body">
                <form method="post" id="updateStatusLead2">
                    <span id="updateStatusLead"></span>
                    @csrf()
                    @method('post')
                    <span class="text-danger error" id="commonerror"></span>
                    <span class=" text-success " id="success"></span>


                </form>
            </div>
        </div>
    </div>
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

<script src="{{ asset('admin/js/ajax/leads.js') }}"></script>

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
    function exportleads() {
        var form = document.getElementById('companyadmin');
        form.action = "{{ route('leads.export') }}";
        form.submit();
    }


    $(document).ready(function() {
        $('select').selectize({
            plugins: ['remove_button'],
            sortField: 'text'
        });
    });





    function updateLeadStatus(id) {
        $.ajax({
            url: "{{ url('admin/leads/updatestatus')}}" + "/" + id,
            type: 'get',
            cache: true,
            contentType: false,
            processData: false,
            success: function(result) {
                $("#updateStatusLead").html(result);
            },
        })
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


</script>