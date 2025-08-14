@extends('admin.layout')
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
    .ff-secondary {
        color: white !important;
    }

    .fw-medium {
        color: white !important;

    }

    .card-body2 {
        background-color: #5d87ff;
        border-bottom: 1px solid #ccc;
        padding: 10px;
        border-radius: 34px;
        height: 158px !important;
    }

    .text-decoration-underline text-white {
        color: black
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

    .card {
        border: 1px solid #ccc;
        border-radius: 8px;
        margin: 20px 0;
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
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@section('content')

@feature('admin_panel')

<div class="row">
    <div class="col-lg-4">
        <!-- card -->
        <div class="card card-animate " style="background-color: #5d87ff;border-radius: 34px;height: 158px;">
            <div class="card-body  ">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium  text-truncate mb-0"> Total Projects </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$lead_count_all ?? 0}}">{{$lead_count_all ?? 0}}</span></h4>
                        <a href="{{route('leads.all')}}" class="text-decoration-underline text-white">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

    </div><!-- end col -->

    <div class="col-lg-4">
        <!-- card -->
        <div class="card card-animate" style="background-color: #5d87ff;border-radius: 34px;height: 158px;">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="text-uppercase fw-medium    text-truncate mb-0"> Total Agents</p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$agent ?? 0}}">{{$agent ?? 0}}</span></h4>
                        <a href="{{url('admin/users/role/agent')}}" class="text-decoration-underline text-white">View </a>
                    </div>

                </div>
            </div><!-- end card body -->
        </div><!-- end card -->

    </div><!-- end col -->



    <div class="col-lg-4 col-md-4">

        <div class="card card-animate">

            <div class="card-body card-body2">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 overflow-hidden">
                        <p class="card-title mb-9 fw-semibold" style="color: white;"> Total Users </p>
                    </div>

                </div>
                <div class="d-flex align-items-end justify-content-between mt-4">
                    <div>
                        <h4 class="fs-22 fw-semibold ff-secondary mb-4 text-dark" style="color: white;"><span class="counter-value" data-target="{{$usertotal ?? 0}}" style="color: white;  font-size:29px;">{{$usertotal ?? 0}}</span></h4>
                        <a href="{{url('admin/users/all')}}" style="color: white !important;" class="text-decoration-underline ">View </a>
                    </div>

                </div>
            </div>
        </div>
    </div>



</div>




@endfeature



<div id="piechart"></div>
<script>
    $(document).ready(function() {
        var leadCount = {{$lead_count_all ?? 0}};
        var agentCount = {{$agent ?? 0}};
        var riskcount = {{$riskcount ?? 0}};

        var options = {
            chart: {
                type: "pie",
                height: 350
            },
            series: [leadCount, agentCount, riskcount], // Now it correctly reads the Laravel value
            labels: ["Total Projects", "Total Agents", "Total Users"], // Categories
            colors: ["#000", "pinke", "#00E396"], // Custom Colors
            legend: {
                position: "bottom"
            }
        };

        var chart = new ApexCharts(document.querySelector("#piechart"), options);
        chart.render();
    });
</script>



@endsection