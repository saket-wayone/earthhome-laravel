@extends('admin.layout')
@section('content')




<div class="container m-auto " id="scoresection">
    <a href="{{url('admin/risk-assement')}}" class="btn btn-primary btn-sm">Go To Risk Assesment</a>
    <div class="row">
        <div class="col-xxl-6" style="text-align: center; ">
                <img src="{{url('admin/images/11104.jpg')}}" style="width: 600px;" >
        </div>

        <div class="col-xxl-6" style="text-align: center; ">
            <div class="card" id="company-view-detail">
                <div class="card-body text-center">

                    <h5 class="mt-3 mb-1">Hi <span id="username">{{$score->name ?? ''}}</span></h5>


                </div>
                <div class="row">
                    <div class="card-body">
                        <div class="table-responsive table-card " style="align-items: center;">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <td class="fw-medium" scope="row">Email</td>
                                        <td><span id="user_email">{{$score->email ?? ''}}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium" scope="row">Mobile</td>
                                        <td><span id="user_mobile">{{$score->phone ?? ''}}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium" scope="row">Score</td>
                                        <td><span id="user_score">{{$score->totalpoints ?? ''}}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-medium" scope="row">Risk</td>
                                        <td><span id="risk_factor">{{$score->riskfactor ?? ''}}</span></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>




<script src="{{asset('admin/js/ajax/usercreate.js')}}"></script>

<script>
    function showfunction2() {
        var name = $('#name').val();
        var email = $('#email').val();
        var phone = $('#phone').val();
        if (name != '' && email != '' && phone != '') {
            $('.showquestion').show();
            $('.hidebutton').hide();

        }

    }
</script>

</div>
@endsection