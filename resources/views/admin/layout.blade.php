<!doctype html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Earth Home | CRM</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('admin/images/Earth-home.png') }}" />
    <link rel="stylesheet" href="{{asset('adminui/css/styles.min.css')}}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <style>
        .internal a {
            margin-left: 40px !important;
        }

        .brand-logo {
            min-height: 70px;
            margin-left: 39px;
            padding: 0 24px;

        }

        .selfcircle {


            border: 2px solid #1a4cdc;
            width: 29px;
            background: #1a4cdc;
            text-align: center;
            border-radius: 50%;
        }


        * {
            font-weight: 800;
        }

        .table th,
        .table th {
            font-weight: 800;

        }
    </style>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.default.min.css">

</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar" style="
    background: #437796;
    color: white;
">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="{{url('/')}}" class="text-nowrap logo-img">
                        <img src="{{ asset('admin/images/Earth-home.png') }}" width="170" alt="" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                        </li>
                        @switch(Auth::user()->role)
                        @case('admin')

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{url('/')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class=" ti ti-users"></i>
                                <b>Users </b></span>
                            </a>
                            <div class="collapse  menu-dropdown" id="sidebarApps">
                                <ul class="nav nav-sm flex-column">
                                    <li class="sidebar-item internal">
                                        <a href="{{url('admin/users/all')}}" class="sidebar-link" data-key="t-calendar">





                                            All </a>
                                    </li>
                                    <!-- <li class="sidebar-item">
                                        <a href="{{url('admin/users/create')}}" class="sidebar-link" data-key="t-chat"> Create New Users </a>
                                    </li> -->
                                    <!-- <li class="sidebar-item">
                                        <a href="{{url('admin/users/status/notapproved')}}" class="sidebar-link" data-key="t-chat"> New Company approval request </a>
                                    </li> -->

                                    <!-- <li class="sidebar-item internal">
                                        <a href="{{url('admin/users/status/approved')}}" class="sidebar-link" data-key="t-chat"> Activated Employees </a>
                                    </li> -->



                                    @php
                                    $roles = DB::table('plantype')->get();


                                    @endphp
                                    {{-- @if(!empty( $roles))
                                    @foreach($roles as $rolelist)
                                    <li class="sidebar-item internal">
                                        <a href="{{url('admin/users/role/'.Str::slug($rolelist->name))}}" class="sidebar-link" data-key="t-calendar"> {{$rolelist->name ?? ''}} </a>
                        </li>

                        @endforeach()


                        @endif()
                        --}}

                        <!-- <li class="sidebar-item">
                                        <a href="#roles" class="sidebar-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="roles" data-key="t-calender">
                                            <i class=" ti ti-users"></i> Roles
                                        </a>
                                        <div class="menu-dropdown collapse" id="roles" style="">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="sidebar-item internal">
                                                    <a href="{{route('plans.all')}}" class="sidebar-link" data-key="t-main-calender">All Roles</a>
                                                </li>
                                                <li class="sidebar-item internal">
                                                    <a href="{{route('plans.create')}}" class="sidebar-link" data-key="t-month-grid">Create New Role</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li> -->











                    </ul>

            </div>
            </li>



            <li class="sidebar-item">
                <a class="sidebar-link menu-link" href="#agents" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="agents">
                    <i class=" ti ti-users"></i>
                    <b>Agents </b></span>
                </a>
                <div class="collapse  menu-dropdown" id="agents">
                    <ul class="nav nav-sm flex-column">
                        <li class="sidebar-item internal">
                            <a href="{{url('admin/users/role/agent')}}" class="sidebar-link" data-key="t-calendar">
                                All </a>
                        </li>








                    </ul>

                </div>
            </li>



            <li class="sidebar-item">
                <a class="sidebar-link menu-link" href="#source" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="source">
                    <i class="ti ti-source-code"></i> <span data-key="t-apps">Category</span>
                </a>
                <div class="collapse   menu-dropdown" id="source">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item internal">
                            <a href="{{route('source.all')}}" class="sidebar-link" data-key="t-calendar">


                                All </a>
                        </li>





                    </ul>
                </div>
            </li>


            <!-- <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('lead.payments')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Payment Received</span>
                            </a>
                        </li> -->
            <li class="sidebar-item">
                <a class="sidebar-link menu-link" href="#leads" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="leads">
                    <i class="ti ti-circles"></i> <span data-key="t-apps">Projects </span>
                </a>
                <div class="collapse   menu-dropdown" id="leads">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item internal">
                            <a href="{{route('leads.all')}}" class="sidebar-link" data-key="t-calendar">All Projects </a>
                        </li>
                        <li class="nav-item internal">
                            <a href="{{route('leads.create')}}" class="sidebar-link" data-key="t-calendar">New Project </a>
                        </li>





                    </ul>
                </div>
            </li>
             <li class="sidebar-item">
                <a class="sidebar-link menu-link" href="#banners" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="banners">
                    <i class="ti ti-circles"></i> <span data-key="t-apps">Banners </span>
                </a>
                <div class="collapse   menu-dropdown" id="banners">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item internal">
                            <a href="{{route('banners.all')}}" class="sidebar-link" data-key="t-calendar">All Banners </a>
                        </li>
                        <li class="nav-item internal">
                            <a href="{{route('banners.create')}}" class="sidebar-link" data-key="t-calendar">New Banner </a>
                        </li>





                    </ul>
                </div>
            </li>
            <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('users.feedbacks')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-users"></i>
                                </span>
                                <span class="hide-menu">Customer Feedback</span>
                            </a>
                        </li>


            <!-- <li class="sidebar-item">
                            <a class="sidebar-link menu-link" href="#invoices" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="invoices">
                                <i class=" ti ti-file-description"></i> <span data-key="t-apps">Invoices </span>
                            </a>
                            <div class="collapse   menu-dropdown" id="invoices">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item internal">
                                        <a href="{{route('invoices.all')}}" class="sidebar-link" data-key="t-calendar">
                                            All </a>
                                    </li>
                                    <li class="sidebar-item internal">
                                        <a href="{{route('invoices.create')}}" class="sidebar-link" data-key="t-chat"> Create</a>
                                    </li>
                                    
                 






                                </ul>
                            </div>
                        </li> -->


            <!-- <li class="sidebar-item">
                            <a class="sidebar-link menu-link" href="#riskassement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="riskassement">
                                <i class=" ti ti-file-description"></i> <span data-key="t-apps">Projects </span>
                            </a>
                            <div class="collapse   menu-dropdown" id="riskassement">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item internal">
                                        <a href="{{route('projects.all')}}" class="sidebar-link" data-key="t-calendar">


                                            All </a>
                                    </li>
                                    <li class="sidebar-item internal">
                                        <a href="{{route('risk.create')}}" class="sidebar-link" data-key="t-chat"> Ongoing</a>
                                    </li>
                                    

                                    <li class="sidebar-item internal">
                                        <a href="{{route('risk.create')}}" class="sidebar-link" data-key="t-chat"> Completed</a>
                                    </li>
                                    






                                </ul>
                            </div>
                        </li> -->
            <!-- <li class="sidebar-item">
                            <a class="sidebar-link menu-link" href="#riskassement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="riskassement">
                                <i class=" ti ti-file-description"></i> <span data-key="t-apps">Risk Assesment </span>
                            </a>
                            <div class="collapse   menu-dropdown" id="riskassement">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item internal">
                                        <a href="{{route('risk.all')}}" class="sidebar-link" data-key="t-calendar">


                                            All </a>
                                    </li>
                                    <li class="sidebar-item internal">
                                        <a href="{{route('risk.create')}}" class="sidebar-link" data-key="t-chat"> Create New </a>
                                    </li>
                                    






                                </ul>
                            </div>
                        </li> -->
            <!-- <li class="sidebar-item">
                            <a class="sidebar-link menu-link" href="#status" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="status">
                                <i class="ti ti-playstation-triangle"></i> <span data-key="t-apps">Modify Status </span>
                            </a>
                            <div class="collapse   menu-dropdown" id="status">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item internal">
                                        <a href="{{route('status.all')}}" class="sidebar-link" data-key="t-calendar">


                                            All </a>
                                    </li>
                                    <li class="sidebar-item internal">
                                        <a href="{{route('status.create')}}" class="sidebar-link" data-key="t-chat"> Create New </a>
                                    </li>






                                </ul>
                            </div>
                        </li> -->



            <!--<li class="sidebar-item">-->
            <!--    <a class="sidebar-link" href="{{route('leads.assign')}}" aria-expanded="false">-->
            <!--        <span>-->
            <!--            <i class="ti ti-road-sign"></i>-->
            <!--        </span>-->
            <!--        <span class="hide-menu">Assign Jobs </span>-->
            <!--    </a>-->
            <!--</li>-->


            <!-- <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('leads.extract')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-road-sign"></i>
                                </span>
                                <span class="hide-menu">Extract Leads </span>
                            </a>
                        </li>

                        <li class="sidebar-item">
                            <a class="sidebar-link" href="{{route('leads.pool')}}" aria-expanded="false">
                                <span>
                                    <i class="ti ti-circles"></i>
                                </span>
                                <span class="hide-menu">Pool Leads </span>
                            </a>
                        </li> -->



            @break
            @case('Compliance')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('/') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <!-- <li class="sidebar-item">
                            <a class="sidebar-link menu-link" href="#riskassement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="riskassement">
                                <i class=" ti ti-file-description"></i> <span data-key="t-apps">Risk Assesment </span>
                            </a>
                            <div class="collapse   menu-dropdown" id="riskassement">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item internal">
                                        <a href="{{url('admin/risk-assement')}}" class="sidebar-link" data-key="t-calendar">
                                            All </a>
                                    </li>
                                    <li class="sidebar-item internal">
                                        <a href="{{url('admin/risk-assement/create')}}" class="sidebar-link" data-key="t-chat"> Create New </a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->

            <!-- <li class="sidebar-item">
                            <a class="sidebar-link menu-link" href="#servciceaggerement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="servciceaggerement">
                                <i class=" ti ti-file-description"></i> <span data-key="t-apps">Agreement </span>
                            </a>
                            <div class="collapse   menu-dropdown" id="servciceaggerement">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item internal">
                                        <a href="{{route('serviceagreement.all')}}" class="sidebar-link" data-key="t-calendar">
                                            Service Agreement </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li> -->

            @break

            @case('Manager')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('/') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('manager.team') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-users"></i>
                    </span>
                    <span class="hide-menu">My Team</span>
                </a>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('leads.assigned')}}" aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">All Leads</span>
                </a>
            </li>



            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('leads.assigned.today')}}" aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Today Contact</span><span class="selfcircle"> {{getLeadsCount('today')}}</span>
                </a>
            </li>








            <!-- <li class="sidebar-item">
                            <a class="sidebar-link menu-link" href="#servciceaggerement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="servciceaggerement">
                                <i class=" ti ti-file-description"></i> <span data-key="t-apps">Agreement </span>
                            </a>
                            <div class="collapse   menu-dropdown" id="servciceaggerement">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item internal">
                                        <a href="{{route('serviceagreement.all')}}" class="sidebar-link" data-key="t-calendar">
                                            Service Agreement </a>
                                    </li>
                                    
                                </ul>
                            </div>
                        </li> -->

            @break

            @case('BDE')
            @case('Senior BDE')
            @case('Transporter')
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ url('/') }}" aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <!-- <li class="sidebar-item">
                            <a class="sidebar-link menu-link" href="#bdeRiskAssesment" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="bdeRiskAssesment">
                                <i class=" ti ti-file-description"></i> <span data-key="t-apps">Risk Assesment </span>
                            </a>
                            <div class="collapse   menu-dropdown" id="bdeRiskAssesment">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item internal">
                                        <a href="{{url('admin/risk-assement')}}" class="sidebar-link" data-key="t-calendar">
                                            All </a>
                                    </li>
                                    <li class="sidebar-item internal">
                                        <a href="{{url('admin/risk-assement/create')}}" class="sidebar-link" data-key="t-chat"> Create New </a>
                                    </li>
                                </ul>
                            </div>
                        </li> -->

            <!-- <li class="sidebar-item">
                            <a class="sidebar-link menu-link" href="#riskassement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="riskassement">
                                <i class=" ti ti-circles"></i> <span data-key="t-apps"> Leads </span>
                            </a>
                            <div class="collapse   menu-dropdown" id="riskassement">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item internal">
                                        <a href="{{route('leads.assigned')}}" class="sidebar-link" data-key="t-calendar">
                                            All </a>
                                    </li>
                                  
                                </ul>
                            </div>
                        </li> -->
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('leads.assigned')}}" aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">All Jobs</span>
                </a>
            </li>



            <li class="sidebar-item">
                <a class="sidebar-link" href="{{route('leads.assigned.today')}}" aria-expanded="false">
                    <span>
                        <i class="ti ti-layout-dashboard"></i>
                    </span>
                    <span class="hide-menu">Today Jobs</span><span class="selfcircle"> {{getLeadsCount('today')}}</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link menu-link" href="#servciceaggerement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="servciceaggerement">
                    <i class=" ti ti-file-description"></i> <span data-key="t-apps">Job Status </span>
                </a>
                <div class="collapse   menu-dropdown" id="servciceaggerement">
                    <ul class="nav nav-sm flex-column">
                        @php
                        $statuslist = DB::table('status')->get();

                        @endphp
                        @if(!empty($statuslist))
                        @foreach($statuslist as $listing)

                        <li class="nav-item internal">
                            <a class="sidebar-link" href="{{ route('leads.status',Str::slug($listing->status)) }}" aria-expanded="false" style="
    font-size: 11px;
">

                                <span class="hide-menu">{{$listing->status}} </span> <span class="selfcircle"> {{getLeadsCount(Str::title($listing->status))}}</span>
                            </a>
                        </li>
                        @endforeach()
                        @endif()
                    </ul>
                </div>
            </li>
            @break

            @endswitch()
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{url('admin/logout')}}" aria-expanded="false">
                    <span>
                        <i class="ti ti-aperture"></i>
                    </span>
                    <span class="hide-menu">Logout</span>
                </a>
            </li>
            </ul>

            </nav>
            <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!--  Header Start -->
        <header class="app-header">
            <nav class="navbar navbar-expand-lg navbar-light">
                <ul class="navbar-nav">
                    <li class="nav-item d-block d-xl-none">
                        <a class="sidebar-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                            <i class="ti ti-menu-2"></i>
                        </a>
                    </li>

                </ul>
                <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                    <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                        <span class="btn btn-primary">Welcome {{Auth::user()->name}}!</span>
                        <li class="nav-item dropdown">
                            <a class="sidebar-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ asset('admin/images/Earth-home.png') }}" alt="" width="35" height="35" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                <div class="message-body">

                                    <a href="{{url('admin/users/change-password')}}" class="d-flex align-items-center gap-2 dropdown-item">
                                        <i class="ti ti-key  fs-6"></i>
                                        <p class="mb-0 fs-3">Change Password</p>
                                    </a>

                                    <a href="{{url('admin/logout')}}" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!--  Header End -->
        <div class="container-fluid">

            @section('content')

            @show

        </div>
    </div>
    </div>

    <script src="{{asset('adminui/libs/jquery/dist/jquery.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>

    <script src="{{asset('adminui/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('adminui/js/sidebarmenu.js')}}"></script>
    <script src="{{asset('adminui/js/app.min.js')}}"></script>
    <script src="{{asset('adminui/libs/apexcharts/dist/apexcharts.min.js')}}"></script>
    <script src="{{asset('adminui/libs/simplebar/dist/simplebar.js')}}"></script>
    <script src="{{asset('adminui/js/dashboard.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>



</html>