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

















<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">All Sales</h4>

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

                        <div id="totalcount" class="alert alert-info">TOTAL SALES: ₹ {{$topFiveSalesSum ?? 0}} </div>

                        <table class="table table-bordered  mb-0">
                            <thead>
                                <tr>
                                    <th data-sort="number">SNO <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Employee Name<span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Payment <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Date <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Client <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">View <span class="sort-arrow">&uarr;</span></th>

                                </tr>
                            </thead>
                            <tbody id="appendleads">

                                @if(!empty($paymentlist))
                                @foreach($paymentlist as $index => $list)
                                <tr>
                                    <th>{{ ($paymentlist->currentPage() - 1) * $paymentlist->perPage() + $index + 1 }}</th>
                                    <td>{{ $list->ename ?? '' }}</td>
                                    <td>{{ $list->payment ?? '' }}</td>
                                    <td>{{ $list->created_at ?? '' }}</td>
                                    <td><span style="color:blue">{{ $list->name ?? '' }}</br>
                                    {{$list->ucode ?? ''}}
                                    </span>
                                </td>
                                    <td><span style="color:blue">
                                        <a href="{{ url('admin/leads/edit', $list->lead_id) }}" class="btn btn-primary btn-sm">View </a></span></td>

                                </tr>
                                @endforeach

                                @endif
                            </tbody>

                        </table>

                        <div class="d-flex justify-content-end mt-2 ">

                            @if(!empty($topFiveSales))
                            {{$topFiveSales->links()}}
                            @endif()
                        </div>

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
</script>


</script>