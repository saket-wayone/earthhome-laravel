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
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
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

    .table th, .table td {
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
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Payment</h4>
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
            <div class="card-body">
                <div class="live-preview">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" id="leaderboard">
                            <thead>
                                <tr>
                                    <th data-sort="number">SNO <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Lead Id <span class="sort-arrow">&uarr;</span></th>
                                      <th data-sort="string">Phase Name<span class="sort-arrow">&uarr;</span></th>

                                    <th data-sort="string"> Add By <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Payment <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Balance <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Status <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="date">Created On <span class="sort-arrow">&uarr;</span></th>
                                    <th data-sort="string">Action <span class="sort-arrow">&uarr;</span></th>
                                </tr>
                            </thead>
                            <tbody id="appendleads">
                                @if(!empty($quotations))
                                @foreach($quotations as $keys => $list)
                                <tr>
                                    <th>{{ ++$keys }}</th>
                                    <td>
                                        
                                        @if(!empty($list->leadInfo->unique_id))
                                        <a href="{{ url('admin/leads/edit', $list->leadInfo->id) }}">{{ $list->leadInfo->unique_id ?? '' }}</a></br>
                                       
                                        <a href="{{ url('admin/leads/edit', $list->leadInfo->id) }}">{{ $list->leadInfo->name ?? '' }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $list->phasename->phase_name ?? '' }}</br>
                                    Overall Cost:   ₹ <b style="color:blue;">   {{ $list->phasename->total_amount ?? '' }}</b>
                                        
                                    </td>
                                    <td>
                                        @php 
                                            $userinfo = DB::table('users')->where('id', $list->add_by)->first();
                                        @endphp
                                        {{ $userinfo->name ?? '' }} - {{ $userinfo->role ?? '' }}
                                    </td>
                                    <td> ₹ {{ $list->amount ?? '' }}</td>
                                    <td> ₹ {{ $list->balance ?? '' }}</td>
                                    <td>
                                        @php
                                            $color = 'warning';
                                            if($list->status == 1) {
                                                $color = 'success';
                                                $message = 'Approved';
                                            } elseif($list->status == 2) {
                                                $color = 'danger';
                                                 $message = 'Declined';

                                            }else{
                                               $color = 'info';
                                               $message = 'Pending';


                                            }
                                        @endphp
                                        <span class="btn btn-{{ $color }} btn-sm">{{ $message ?? '' }}</span><br>
                                        @if($list->status != 0)
                                            <span class="mt-4">
                                                {{ date('d-m-y', strtotime($list->approved_or_reject_date)) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ date('d-m-y', strtotime($list->created_at)) }}</td>
                                    <td style="align-items: end; text-align: end;">
                                        <div class="d-flex gap-2">
                                            @if(Auth::user()->role == 'admin')
                                                @if($list->status == 0)
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-info remove-item-btn" onclick="confirmDelete('{{ $list->id }}','approve')">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </div>
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete('{{ $list->id }}','declined')">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                @elseif($list->status == 1)
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete('{{ $list->id }}','declined')">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                @elseif($list->status == 2)
                                                    <div class="remove">
                                                        <button class="btn btn-sm btn-info remove-item-btn" onclick="confirmDelete('{{ $list->id }}','approve')">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete('{{ $list->id }}','removes')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('admin/js/ajax/leads.js') }}"></script>
<style>
    .table th, .table td {
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
