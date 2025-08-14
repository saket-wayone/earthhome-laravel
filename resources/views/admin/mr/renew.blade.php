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
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center">
                <h4 class="card-title mb-0 flex-grow-1">Purchase <b> {{$choosedplan->type ?? ''}}</b> Plan</h4>

            </div><!-- end card header -->

            <div class="card-body">
                <div class="live-preview">
                    <div class="row">
                        <div class="col-xxl-6 col-md-9">
                            <div class="card" id="demo">
                                <div class="row">
                                    <div class="col-md-12" id="licensetype">
                                        <form action="{{ route('mr.renewupdate') }}" method="post" id="razorpay-form">
                                            @csrf()


                                            <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />

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
                                                                <li class="list-inline-item">Plan Type : <span class="fw-medium" id="plan_type">{{$choosedplan->type ?? ''}}




                                                                    </span></li>
                                                            </ul>
                                                            <div class="card-footer">
                                                    <div class="row align-items-center gy-3">
                                                        
                                                        <div class="col-sm">
                                                            <div class="input-step">
                                                                <p>Total Selected Plans : {{$selectedplans ?? ''}}
                                                                
                                                                
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-sm">
                                                            <a class="btn  btn-success" onclick="razorpaySubmit();">Buy</a>

                                                        </div> -->
                                                        <!-- <div class="col-sm-auto">
                                                                <div class="d-flex align-items-center gap-2 text-muted">
                                                                    <div>Total :</div>
                                                                    <h5 class="fs-14 mb-0">₹ <span class="product-line-price" id="totalvalue"></span></h5>
                                                                </div>
                                                            </div> -->
                                                    </div>
                                                </div>

                                                            <input type="hidden" name="plan_type" class="plan_type" value="{{$choosedplan->type ?? ''}}">
                                                            <div style="display: flex;" id="hidecoupensection" class="gap-3">
                                                                <div>
                                                                    <input type="text" name="coupen" placeholder="Apply Coupon if Any" class="form-control">
                                                                </div>
                                                                <div>
                                                                    <a class="btn  btn-success btn-sm" onclick="applycoupen();">Apply Coupon</a>
                                                                </div>




                                                            </div>
                                                            <span id="error"></span>
                                                            <input type="hidden" name="coupenid" id="coupenid">
                                                            
                                                            

                                                        </div>
                                                        <div class="col-sm-auto">
                                                            <div class="text-lg-end">
                                                                <p class="text-muted mb-1">Per License Cost ({{$choosedplan->price ?? ''}})</p>
                                                                <h5 class="fs-14">₹<span id="ticket_price" class="product-price"> {{$totalamount ?? ''}}</span></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- card body -->
                                                
                                                <!-- end card footer -->
                                            </div>
                                        
                                    </div>

                                </div><!--end row-->
                            </div>

                        </div>
                        <div class="col-md-6  col-xxl-5">

                            <div class="card-body ">
                                <div class="">
                                    <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                        <tbody>
                                            <tr>
                                                <td>Sub Total</td>
                                                <td class="text-end">₹
                                                    <span class="product-line-price" id="totalvalue">{{$totalamount ?? ''}}</span>
                                                    <input type="hidden" name="totalamount"  value="{{$totalamount ?? ''}}" id="totalvaluetobepay">


                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Tax (18%)</td>
                                                <td class="text-end">₹ <span class="product-line-price" id="taxamount"> {{$totalamount *0.18}}</span>

                                                    <input type="hidden" name="taxpaid" id="taxpaid" value="{{$totalamount *0.18}}">


                                                </td>
                                            </tr>
                                            <tr>
                                                <td> Coupon Discount <small class="text-muted"></small></td>
                                                <td class="text-end">₹ <span class="product-line-price" id="coupen_discount">0</span>

                                                    <input type="hidden" name="coupenappliedamount" id="coupenappliedamount" value="0">




                                                </td>
                                            </tr>

                                            <tr class="border-top border-top-dashed fs-15">
                                                <th scope="row">Total Amount</th>
                                                <th class="text-end">₹ <span class="product-line-price" id="totalmoney">{{$totalamount+$totalamount *0.18}}</span>
                                                <input type="hidden" name="totalmoneyform" id="totalmoneyform" value="{{$totalamount+$totalamount * 0.18}}">

                                            
                                            
                                            </th>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <!--end table-->
                                </div>

                                <div class="hstack gap-2 justify-content-end d-print-none mt-4">

                                    <a href="javascript:void(0);" class="btn btn-primary"  onclick="razorpaySubmit();">Make Payment</a>
                                </div>
                                <!-- <button type="submit" class="btn btn-primary" >test</button> -->
                            </div>
                            <!--end card-body-->

                        </div>
                    </div>
                    </form>


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
    function updatetotalmoney() {

        var subtotal = Number($('#totalvaluetobepay').val());
        var tax = Number($('#taxpaid').val());
        var discount = Number($('#coupenappliedamount').val());
        var maketotal = subtotal + tax - discount;
        $('#totalmoney').html(maketotal);
        $('#totalmoneyform').val(maketotal);
    }

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
        // var amount = $('#totalvaluetobepay').val();

        var amount = Number($('#totalvaluetobepay').val()) + Number($('#taxpaid').val());
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
                        // $('#totalvaluetobepay').val(result.amount);
                        // $('#totalvalue').html(result.amount);
                        $('#coupenid').val(couponCode);
                        $('#coupenappliedamount').val(result.discountamount);
                        $('#coupen_discount').html(result.discountamount);
                        updatetotalmoney();
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
            var totalvalue = Number(permrcost * currentvalue);

            $('#totalvalue').html(totalvalue);
            $('#totalvaluetobepay').val(totalvalue);
            var tax = totalvalue * 0.18;
            $('#taxamount').html(tax);
            $('#taxpaid').val(tax);
        }
        updatetotalmoney();

    }



    function increase() {
        var permrcost = Number($('#ticket_price').html());

        var currentvalue = Number($('#creaditvalue').val());
        $('#creaditvalue').val(currentvalue + 1);
        var currentvalue = Number($('#creaditvalue').val());
        var totalvalue = Number(permrcost * currentvalue);
        $('#totalvalue').html(totalvalue);
        $('#totalvaluetobepay').val(totalvalue);

        var tax = totalvalue * 0.18;
        $('#taxamount').html(tax);
        $('#taxpaid').val(tax);

        updatetotalmoney();





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
        updatetotalmoney();

    }


    function razorpaySubmit(el) {
        var totalAmount = $('#totalmoneyform').val();


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