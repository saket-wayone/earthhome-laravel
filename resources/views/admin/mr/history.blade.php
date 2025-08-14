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
    <div class="col-md-12">
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
    </div>
</div>
<div class="row">

    @if(!empty($prices))

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="row p-3">
                    <h3 class="text-center text-info">Select Plan</h3>
                    @foreach($prices as $planes)
                    <div class="col-xxl-4 col-lg-6">
                        <div class="card pricing-box">
                            <div class="card-body bg-light m-2 p-4">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="flex-grow-1">
                                        <h5 class="mb-0 fw-semibold">{{strtoupper($planes->type) ?? ''}}</h5>
                                    </div>
                                    <div class="ms-auto">
                                        <h2 class="month mb-0" style="display: block;"> <small class="fs-13 text-muted"> ₹ {{$planes->price ?? ''}}/ License</small></h2>
                                    </div>
                                </div>


                              <div class="mt-3 pt-2" >
                                    <a href="{{route('choosedplan',$planes->id)}}" type="button" o class="btn btn-success w-100">Purchase</a>
                            </div>

                            <!-- <div class="mt-3 pt-2" onclick="chooseplan('{{$planes->type}}' ,'{{$planes->price }}')">
                                <button type="button" onclick="chooseplan('{{$planes->type}}','{{$planes->price }}')" class="btn btn-success  w-100">Choose Your Plan</button>
                            </div> -->
                        </div>
                    </div>
                </div>
                @endforeach()
                <!--end col-->


            </div>


            <div class="card-header d-flex">
                <div class="col-md-6" id="licensetype" style="display: none;">
                    <form action="{{ route('mr.purchasecredit') }}" method="post" id="razorpay-form">
                        @csrf()

                        <div class="card product shadow p-3 mb-5 bg-white rounded">
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-sm-auto">
                                        <div class="avatar-lg bg-light rounded p-1">
                                            <img src="{{asset('admin/images/images.png')}}" alt="" class="img-fluid d-block">
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <h5 class="fs-14 text-truncate"><a href="#" class="text-body"> License </a></h5>
                                        <ul class="list-inline text-muted">
                                            <li class="list-inline-item">Plan Type : <span class="fw-medium" id="plan_type">




                                                </span></li>
                                        </ul>

                                        <input type="hidden" name="plan_type" class="plan_type">
                                        <div style="display: flex;" id="hidecoupensection" class="gap-3">
                                            <div>
                                                <input type="text" name="coupen" placeholder="Apply Coupen if Any" class="form-control">
                                            </div>
                                            <div>
                                                <a class="btn  btn-success btn-sm" onclick="applycoupen();">Apply Coupen</a>
                                            </div>




                                        </div>
                                        <span id="error"></span>
                                        <input type="hidden" name="coupenid" id="coupenid">

                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="text-lg-end">
                                            <p class="text-muted mb-1">Per License Cost</p>
                                            <h5 class="fs-14">₹<span id="ticket_price" class="product-price"></span></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- card body -->
                            <div class="card-footer">
                                <div class="row align-items-center gy-3">
                                    <div class="col-sm">
                                        <div class="input-step">
                                            <button type="button" onclick="decrease()" class="minus material-shadow">–</button>
                                            <input type="number" name="quantity" onkeyup="currentvalue(this.value)" class="product-quantity" id="creaditvalue" value="1" min="1">
                                            <button type="button" onclick="increase()" class="plus material-shadow">+</button>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <a class="btn  btn-success" onclick="razorpaySubmit();">Buy</a>

                                    </div>
                                    <div class="col-sm-auto">
                                        <div class="d-flex align-items-center gap-2 text-muted">
                                            <div>Total :</div>
                                            <h5 class="fs-14 mb-0">₹ <span class="product-line-price" id="totalvalue"></span></h5>
                                            <input type="hidden" name="totalamount" id="totalvaluetobepay">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card footer -->
                        </div>
                    </form>
                </div>
                <div class="col-md-1">

                </div>

                <div class="col-md-5">
                    <div class="alert border-dashed alert-warning" role="alert">
                        <div class="d-flex align-items-center">
                            <lord-icon src="https://cdn.lordicon.com/nkmsrxys.json" trigger="loop" colors="primary:#121331,secondary:#f06548" style="width:80px;height:80px"></lord-icon>
                            <div class="ms-2">
                                <h5 class="fs-14 text-danger fw-semibold">CURRENT CREDIT LEFT FOR CREATING MR /License </h5>
                                <a href="{{route('mr.license.notused')}}">Click Here to view</a>
                                <p class="text-body mb-1 " style="font-size: 29px;">{{$leftlicense ?? 0}} <br> </p>

                            </div>
                        </div>
                    </div>

                </div>

                <input type="hidden" name="amount" value="20000"> <!-- Amount in paise -->
                <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />

                <!-- <button id="rzp-button" onclick="razorpaySubmit();">Pay Now</button> -->




            </div>
        </div>
    </div>
</div>

@endif()



<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">All History</h4>

            </div><!-- end card header -->

            <div class="card-body">
                <div class="live-preview">
                    <div class="table-responsive">
                        <table class="table align-middle table-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th>SNO</th>
                                    <th>Company Name</th>
                                    <th>Coupen Used</th>
                                    <th>Plan Type</th>
                                    <th>License Credits</th>
                                    <th>Expiry Date</th>
                                    <th>Purchased On</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($primaryplans))
                                @foreach($primaryplans as $key=>$listing)

                                <tr>
                                    <th>{{++$key}}</th>
                                    <td> {{$listing->companies->name ?? ''}}</td>
                                    <td> {{$listing->coupen ?? ''}}</td>
                                    <td> {{$listing->type ?? ''}}</td>
                                    <td> {{$listing->quantity ?? ''}}</td>
                                    <td> {{$listing->expiry_date ?? ''}}</td>
                                    <td> {{$listing->created_at ?? ''}}</td>
                                    <td><span class="badge bg-success">Success</span></td>



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


</div>
<!-- <script>
        var form = document.getElementById("paymentForm");
        form.addEventListener("submit", function(event) {
            event.preventDefault();

            fetch(form.action, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        amount: form.amount.value
                    })
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    var options = {
                        key: 'rzp_test_uJ8AmKrSKblJO1',
                        amount: data.amount,
                        currency: 'INR',
                        name: 'Your Company Name',
                        description: 'Test Transaction',
                        order_id: data.id,
                        handler: function(response) {
                            // Handle success callback
                            console.log(response);
                        },
                        prefill: {
                            name: 'Test User',
                            email: 'test@example.com'
                        },
                        theme: {
                            color: '#3399cc'
                        }
                    };

                    var rzp = new Razorpay(options);
                    rzp.open();
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });
        });
    </script> -->

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    function chooseplan(value, price) {
        $('#creaditvalue').val(1);
        $('#licensetype').show();
        $('#plan_type').html(value);
        $('.plan_type').val(value);
        $('#ticket_price').html(price);
        $('#totalvalue').html(price);
        $('#totalvaluetobepay').val(price);
    }

    function applycoupen() {
        var amount = $('#totalvaluetobepay').val();
        var couponCode = $('input[name="coupen"]').val();

        if (couponCode === '') {
            $('#error').html('Coupen is required!');
            $('#error').css('color', 'red');
        } else {
            $('#error').html('');

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('coupen.applied') }}",
                data: {
                    'amount': amount,
                    'couponCode': couponCode,
                },
                type: 'POST',
                success: function(result) {

                    if (result.code == 401) {
                        $('#error').html(result.message);
                        $('#error').css('color', 'red');
                    }


                    if (result.code == 200) {
                        $('#error').html(result.message);
                        $('#error').css('color', 'green');
                        $('#totalvaluetobepay').val(result.amount);
                        $('#totalvalue').html(result.amount);
                        $('#coupenid').val(couponCode);
                        setTimeout(() => {
                            $('#hidecoupensection').hide();

                        }, 500);
                    }

                }
            });

        }



    }

    function decrease() {
        var permrcost = Number($('#ticket_price').html());

        var currentvalue = Number($('#creaditvalue').val());
        if (currentvalue >= 2) {
            $('#creaditvalue').val(currentvalue - 1);
            var currentvalue = Number($('#creaditvalue').val());
            $('#totalvalue').html(Number(permrcost * currentvalue));
            $('#totalvaluetobepay').val(Number(permrcost * currentvalue));

        }

    }

    function increase() {
        var permrcost = Number($('#ticket_price').html());

        var currentvalue = Number($('#creaditvalue').val());
        $('#creaditvalue').val(currentvalue + 1);
        var currentvalue = Number($('#creaditvalue').val());
        $('#totalvalue').html(Number(permrcost * currentvalue));
        $('#totalvaluetobepay').val(Number(permrcost * currentvalue));


    }

    function currentvalue(value) {
        var permrcost = Number($('#ticket_price').html());

        if (value == '') {
            $('#creaditvalue').val(1);
            $('#totalvalue').html(permrcost);
            $('#totalvaluetobepay').val(Number(permrcost));

        }
        if (value >= 1) {
            $('#creaditvalue').val(value);
            $('#totalvalue').html(Number(permrcost * value));
            $('#totalvaluetobepay').val(Number(permrcost * value));

        } else {
            $('#creaditvalue').val('');

        }
    }


    function razorpaySubmit(el) {
        var totalAmount = $('#totalvaluetobepay').val();


        var options = {
            key: "rzp_test_uJ8AmKrSKblJO1",
            amount: totalAmount * 100,
            name: "Pay for DVPRO",
            description: "Payment",
            netbanking: true,
            currency: "INR", // INR
            prefill: {
                name: "bHAVESH",
                email: "testing@gmail.com",
                contact: "9090909090"
            },
            notes: {
                soolegal_order_id: "",
            },
            handler: function(transaction) {

                document.getElementById('razorpay_payment_id').value = transaction.razorpay_payment_id;
                document.getElementById('razorpay-form').submit();
            },
            "modal": {
                "ondismiss": function() {
                    location.reload()
                }
            }
        };
        var razorpay_pay_btn, instance;
        var first_name = 'Bhaveshg';
        var mobile = 9898989898;

        if (typeof Razorpay == 'undefined') {
            setTimeout(razorpaySubmit, 200);
            if (!razorpay_pay_btn && el) {
                razorpay_pay_btn = el;
                el.disabled = true;
                el.value = 'Please wait...';
            }
        } else {
            if (!instance) {
                instance = new Razorpay(options);
                if (razorpay_pay_btn) {
                    razorpay_pay_btn.disabled = false;
                    razorpay_pay_btn.value = "Pay Now";
                }
            }
            instance.open();
        }

    }
</script>

@endsection