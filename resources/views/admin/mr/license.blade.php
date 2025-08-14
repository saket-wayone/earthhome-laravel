<div id="anothercontent">

@extends('admin.layout')
@section('content')
<style>
    table thead {
        background-color: black;
        color: white;
    }
</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="row">

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">All Licenses</h4>
                    <div class="flex-shrink-0">
                        <a href="{{route('mr.history')}}" class="btn btn-dark  btn-sm">Purchased New License </a>

                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th>License Code</th>
                                        <th>Expiry Date</th>

                                        <th>Purchased On</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(!empty($purchasedplan))
                                    @foreach($purchasedplan as $key=>$listing)
                                    <tr>
                                        <th>{{++$key}}</th>
                                        <td>{{$listing->unique_code ?? ''}}</td>
                                        <td>{{$listing->expiry_date ?? ''}} </td>
                                        <td>{{$listing->created_at ?? ''}} </td>

                                    </tr>
                                    @endforeach
                                    @endif


                                </tbody>
                            </table>
                        </div>
                    </div>


                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->

        <script src="{{asset('admin/js/ajax/usercreate.js')}}"></script>


    </div>




    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Monthly</h4>
                    <div class="flex-shrink-0">
                        <button  type="button" id="renewButton" class="btn btn-dark  btn-sm">Renew </button>

                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th style="display: flex;gap: 8px;" ><input type="checkbox" id="selectAll" style="scale: 1.3;">Select</th>

                                        <th>License Code</th>
                                        <th>Expiry Date</th>

                                        <th>Purchased On</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(!empty($monthly))
                                    @foreach($monthly as $key=>$listing)
                                    <tr>
                                        <th>{{++$key}}</th>
                                        <th><input type="checkbox"  class="selectItem" value="{{$listing->id}}"  style="scale: 1.3;"></th>

                                        <td>{{$listing->unique_code ?? ''}}</td>
                                        <td>{{$listing->expiry_date ?? ''}} </td>
                                        <td>{{$listing->created_at ?? ''}} </td>

                                    </tr>
                                    @endforeach
                                    @endif


                                </tbody>
                            </table>
                        </div>
                    </div>


                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->

        <script src="{{asset('admin/js/ajax/usercreate.js')}}"></script>


    </div>





    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Half Yearly</h4>
                    <div class="flex-shrink-0">
                        <button type="button" id="renewButton1" class="btn btn-dark  btn-sm">Renew </button>

                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th style="display: flex;gap: 8px;"><input id="selectAll1" type="checkbox"  style="scale: 1.3;">Select</th>
                                        <th>License Code</th>
                                        <th>Expiry Date</th>

                                        <th>Purchased On</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(!empty($halfyearly))
                                    @foreach($halfyearly as $key=>$listing)
                                    <tr>
                                        <th>{{++$key}}</th>
                                        <th><input type="checkbox" class="selectItem1"  value="{{$listing->id}}"  style="scale: 1.3;"></th>
                                        <td>{{$listing->unique_code ?? ''}}</td>
                                        <td>{{$listing->expiry_date ?? ''}} </td>
                                        <td>{{$listing->created_at ?? ''}} </td>

                                    </tr>
                                    @endforeach
                                    @endif


                                </tbody>
                            </table>
                        </div>
                    </div>


                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->

        <script src="{{asset('admin/js/ajax/usercreate.js')}}"></script>


    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Annual</h4>
                    <div class="flex-shrink-0">
                        <button  type="button" id="renewButton2" class="btn btn-dark  btn-sm">Renew </button>

                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <div class="table-responsive">
                            <table class="table align-middle table-nowrap mb-0">
                                <thead>
                                    <tr>
                                        <th>SNO</th>
                                        <th style="display: flex;gap: 8px;"><input   id="selectAll2" type="checkbox" style="scale: 1.3;">Select</th>

                                        <th>License Code</th>
                                        <th>Expiry Date</th>

                                        <th>Purchased On</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(!empty($annual))
                                    @foreach($annual as $key=>$listing)
                                    <tr>
                                        <th>{{++$key}}</th>
                                        <th><input type="checkbox" class="selectItem2"  value="{{$listing->id}}" style="scale: 1.3;"></th>

                                        <td>{{$listing->unique_code ?? ''}}</td>
                                        <td>{{$listing->expiry_date ?? ''}} </td>
                                        <td>{{$listing->created_at ?? ''}} </td>

                                    </tr>
                                    @endforeach
                                    @endif


                                </tbody>
                            </table>
                        </div>
                    </div>


                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->

        <script src="{{asset('admin/js/ajax/usercreate.js')}}"></script>


    </div>

    <script>
    $(document).ready(function() {
        // Select/Deselect all checkboxes
        $('#selectAll').change(function() {
            $('.selectItem').prop('checked', $(this).prop('checked'));
        });

        // Renew button click event
        $('#renewButton').click(function() {
            var selectedIds = [];
            $('.selectItem:checked').each(function() {
                var id = $(this).val(); // Assuming the ID is in the value attribute
                selectedIds.push(id);
            });

            if (selectedIds.length === 0) {
                alert("Please select at least one item to renew.");
                return;
            }

            // Get CSRF token
            var csrfToken = '{{ csrf_token() }}';

            // Send selected item IDs via AJAX
            $.ajax({
                type: 'POST',
                url: '{{ route("renew") }}', // Change the route to your renewal route
                data: { ids: selectedIds, _token: csrfToken ,'type':'Monthly' }, // Pass CSRF token and selected IDs
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Pass CSRF token in headers
                },
                success: function(response) {
                    // Handle success response
                    window.location.href="{{route('renew2')}}";
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });




        $('#selectAll1').change(function() {
            $('.selectItem1').prop('checked', $(this).prop('checked'));
        });

        // Renew button click event
        $('#renewButton1').click(function() {
            var selectedIds = [];
            $('.selectItem1:checked').each(function() {
                var id = $(this).val(); // Assuming the ID is in the value attribute
                selectedIds.push(id);
            });

            if (selectedIds.length === 0) {
                alert("Please select at least one item to renew.");
                return;
            }

            // Get CSRF token
            var csrfToken = '{{ csrf_token() }}';

            // Send selected item IDs via AJAX
            $.ajax({
                type: 'POST',
                url: '{{ route("renew") }}', // Change the route to your renewal route
                data: { ids: selectedIds, _token: csrfToken ,'type':'Half Yearly' }, // Pass CSRF token and selected IDs
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Pass CSRF token in headers
                },
                success: function(response) {
                    // Handle success response
                    window.location.href="{{route('renew2')}}";
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });



        $('#selectAll2').change(function() {
            $('.selectItem2').prop('checked', $(this).prop('checked'));
        });

        // Renew button click event
        $('#renewButton2').click(function() {
            var selectedIds = [];
            $('.selectItem2:checked').each(function() {
                var id = $(this).val(); // Assuming the ID is in the value attribute
                selectedIds.push(id);
            });

            if (selectedIds.length === 0) {
                alert("Please select at least one item to renew.");
                return;
            }

            // Get CSRF token
            var csrfToken = '{{ csrf_token() }}';

            // Send selected item IDs via AJAX
            $.ajax({
                type: 'POST',
                url: '{{ route("renew") }}', // Change the route to your renewal route
                data: { ids: selectedIds, _token: csrfToken ,'type':'Annual' }, // Pass CSRF token and selected IDs
                headers: {
                    'X-CSRF-TOKEN': csrfToken // Pass CSRF token in headers
                },
                success: function(response) {
                    // Handle success response
                    window.location.href="{{route('renew2')}}";
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

    @endsection

</div>