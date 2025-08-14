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

        top: 1%;
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

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">{{$status ?? ''}} @if($status =='Pending') Approvals @endif()</h4>
                    <div class="flex-shrink-0">
                        <a href="{{url('admin/users/create')}}" class="btn btn-dark  btn-sm">Add new User </a>

                    </div>
                </div><!-- end card header -->

                <div class="card-body" style="overflow: auto;">
                    <div class="live-preview">
                        <div class="">
                            <table id="example" class="table align-middle  mb-0" style="font-size:12px;">
                                <thead>
                                    <tr>
                                        <th data-sort="number">Sr No.  <span class="sort-arrow">&uarr;</span></th>
                                        <th data-sort="string">Unique Id  <span class="sort-arrow">&uarr;</span></th>
                                        <th data-sort="string"> Name  <span class="sort-arrow">&uarr;</span></th>
                                        <th data-sort="string">Email  <span class="sort-arrow">&uarr;</span></th>
                                        <th data-sort="string">Phone  <span class="sort-arrow">&uarr;</span></th>
                                        <th data-sort="string">Role  <span class="sort-arrow">&uarr;</span></th>
                                        <!-- <th data-sort="string">Joinning Date  <span class="sort-arrow">&uarr;</span></th> -->
                                        <!-- <th data-sort="number">Address  <span class="sort-arrow">&uarr;</span></th> -->
                                        <!-- <th data-sort="number">License Cost  <span class="sort-arrow">&uarr;</span></th> -->
                                        <th data-sort="date">Created On  <span class="sort-arrow">&uarr;</span></th>
                                        @if(Auth::user()->role=='admin')
                                        <th data-sort="string">Status  <span class="sort-arrow">&uarr;</span></th>
                                        <th data-sort="string">Action  <span class="sort-arrow">&uarr;</span></th>
                                        @endif()
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($users))
                                    @foreach($users as $key=>$list)
                                    <tr>
                                        <th>{{++$key}}</th>
                                        
                                        <td>
                                        {{$list->unique_id ?? ''}}</td>
                                        <td>{{$list->name ?? ''}}</td>
                                        <!-- <td>{{$list->role ?? ''}}</td> -->
                                        <td>{{$list->email ?? ''}}</td>
                                        <td>{{$list->phone ?? ''}}</td>
                                        <td>{{$list->role ?? ''}}</td>
                                        <!-- <td>{{date('d-m-y' , strtotime($list->joining_date ))}}</td> -->
                                        <!-- <td>{{$list->registered_office ?? ''}}</td> -->
                                        <td>{{date('d-m-y' , strtotime($list->created_at ))}}</td>
                                        @if(Auth::user()->role=='admin')

                                        <td> @if($list->flag==1)

                                            <button class="btn btn-sm " onclick="confirmDelete('{{$list->id}}' ,'deactivate')" style="background-color: green; color:white;">Approved</button>

                                            @else
                                            <button class="btn btn-sm btn-danger" onclick="confirmDelete('{{$list->id}}','activate')"> Approve</button>

                                            @endif()
                                        </td>
                                        <td>

                                            <div class="d-flex gap-2">

                                                @if($list->role =='company_admin')
                                                <!-- <a href="{{url('admin/users/company-admin/mr/'.$list->id)}}" class="btn btn-warning btn-sm">View Mr</a> -->

                                                @endif
                                                <div class="edit">
                                                    <a href="{{url('admin/users/login',$list->id)}}" class="btn btn-sm btn-info edit-item-btn"> Login
                                                    </a>
                                                </div>
                                                <div>
                                                    <button class="btn btn-sm btn-success" data-bs-target="#change_password" data-bs-toggle="modal" onclick="showchangepasswordpopup('{{ $list->id }}', 'users')"><i class="ti ti-key"></i></button>


                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn" onclick="confirmDelete('{{$list->id}}','remove')"><i class=" ti ti-trash"></i></button>
                                                </div>
                                                <div class="edit">
                                                    <a href="{{url('admin/users/edit',$list->id)}}" class="btn btn-sm btn-success edit-item-btn"> <i class="ti ti-edit"></i>
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

        <script src="{{asset('admin/js/ajax/usercreate.js')}}"></script>

        <div class="modal fade zoomIn" id="change_password" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-soft-info p-3">
                        <h5 class="modal-title" id="myModalLabel">Update Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="changepassworddata">
                            <span id="changepassworddiv"></span>
                            @csrf()
                            @method('post')
                            <span class="text-danger error" id="commonerror"></span>
                            <span class=" text-success " id="success"></span>
                            <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn w-sm btn-success " id="delete-record">Update Password</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>

    <script>
        function showchangepasswordpopup(id, table) {
            $.ajax({
                url: "{{ url('admin/users/changepassworddiv')}}" + "/" + id + '/' + table,
                type: 'get',
                cache: true,
                contentType: false,
                processData: false,
                success: function(result) {
                    $("#changepassworddiv").html(result);
                },
            })
        }
        $(document).on('submit', '#changepassworddata', function(ev) {
            $('.error').html('');

            ev.preventDefault(); // Prevent browers default submit.
            var formData = new FormData(this);
            var error = false;

            if (error == false) {
                $.ajax({
                    url: "{{ url('admin/users/updatepassword') }} ",
                    type: 'post',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $(".hstackloader").html('<lord-icon src="https://cdn.lordicon.com/dpinvufc.json" trigger="loop" colors="primary:#4bb543,secondary:#4bb543" style="width:50px;"> </lord-icon>');
                        $(".hstack").css('display', 'none');
                        $(".error").text('');
                    },
                    success: function(result) {
                        if (result.code == 200) {

                            $('#success').html(result.message);
                            setTimeout(() => {
                                window.location.href = window.location.href;

                            }, 1000);

                        } else if (result.code == 401) {
                            $.each(result.message, function(prefix, val) {
                                $('#' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            $('#commonerror').html(result.message);

                        }
                    },
                    error: function(xhr) {
                        $(".hstack").css('display', 'flex');
                    },
                    complete: function() {
                        $(".hstack").css('display', 'flex');
                        $(".hstackloader").text('');
                    },
                })
            }
        })

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