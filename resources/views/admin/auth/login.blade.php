<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">


<head>

    <meta charset="utf-8" />
    <title>Sign In | Grow Fortuna</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Grow Fortuna" name="description" />
    <meta content="Grow Fortuna" name="author" />

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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

</head>

<body>

    <!-- auth-page wrapper -->
    <div class="auth-page-wrapper auth-bg-cover py-5 d-flex justify-content-center align-items-center min-vh-100">
        <div class=""></div>
        <!-- auth-page content -->
        <div class="auth-page-content overflow-hidden pt-lg-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card overflow-hidden">
                            <div class="row g-0">
                                <div class="col-lg-6">
                                    <div class="text-center" style=" display: flex;/* margin-top: auto; *//* margin: auto; */justify-content: center;margin-top: 53px;">
                                        <img src="{{ asset('admin/images/logo.webp') }}" style="width: 300px;/* height: 300px; */">

                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary">Welcome </h5>
                                            <p class="text-muted">Sign in to continue to Grow Fortuna.</p>
                                        </div>

                                        <div class="mt-4">
                                            <form method="post" action="{{route('validateUser')}}" id="loginauth">
                                                @csrf()

                                                <!-- <div class="mb-3">
                                                    <label for="username" class="form-label">Company Name</label>
                                                    <input type="text" name="company_name" class="form-control" id="company_name" placeholder="Enter Company Name">
                                                    <div class="error-message" id="company_name-error"></div>

                                                </div> -->

                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                                                    <div class="error-message" id="email-error"></div>

                                                </div>

                                                <div class="mb-3">

                                                    <label class="form-label" for="password-input">Password</label>
                                                    <div class="position-relative auth-pass-inputgroup mb-3">
                                                        <input type="password" name="password" class="form-control pe-5" placeholder="Enter password" id="password-input">
                                                        <div class="error-message" id="password-error"></div>
                                                        <div class="text-success" id="success"></div>

                                                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                    </div>
                                                </div>

                                                <a href="{{url('forgot')}}" class="fw-semibold text-primary text-decoration-underline"> Forgot Password ? </a>



                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100" type="submit">Sign In</button>
                                                </div>



                                            </form>
                                        </div>

                                        <!-- <div class="mt-5 text-center">
                                            <p class="mb-0">Don't have an account ? <a href="{{url('sign-up')}}" class="fw-semibold text-primary text-decoration-underline"> Signup</a> </p>
                                        </div> -->
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <!-- <p class="mb-0">&copy;
                                <script>
                                    document.write(new Date().getFullYear())
                                </script> Grow Fortuna. Crafted with <i class="mdi mdi-heart text-danger"></i> by &nbsp;<a href="https://www.thebharatech.com/" style="color:white" target="__blank">THE BHARATECH </a>
                            </p> -->
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{asset('admin/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('admin/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('admin/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('admin/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('admin/js/plugins.js')}}"></script>

    <!-- password-addon init -->
    <script src="{{asset('admin/js/pages/password-addon.init.js')}}"></script>

    <script src="{{asset('admin/js/ajax/authvalidation.js')}}"></script>

</body>


</html>