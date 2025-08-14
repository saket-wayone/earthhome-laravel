@extends('admin.layout')


@section('content')

@feature('admin_panel')

<div class="row">
    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Users </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$company_admin ?? 0}}">{{$company_admin ?? 0}}</span></h4>
                        <a href="{{url('admin/users/all')}}" class="text-decoration-underline">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Activated Users </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$riskcount ?? 0}}">{{$approved ?? 0}}</span></h4>
                        <a href="{{url('admin/users/status/approved')}}" class="text-decoration-underline">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Pending Users </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$notapproved ?? 0}}">{{$notapproved ?? 0}}</span></h4>
                        <a href="{{url('admin/users/status/notapproved')}}" class="text-decoration-underline">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->


</div>
@endfeature

@feature('company_pannel')
<div class="row">
    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Books </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$bookscount ?? 0}}">{{$bookscount ?? 0}}</span></h4>
                        <a href="{{route('books.all')}}" class="text-decoration-underline">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Managers</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$managercount ?? 0}}">{{$managercount ?? 0}}</span></h4>
                        <a href="{{url('admin/users/second/manager')}}" class="text-decoration-underline">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->

    <div class="col-xl-3 col-md-6">
        <!-- card -->
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total MR </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$mrcount ?? 0}}">{{$mrcount ?? 0}}</span></h4>
                        <a href="{{url('admin/mr')}}" class="text-decoration-underline">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->



</div>


@endfeature



@endsection