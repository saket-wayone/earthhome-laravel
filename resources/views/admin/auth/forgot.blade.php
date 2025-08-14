<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg">


<head>

    <meta charset="utf-8" />
    <title>Forgot| DVpro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="DVpro" name="description" />
    <meta content="DVpro" name="author" />

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
                                    <div class="text-center" style="
    display: flex;
    /* margin-top: auto; */
    /* margin: auto; */
    justify-content: center;
    margin-top: 93px;
">
                                        <img src="{{ asset('admin/images/logo.webp') }}" style="width: 300px;/* height: 300px; */">

                                    </div>
                                </div>
                                <!-- end col -->

                                <div class="col-lg-6">
                                    <div class="p-lg-5 p-4">
                                        <div>
                                            <h5 class="text-primary">Forgot Password?</h5>
                                            <p class="text-muted">Reset password with Grow Fortuna.</p>
                                        </div>

                                        <div class="mt-4">
                                            <div class="mt-2 text-center">
                                                <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop" colors="primary:#0ab39c" class="avatar-xl">
                                                </lord-icon>
                                            </div>

                                            <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
                                                Enter your email and instructions will be sent to you!
                                            </div>
                                            <form method="post"action="{{route('emailforgot')}}" id="forgotauth">
                                                @csrf()

                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
                                                    <div class="error-message" id="email-error"></div>
                                                    <div class="error-message" id="password-error"></div>

                                                </div>

                                                <input type="hidden" name="emailsent" id="emailsent" value="0">
                                                <div class="mb-3" id="otpsection" style="display: none;">
                                                    <label for="username" class="form-label">Code</label>
                                                    <input type="number" name="otp" class="form-control" id="email" placeholder="Enter Code">
                                                    <div class="error-message" id="otp-error"></div>

                                                </div>

                                               




                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100"  id="processing" type="submit">Send Verification code</button>
                                                </div>



                                            </form>


                                            <form method="post" style="display: none;" id="newpasswordform" action="{{route('reset-password')}}" >
                                                @csrf()

                                                <div class="mb-3">
                                                    <label for="username" class="form-label">New Password</label>
                                                    <input type="text" name="newpassword" class="form-control" id="newpassword" placeholder="Enter Password">
                                                    <div class="error-message" id="newpassword-error"></div>

                                                </div>
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Confirm New Password</label>
                                                    <input type="text" name="confirmpassword" class="form-control" id="confirmpassword" placeholder="Enter Confirm New Password">
                                                    <div class="error-message" id="confirmpassword-error"></div>

                                                </div>

                                                <div  id="successreset" class="text-success"></div>

                                                

                                                

                                               




                                                <div class="mt-4">
                                                    <button class="btn btn-success w-100"  id="processing" type="submit">Submit</button>
                                                </div>



                                            </form>
                                        </div>

                                        
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
        <!-- <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            
                        </div>
                    </div>
                </div>
            </div>
        </footer> -->
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