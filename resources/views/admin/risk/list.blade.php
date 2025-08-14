@extends('admin.layout')
@section('content')
<style>
    table thead {
        background-color: black;
        color: white;
    }

    .error {
        color: red !important;
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

<div class="row">



<!-- leads import -->

@if(in_array(Auth::user()->role, ['admin', 'Compliance']))

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Apply Filter</h4>

            </div><!-- end card header -->

            <div class="card-body">
                <form id="companyadmin" method="POST" action="{{ route('filter.riskassesment') }}">
                    @csrf()

                    <div class="live-preview">
                        <div class="row">
                            
                          
                            <div class="col-md-6">
                                <label>Search Mobile or Email Id</label>
                                <input type="search" name="search" placeholder="Serch Email Id and mobile number" class="form-control">

                            </div>
                            
                          
                         
                            <div class="col-md-6 text-center">
                            <button type="submit" class="btn btn-primary mt-3 "  id="changetext">Apply Filter</button>

                            <a href="{{url('admin/risk-assement')}}" onclick="clearfilter()"  class="btn btn-dark mt-3" id="changetext">Clear Filter</a>

                                
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
                    <h4 class="card-title mb-0 flex-grow-1">All Risk Assesment</h4>
                    <div class="flex-shrink-0">
                        <a href="{{route('risk.create')}}" class="btn btn-dark  btn-sm">Add Risk Assesment </a>

                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0" style=" font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th data-sort="number">SNO <span class="sort-arrow">&uarr;</span></th>
                                        <!-- <th>Company name <span class="sort-arrow">&uarr;</span></th> -->
                                        <th data-sort="string"> Name <span class="sort-arrow">&uarr;</span></th>
                                        <th data-sort="string">Email <span class="sort-arrow">&uarr;</span></th>
                                        <th data-sort="string">Phone <span class="sort-arrow">&uarr;</span></th>
                                        <th data-sort="string">Assese Name <span class="sort-arrow">&uarr;</span></th>
                                        <th data-sort="string">Risk Score <span class="sort-arrow">&uarr;</span></th>
                                        <!-- <th data-sort="string">License Cost <span class="sort-arrow">&uarr;</span></th> -->
                                        <th data-sort="string">Risk Type <span class="sort-arrow">&uarr;</span></th>
                                        <th data-sort="date">Created On <span class="sort-arrow">&uarr;</span></th>
                                          @if(in_array(Auth::user()->role, ['admin', 'Compliance']))

                                        <th data-sort="string">Download <span class="sort-arrow">&uarr;</span></th>

                                        <th data-sort="string">Action <span class="sort-arrow">&uarr;</span></th>
                                        
                                        @endif()

                                    </tr>
                                </thead>
                                <tbody id="appendleads">
                                    @if(!empty($riskmodel))
                                    @foreach($riskmodel as $key=>$list)
                                    <tr>
                                        <th>{{++$key}}</th>
                                        <td>{{$list->name ?? ''}}</td>
                                        <td>{{$list->email ?? ''}}</td>
                                        <td>{{$list->phone ?? ''}}</td>
                                        <td>{{$list->assess_name ?? ''}}</td>
                                        <td>{{$list->totalpoints ?? ''}}</br></br>
                                        <a href="{{route('downloadscore',$list->id)}}" class="btn btn-sm btn-success edit-item-btn"> <i class="ti ti-eye"></i>
                                        </a>
                                    
                                    </td>
                                        <td>
                                            @if($list->riskfactor =='Low Risk')
                                            @php
                                            $color = 'success';
                                            @endphp
                                            @elseif($list->riskfactor =='Medium Risk')
                                            @php
                                            $color = 'warning';
                                            @endphp
                                            @else
                                            @php
                                            $color = 'danger';
                                            @endphp

                                            @endif()
                                            <span class="text-{{$color}}">{{$list->riskfactor ?? ''}}</span>



                                        </td>
                                        <td>{{date('d-m-y h:i:s a' , strtotime($list->created_at ))}}</td>
                                                                                    @if(in_array(Auth::user()->role, ['admin', 'Compliance']))

                                        <td>
                                            @if($list->service==1)
                                            <a href="{{route('risk-assement-download',$list->id)}}" class="btn btn-primary btn-sm"> PDF</a>
                                            </br>
                                            <a href="{{route('viewserviceaggrement',$list->id)}}">View Service aggrement</a>
                                            @else
                                            <a href="{{url('admin/serviceagreement/create/'.$list->id)}}" class="btn btn-primary btn-sm">+ Service Aggrement</a>


                                            @endif()


                                        </td>

                                        <td style="align-items: end; text-align:end;">

                                            <div class="d-flex gap-2">

                                            <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete('{{$list->id}}','remove')"><i class="ti ti-trash"></i></button>
                                                </div>
                                               
                                                <div class="edit">
                                                    <a href="{{url('admin/risk-assement/edit',$list->id)}}" class="btn btn-sm btn-success edit-item-btn"> <i class="ti ti-pencil"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        </td>
                                                                                     @endif()



                                    </tr>
                                    @endforeach()
                                    @endif()

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->

        <script src="{{asset('admin/js/ajax/risk.js')}}"></script>

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

    </div>

    @endsection


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>