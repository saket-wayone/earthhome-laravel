@extends('admin.layout')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<style>
    table thead {
        background-color: black;
        color: white;
    }


    .form-bottom {
        border: 2.2px solid black;
        padding: 20px;
        margin-bottom: 10px;
    }

    input[type="radio"] {
        width: 20px;
        height: 20px;
        margin-right: 10px;
        /* Add some spacing between the radio button and the text */
    }

    .control-label {
        font-size: 16px;
    }

    .form-group {
        margin-top: 10px;
    }

    .custom-radio .custom-control-input {
        width: 0.7rem;
        height: 0.7rem;

    }



    .card-body {

        padding: 1px 20px;
        line-height: 33px;

    }

    .custom-radio .custom-control-label {
        padding-left: 0rem;
        line-height: 1.5rem;
    }

    .custom-control-label::before,
    .custom-control-label::after {
        top: 0.25rem;
        width: 1.5rem;
        height: 1.5rem;
    }

    .showquestion {
        display: none;
    }
</style>


<div class="row">

    <div class="row">
        <div class="row">
            <div class="col-xxl-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Add New Risk Assesment</h4>
                        <div class="flex-shrink-0">

                        </div>
                    </div><!-- end card header -->

                    <div class="card-body">

                        <div class="live-preview">
                            <form action="{{route('risk.store')}}" id="companyadmin" method="post">
                                @csrf()
                                <div class="row">
                                    <!--end col-->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">
                                                Name</label>
                                            <input type="text" class="form-control" name="name" required placeholder="Enter  Name" id="name">
                                            <div class="error-message" id="name-error"></div>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Phone
                                                Number</label>
                                            <input type="tel" class="form-control onlyNumeric" oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="phone" required placeholder="Enter mobile number" id="phone">
                                            <div class="error-message" id="phone-error"></div>

                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email
                                                Address</label>
                                            <input type="email" class="form-control" name="email" required placeholder="example@gmail.com" id="email">
                                            <div class="error-message" id="email-error"></div>

                                        </div>
                                    </div>

                                    <!--<div class="col-md-4">-->
                                    <!--    <div class="mb-3">-->
                                    <!--        <label for="emailidInput" class="form-label">Gender-->
                                    <!--        </label>-->
                                    <!--        <select class="form-control" name="gender">-->
                                    <!--            <option name="">Select Gender</option>-->
                                    <!--            <option name="Male">Male</option>-->
                                    <!--            <option name="Female">Female</option>-->
                                    <!--            <option name="Other">Other</option>-->
                                    <!--        </select>-->
                                    <!--        <div class="error-message" id="gender-error"></div>-->

                                    <!--    </div>-->
                                    <!--</div>-->

                                    <!--<div class="col-md-4">-->
                                    <!--    <div class="mb-3">-->
                                    <!--        <label for="addressid" class="form-label">Address-->
                                    <!--        </label>-->
                                    <!--        <input type="address" class="form-control" name="address" required placeholder="Mumbai etc" id="addressid">-->

                                    <!--        <div class="error-message" id="address-error"></div>-->

                                    <!--    </div>-->
                                    <!--</div>-->
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="ForminputState" class="form-label">Assese Name</label>
                                            <input type="text" class="form-control" required name="assese_name" placeholder="Assese Name" id="assessname">
                                            <div class="error-message" id="assese_name-error"></div>

                                        </div>

                                    </div>


                                    <!--<div class="col-md-4">-->
                                    <!--    <div class="mb-3">-->
                                    <!--        <label for="ForminputState" class="form-label">Certificate Id</label>-->
                                    <!--        <input type="text" class="form-control" name="certificateid" placeholder="Certificate Id" id="certificateid">-->
                                    <!--        <div class="error-message" id="certificateid-error"></div>-->

                                    <!--    </div>-->

                                    <!--</div>-->
                                    <!--<div class="col-md-4">-->
                                    <!--    <div class="mb-3">-->
                                    <!--        <label for="ForminputState" class="form-label">Upload Scanned Certificate</label>-->
                                    <!--        <input type="file" class="form-control" name="scannedimage" accept="image/*" id="certificateid">-->
                                    <!--        <div class="error-message" id="scannedimage-error"></div>-->

                                    <!--    </div>-->

                                    <!--</div>-->
                                    <div class="col-md-12 hidebutton">
                                        <button type="button" onclick="showfunction2()" class="btn btn-dark" id="changetext">Submit</button>

                                    </div>

                                    <div class="card-header align-items-center d-flex mt-4 showquestion ">
                                        <h4 class="card-title mb-0 flex-grow-1 showquestion "><b>Answer these questions and check your score</b></h4>

                                    </div>


                                    <div class="container mt-5 showquestion">
                                        <div class="card-body p-4 bg-light">
                                            <div class="row">
                                                <fieldset class="col-12 mb-4">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>a. Have you previously taken trading advisory from any other Investment Advisory Firm?</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group mb-3">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="firstTime" name="previous_advisory" value="No, this is my first time" required>
                                                                    <label class="custom-control-label" for="firstTime">No, this is my first time</label>
                                                                </div>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="hadPreviously" name="previous_advisory" value="Yes, had taken previously">
                                                                    <label class="custom-control-label" for="hadPreviously">Yes, had taken previously</label>
                                                                </div>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="currentlyTaking" name="previous_advisory" value="Yes, currently i am taking services from some other Advisory firm for trading recommendation">
                                                                    <label class="custom-control-label" for="currentlyTaking">Yes, currently I am taking services from some other Advisory firm for trading recommendation</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="control-label"><b>Name of the Advisory Firm</b></label>
                                                                <input type="text" style="width: 30%;" class="form-control text-uppercase mt-1" name="firm" id="firm">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                                <fieldset class="col-12 mb-4">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>b. Have you previously had a loss in Trading?</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group mb-3">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="lossYes" name="previous_loss" value="Yes" required>
                                                                    <label class="custom-control-label" for="lossYes">Yes</label>
                                                                </div>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="lossNo" name="previous_loss" value="No">
                                                                    <label class="custom-control-label" for="lossNo">No</label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="control-label"><b>If YES then what is the Loss Percentage (%) as per the Capital Value?</b></label>
                                                                <input style="width: 30%;" type="number" class="form-control mt-1" maxlength="3" name="loss_percentage" id="loss_percentage">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                                <fieldset class="col-12 mb-4">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>c. What is Your Liability / Borrowing Details?</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group mb-3">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="personalLoan" name="liability" value="Personal Loan" required>
                                                                    <label class="custom-control-label" for="personalLoan">Personal Loan</label>
                                                                </div>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="homeLoan" name="liability" value="Home Loan">
                                                                    <label class="custom-control-label" for="homeLoan">Home Loan</label>
                                                                </div>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="businessLoan" name="liability" value="Business Loan">
                                                                    <label class="custom-control-label" for="businessLoan">Business Loan</label>
                                                                </div>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="otherLoan" name="liability" value="Other">
                                                                    <label class="custom-control-label" for="otherLoan">Other</label>
                                                                </div>
                                                                <input type="text" style="width: 30%;" class="form-control mt-2" name="other_Liability" placeholder="If other loan like educational loan">
                                                            </div>
                                                            <div class="form-group mb-3">
                                                                <label class="control-label"><b>What is your age?</b></label>
                                                                <input style="width: 30%;" type="tel" class="form-control onlyNumeric mt-1" maxlength="3" name="age" id="age" required oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                                <fieldset class="col-12 mb-4">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>d. Have you ever traded in the stock market? If yes, then select the segment</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-group mb-3">
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="noNew" name="ever_did_trade" value="No, I am new in the financial market" required>
                                                                    <label class="custom-control-label" for="noNew">No, I am new in the financial market</label>
                                                                </div>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="equity" name="ever_did_trade" value="Equity">
                                                                    <label class="custom-control-label" for="equity">Equity</label>
                                                                </div>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="equityFO" name="ever_did_trade" value="Equity & F&O">
                                                                    <label class="custom-control-label" for="equityFO">Equity & F&O</label>
                                                                </div>
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="equityFOMCX" name="ever_did_trade" value="Equity, Forex, MCX">
                                                                    <label class="custom-control-label" for="equityFOMCX">Equity, Forex, MCX</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                                @if(!empty($questions))
                                                @foreach($questions as $key => $listing)
                                                <fieldset class="col-12 mb-4">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h5>Question {{ ++$key }}</h5>
                                                        </div>
                                                        <div class="card-body">
                                                            <input type="hidden" name="question_id[]" value="{{ $listing->id }}">
                                                            <div class="form-group mb-3">
                                                                <label class="control-label"><b>{{ $listing->question ?? '' }}</b></label><br>
                                                                @if(!$listing->subquestions->isEmpty())
                                                                @foreach($listing->subquestions as $subquestionlist)
                                                                <label class="control-label"><b>{{ $subquestionlist->question ?? '' }}</b></label><br>
                                                                @if(!empty($subquestionlist->options))
                                                                @foreach($subquestionlist->options as $option)
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="subquestion_{{ $option->id }}" name="subquestionoption[{{ $subquestionlist->id }}]" value="{{ $option->id }}" required>
                                                                    <label class="custom-control-label" for="subquestion_{{ $option->id }}">{{ $option->option ?? '' }}</label>
                                                                </div>
                                                                @endforeach
                                                                @endif
                                                                @endforeach
                                                                @else
                                                                @if(!empty($listing->options))
                                                                @foreach($listing->options as $optlist)
                                                                <div class="custom-control custom-radio">
                                                                    <input type="radio" class="custom-control-input" id="response_{{ $optlist->id }}" name="response[{{ $listing->id }}]" value="{{ $optlist->id }}">
                                                                    <label class="custom-control-label" for="response_{{ $optlist->id }}">{{ $optlist->option ?? '' }}</label>
                                                                </div>
                                                                @endforeach
                                                                @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>



                                    <div class="container m-auto " id="scoresection" style="display: none;">

                                        <div class="col-xxl-6">
                                            <div class="card" id="company-view-detail">
                                                <div class="card-body text-center">

                                                    <h5 class="mt-3 mb-1">Hi <span id="username"></span></h5>


                                                </div>
                                                <div class="row">
                                                    <div class="card-body">
                                                        <div class="table-responsive table-card">
                                                            <table class="table table-borderless mb-0">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="fw-medium" scope="row">Email</td>
                                                                        <td><span id="user_email"></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fw-medium" scope="row">Mobile</td>
                                                                        <td><span id="user_mobile"></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fw-medium" scope="row">Score</td>
                                                                        <td><span id="user_score" style="font-size: 20px;"></span></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="fw-medium" scope="row">Risk</td>
                                                                        <td><span id="risk_factor" style="font-size: 20px;"></span></td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                        </div>

                                    </div>


                                    <!--end col-->
                                    <div class="col-lg-12 showquestion">
                                        <div class="text-center" style="text-align:center !important;">
                                            <div class="text-success" id="success"></div>

                                            <button type="submit" id="showandhidebutton" class="btn btn-dark">Submit</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->


        </div>
    </div>
</div> <!-- end col -->
</div>
<!-- end col -->

<script src="{{asset('admin/js/ajax/usercreate.js')}}"></script>

<script>
    function showfunction2() {
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();

        if (phone.length < 10) {
            alert("Invalid Phone Number");



        } else {
            if (name != '' && email != '' && phone != '') {


                $.ajax({
                    method: 'POST',
                    url: '{{url("admin/risk-assement/checkmobile")}}',
                    data: {
                        phone: phone,
                        _token: $('meta[name="csrf-token"]').attr('content') // Include CSRF token

                    },
                    success: function(res) {


                        if (res.code == 200) {
                            $('.showquestion').show();
                            $('.hidebutton').hide();
                        } else if (res.code == 409) {
                            $('#success').html(res.message);
                            $('#username').html(res.name);
                            $('#user_email').html(res.email);
                            $('#user_mobile').html(res.phone);
                            $('#user_score').html(res.points);
                            $('#risk_factor').html(res.risk);
                            $('#showandhidebutton').hide();
                            // $('#scoresection').show();


                            window.location.href = window.origin + '/admin/serviceagreement/score/' + res.id;





                        }
                    },

                });


            }
        }


    }
</script>

</div>
@endsection