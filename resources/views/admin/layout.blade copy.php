<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">


<head>

    <meta charset="utf-8" />
    <title>Dashboard </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="DVpro" name="description" />
    <meta content="DVpro" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('admin/images/favicon.ico')}}">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- jsvectormap css -->
    <link href="{{asset('admin/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!--Swiper slider css-->
    <link href="{{asset('admin/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{asset('admin/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('admin/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('admin/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('admin/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('admin/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .profilepic .profile-pic {
            border-radius: 50%;
            /* height: 150px; */
            width: 150px;
            margin-top: 15px;
            background-size: cover;
            background-position: center;
            background-blend-mode: multiply;
            vertical-align: middle;
            text-align: center;
            color: transparent;
            transition: all .3s ease;
            text-decoration: none;
            cursor: pointer;
        }

        .profilepic .profile-pic:hover {
            background-color: rgba(0, 0, 0, .5) !important;
            z-index: 10000;
            color: #fff;
            transition: all .3s ease;
            text-decoration: none;
        }

        .profilepic .profile-pic span {
            /* display: inline-block; */
            color: white;
            padding-top: 4.5em;
            padding-bottom: 4.5em;
        }


        .profile-pic img {
            width: 70%;
            height: auto;
            object-fit: contain;
            object-position: center;
            border-radius: 50%;
        }

        .profilepic form input[type="file"] {
            display: none;
            cursor: pointer;
        }
    </style>


</head>
@if(Auth::user()->role == 'manager')

@php
$companylogo = DB::table('users')->where('id', Auth::user()->company_id)->first();
$logo = 'uploads/Grow Fortuna/1715129210.webp';
@endphp

@else

@php
$logo = 'uploads/Grow Fortuna/1715129210.webp';
@endphp

@endif

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="#" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{asset('admin/images/logo-sm.png')}}" alt="" width="100" height="100">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('admin/images/logo-dark.png')}}" alt="" width="100" height="100">
                                </span>
                            </a>

                            <a href="#" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{asset('admin/images/logo-sm.png')}}" alt="" width="100" height="100">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{asset('admin/images/logo-light.png')}}" alt="" width="100" height="100">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>

                        <!-- App Search-->

                    </div>

                    <div class="d-flex align-items-center">

                        <div class="dropdown d-md-none topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-search fs-22"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                            <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>







                        <!-- <div class="dropdown topbar-head-dropdown ms-1 header-item">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                        id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class='bx bx-bell fs-22'></i>
                        <span
                            class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">3<span
                                class="visually-hidden">unread messages</span></span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                        aria-labelledby="page-header-notifications-dropdown">

                        <div class="dropdown-head bg-primary bg-pattern rounded-top">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0 fs-16 fw-semibold text-white"> Notifications </h6>
                                    </div>
                                    <div class="col-auto dropdown-tabs">
                                        <span class="badge badge-soft-light fs-13"> 4 New</span>
                                    </div>
                                </div>
                            </div>

                            <div class="px-2 pt-2">
                                <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true"
                                    id="notificationItemsTab" role="tablist">
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab"
                                            aria-selected="true">
                                            All (4)
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#messages-tab" role="tab"
                                            aria-selected="false">
                                            Messages
                                        </a>
                                    </li>
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link" data-bs-toggle="tab" href="#alerts-tab" role="tab"
                                            aria-selected="false">
                                            Alerts
                                        </a>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <div class="tab-content" id="notificationItemsTabContent">
                            <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-soft-info text-info rounded-circle fs-16">
                                                    <i class="bx bx-badge-check"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-2 lh-base">Your <b>Elite</b> author Graphic
                                                        Optimization <span class="text-secondary">reward</span> is
                                                        ready!
                                                    </h6>
                                                </a>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> Just 30 sec ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="all-notification-check01">
                                                    <label class="form-check-label"
                                                        for="all-notification-check01"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div
                                        class="text-reset notification-item d-block dropdown-item position-relative active">
                                        <div class="d-flex">
                                            <img src="{{asset('admin/images/users/avatar-2.jpg')}}"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">Answered to your comment on the cash flow forecast's
                                                        graph 🔔.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 48 min ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="all-notification-check02" checked>
                                                    <label class="form-check-label"
                                                        for="all-notification-check02"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span
                                                    class="avatar-title bg-soft-danger text-danger rounded-circle fs-16">
                                                    <i class='bx bx-message-square-dots'></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-2 fs-13 lh-base">You have received <b
                                                            class="text-success">20</b> new messages in the conversation
                                                    </h6>
                                                </a>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="all-notification-check03">
                                                    <label class="form-check-label"
                                                        for="all-notification-check03"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item position-relative">
                                        <div class="d-flex">
                                            <img src="{{asset('admin/images/users/avatar-8.jpg')}}"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">We talked about a project on linkedin.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 4 hrs ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="all-notification-check04">
                                                    <label class="form-check-label"
                                                        for="all-notification-check04"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="my-3 text-center">
                                        <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                            All Notifications <i class="ri-arrow-right-line align-middle"></i></button>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade py-2 ps-2" id="messages-tab" role="tabpanel"
                                aria-labelledby="messages-tab">
                                <div data-simplebar style="max-height: 300px;" class="pe-2">
                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="{{asset('admin/images/users/avatar-3.jpg')}}"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">James Lemire</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">We talked about a project on linkedin.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 30 min ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="messages-notification-check01">
                                                    <label class="form-check-label"
                                                        for="messages-notification-check01"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="{{asset('admin/images/users/avatar-2.jpg')}}"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Angela Bernier</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">Answered to your comment on the cash flow forecast's
                                                        graph 🔔.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 2 hrs ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="messages-notification-check02">
                                                    <label class="form-check-label"
                                                        for="messages-notification-check02"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="{{asset('admin/images/users/avatar-6.jpg')}}"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Kenneth Brown</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">Mentionned you in his comment on 📃 invoice #12501.
                                                    </p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 10 hrs ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="messages-notification-check03">
                                                    <label class="form-check-label"
                                                        for="messages-notification-check03"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-reset notification-item d-block dropdown-item">
                                        <div class="d-flex">
                                            <img src="{{asset('admin/images/users/avatar-8.jpg')}}"
                                                class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                            <div class="flex-1">
                                                <a href="#!" class="stretched-link">
                                                    <h6 class="mt-0 mb-1 fs-13 fw-semibold">Maureen Gibson</h6>
                                                </a>
                                                <div class="fs-13 text-muted">
                                                    <p class="mb-1">We talked about a project on linkedin.</p>
                                                </div>
                                                <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                    <span><i class="mdi mdi-clock-outline"></i> 3 days ago</span>
                                                </p>
                                            </div>
                                            <div class="px-2 fs-15">
                                                <div class="form-check notification-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="messages-notification-check04">
                                                    <label class="form-check-label"
                                                        for="messages-notification-check04"></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="my-3 text-center">
                                        <button type="button" class="btn btn-soft-success waves-effect waves-light">View
                                            All Messages <i class="ri-arrow-right-line align-middle"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade p-4" id="alerts-tab" role="tabpanel" aria-labelledby="alerts-tab">
                                <div class="w-25 w-sm-50 pt-3 mx-auto">
                                    <img src="{{asset('admin/images/svg/bell.svg')}}" class="img-fluid" alt="user-pic">
                                </div>
                                <div class="text-center pb-5 mt-2">
                                    <h6 class="fs-18 fw-semibold lh-base">Hey! You have no any notifications </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->

                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    @if($logo !='')

                                    <img class="rounded-circle header-profile-user" src="{{url($logo)}}" alt="dv pro">
                                    @endif()
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{Auth::user()->name}}</span>
                                        <span class="d-none d-xl-block ms-1 fs-12 text-muted user-name-sub-text">{{Auth::user()->role}}</span>
                                    </span>
                                </span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Welcome {{Auth::user()->name}}!</h6>

                                <a class="dropdown-item" href="{{url('admin/users/change-password')}}"><i class="mdi mdi-key text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Change Password</span></a>
                                <a class="dropdown-item" href="{{url('admin/logout')}}"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Logout</span></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="#" class="logo logo-dark">



                    <div class="profilepic">

                        <form id="previewimageshow" method="post" enctype="multipart/form-data">
                            @csrf()
                            <label for="fileToUpload">
                                <div class="profile-pic">

                                    @if($logo !='')
                                    <img src="{{url($logo)}}">



                                    @endif()
                                    @if( Auth::user()->role =='admin' )

                                    <!-- <span>Upload Logo</span> -->
                                    @endif()
                                </div>
                            </label>

                            {{-- @if( Auth::user()->role =='admin' )



                            <input type="File" accept="image/*" name="fileToUpload" id="fileToUpload">
                            @endif()
                            --}}
                        </form>
                    </div>

                </a>
                <!-- Light Logo-->
                <a href="#" class="logo logo-light">

                    <div class="profilepic">

                        <form id="previewimageshow" method="post" enctype="multipart/form-data">
                            @csrf()

                            <label for="fileToUpload">
                                <div class="profile-pic">
                                    @if($logo !='')
                                    <img src="{{url($logo)}}" width="100" height="200">



                                    @endif()

                                </div>
                            </label>

                            {{-- @if(Auth::user()->role =='company_admin' || Auth::user()->role =='admin' )

                            <input type="File" accept="image/*" name="fileToUpload" id="fileToUpload">

                            @endif() --}}
                        </form>
                    </div>



                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{route('dashboard')}}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>

                        </li> <!-- end Dashboard Menu -->
                        @feature('admin_panel')
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class=" ri-folder-user-line"></i> <span data-key="t-apps">Users </span>
                            </a>
                            <div class="collapse  menu-dropdown" id="sidebarApps">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{url('admin/users/all')}}" class="nav-link" data-key="t-calendar"> All </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="{{url('admin/users/create')}}" class="nav-link" data-key="t-chat"> Create New Users </a>
                                    </li> -->
                                    <!-- <li class="nav-item">
                                        <a href="{{url('admin/users/status/notapproved')}}" class="nav-link" data-key="t-chat"> New Company approval request </a>
                                    </li> -->

                                    <li class="nav-item">
                                        <a href="{{url('admin/users/status/approved')}}" class="nav-link" data-key="t-chat"> Activated Users </a>
                                    </li>


                                    
                                    @php
                                    $roles = DB::table('plantype')->get();


                                    @endphp
                                    @if(!empty( $roles))
                                    @foreach($roles as $rolelist)
                                    <li class="nav-item">
                                        <a href="{{url('admin/users/role/'.Str::slug($rolelist->name))}}" class="nav-link" data-key="t-calendar"> {{$rolelist->name ?? ''}} </a>
                                    </li>

                                    @endforeach()


                                    @endif()

                                    <li class="nav-item">
                                        <a href="#roles" class="nav-link collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="roles" data-key="t-calender">
                                            Roles
                                        </a>
                                        <div class="menu-dropdown collapse" id="roles" style="">
                                            <ul class="nav nav-sm flex-column">
                                                <li class="nav-item">
                                                    <a href="{{route('plans.all')}}" class="nav-link" data-key="t-main-calender">All Roles</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="{{route('plans.create')}}" class="nav-link" data-key="t-month-grid">Create New Role</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    








                                </ul>
                            </div>
                        </li>




                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link" href="#pricessidebar" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="pricessidebar">
                                <i class=" ri-price-tag-3-fill"></i> <span data-key="t-apps">Plan Type </span>
                            </a>
                            <div class="collapse   menu-dropdown" id="pricessidebar">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('prices.all')}}" class="nav-link" data-key="t-calendar"> All Plan Type </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('prices.create')}}" class="nav-link" data-key="t-chat"> Create New Plan Type </a>
                                    </li>






                                </ul>
                            </div>
                        </li> -->


                        <!-- <li class="nav-item">
                            <a class="nav-link menu-link" href="#plansidebar" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="plansidebar">
                                <i class=" ri-price-tag-3-fill"></i> <span data-key="t-apps">Plan </span>
                            </a>
                            <div class="collapse   menu-dropdown" id="plansidebar">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('plans.all')}}" class="nav-link" data-key="t-calendar"> All Plan </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('plans.create')}}" class="nav-link" data-key="t-chat"> Create New Plan </a>
                                    </li>






                                </ul>
                            </div>
                        </li> -->

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#riskassement" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="riskassement">
                                <i class=" ri-coupon-2-fill"></i> <span data-key="t-apps">Risk Assesment </span>
                            </a>
                            <div class="collapse   menu-dropdown" id="riskassement">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('risk.all')}}" class="nav-link" data-key="t-calendar"> All  </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('risk.create')}}" class="nav-link" data-key="t-chat"> Create New  </a>
                                    </li>






                                </ul>
                            </div>
                        </li>
                        @endfeature()
                        @feature('company_pannel')
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarApps2" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps2">
                                <i class=" ri-git-repository-private-fill"></i> <span data-key="t-apps">Manager </span>
                            </a>
                            <div class="collapse  menu-dropdown" id="sidebarApps2">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{url('admin/users/second/manager')}}" class="nav-link" data-key="t-calendar"> All Manager </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('manager.create')}}" class="nav-link" data-key="t-chat"> Create New Manager </a>
                                    </li>





                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#book" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class=" ri-book-fill"></i> <span data-key="t-apps">Books </span>
                            </a>
                            <div class="collapse  menu-dropdown" id="book">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('books.all')}}" class="nav-link" data-key="t-calendar"> All Books </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('books.create')}}" class="nav-link" data-key="t-chat"> Create New Books </a>
                                    </li>





                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#MR" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-apps-2-line"></i> <span data-key="t-apps">MR </span>
                            </a>
                            <div class="collapse menu-dropdown" id="MR">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('mr.all')}}" class="nav-link" data-key="t-calendar"> All MRs
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('mr.create')}}" class="nav-link" data-key="t-chat"> Create New MR </a>
                                    </li>





                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#doctor" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-apps-2-line"></i> <span data-key="t-apps">Doctor </span>
                            </a>
                            <div class="collapse menu-dropdown" id="doctor">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{url('doctor')}}" class="nav-link" data-key="t-calendar">All Doctor</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('doctor/add')}}" class="nav-link" data-key="t-chat"> Create Doctor </a>
                                    </li>
                                </ul>
                            </div>
                        </li>



                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#licence" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-file-user-fill"></i> <span data-key="t-apps">Manage License </span>
                            </a>
                            <div class="collapse menu-dropdown" id="licence">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('mr.history')}}" class="nav-link" data-key="t-calendar"> Purchase </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('mr.license')}}" class="nav-link" data-key="t-chat"> View Licenses </a>
                                    </li>





                                </ul>
                            </div>
                        </li>


                        <!--<li class="nav-item">-->
                        <!--    <a class="nav-link menu-link" href="{{route('mr.history')}}">-->
                        <!--        <i class="ri-file-user-fill"></i> <span data-key="t-dashboards">Purchase License</span>-->
                        <!--    </a>-->

                        <!--</li> -->

                        <!-- end Dashboard Menu -->

                        @endfeature()

                        @feature('manager_pannel')
                        @if(Auth::user()->can_create_mr)

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#MR" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class="ri-apps-2-line"></i> <span data-key="t-apps">MR </span>
                            </a>
                            <div class="collapse menu-dropdown" id="MR">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('mr.all')}}" class="nav-link" data-key="t-calendar"> All MR </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('mr.create')}}" class="nav-link" data-key="t-chat"> Create New MR </a>
                                    </li>





                                </ul>
                            </div>
                        </li>

                        @endif()

                        @if(Auth::user()->can_create_books)

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#book" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                                <i class=" ri-book-fill"></i> <span data-key="t-apps">Books </span>
                            </a>
                            <div class="collapse  menu-dropdown" id="book">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('books.all')}}" class="nav-link" data-key="t-calendar"> All Books </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('books.create')}}" class="nav-link" data-key="t-chat"> Create New Books </a>
                                    </li>





                                </ul>
                            </div>
                        </li>


                        @endif()


                        @endfeature()





                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{url('admin/logout')}}">
                                <i class="ri-pencil-ruler-2-line"></i> <span data-key="t-dashboards">Logout</span>
                            </a>

                        </li>


















                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">

                @section('content')

                @show

                <div class="row">
                    <div class="col-md-12">
                        @if(session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }} <a href="{{route('mr.history')}}">Purchase or upgrade license</a>
                        </div>
                        @endif
                    </div>
                </div>







                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <!-- <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © The Bharat Tech.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by The Bharat Tech
                            </div>
                        </div>
                    </div>
                </div>
            </footer> -->
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->




    <!-- JAVASCRIPT -->
    <script src="{{asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('admin/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('admin/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('admin/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('admin/js/plugins.js')}}"></script>

    <!-- apexcharts -->
    <script src="{{asset('admin/libs/apexcharts/apexcharts.min.js')}}"></script>

    <!-- Vector map-->
    <script src="{{asset('admin/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>
    <script src="{{asset('admin/libs/jsvectormap/maps/world-merc.js')}}"></script>

    <!--Swiper slider js-->
    <script src="{{asset('admin/libs/swiper/swiper-bundle.min.js')}}"></script>

    <!-- Dashboard init -->
    <script src="{{asset('admin/js/pages/dashboard-ecommerce.init.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('admin/js/app.js')}}"></script>
    <script src="{{asset('admin/js/pages/datatables.init.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="{{asset('admin/js/ajax/main.js')}}"></script>
    <script>
        $('#previewimageshow').on('change', '#fileToUpload', function(e) {
            e.preventDefault();



            const fileInput = $(this)[0].files[0];
            const formData = new FormData();
            formData.append('fileToUpload', fileInput);

            $.ajax({
                url: "{{ route('uploadlogo') }}",
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('.profile-pic').css('background-image', 'url(' + response.url + ')');
                    setTimeout(() => {
                        window.location.href = window.location.href;

                    }, 1000)

                    // window.location.href = window.location.href;
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>

</body>


</html>