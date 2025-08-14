<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice</title>
    <style>
        .mainsection {
            display: flex;
            flex-direction: column;

        }

        .innercontent1 {
            width: 40%;
            padding-left: 10px;
            border-right: 2px solid black;
        }

        .header {
            border: 1px solid black;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        @media print {
    .printMe {
      display: none;
    }
  }
        .content {
            border: 1px solid black;
            display: flex;
            flex-direction: row;
            padding-left: 10px;
        }



        .header .headerborder {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .header .headerborder h1 {
            border-left: 2px solid black;
            border-top: 2px solid black;
            border-right: 2px solid black;
            margin: 0px;
            padding: 0px 109px;
        }



        .innercontent {
            border-right: 2px solid black;
            width: 10%;
            padding-left: 10px;
        }

        .headeraddress p {
            margin: 5px;
        }

        .main {
            width: 100%;
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .main h3 {
            border: 2px solid black;
            padding: 10px;
            justify-content: flex-start;
            align-items: flex-start;
            margin: 0px;
        }

        p {
            margin: 10px 0px;
            font-size: 15px;
            text-transform: capitalize !important   ;
            font-weight: 900;
        }

        table {
            border-collapse: collapse;
            font-weight: 800;
        }

        td {
            border: 1px solid black;
            padding: 0px 5px;
            font-weight: 800;
        }

        .table td {
            border: 0px solid black;
            font-weight: 800;
        }

        .bordleft {
            border-left: 1px solid black ! important;
            border-top: 1px solid black ! important;
        }

        .bordright {
            border-right: 1px solid black ! important;
            border-top: 1px solid black ! important;
        }

        .hr {
            border-bottom: 1px solid black;
            width: 70%;
            margin-left: 10%;
        }

        h2 {
            font-size: 18px;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body>
<div style="display: flex; justify-content: center; ">

    <div class="container" style="width: 210mm; height: 197mm">
        <table style="width: 100%; ">
            <tr>
                <table class="table" style="width: 100%;">
                    <tr>
                        <td class="headerimg bordleft" style="width: 40%; padding-left: 10px">
                            @if($leadM->firms->logo != '')
                            <img src="{{asset($leadM->firms->logo)}}" width="150">
                            @endif()

                        </td>
                        <td style="width: 20%; border-top: 1px solid black; text-align: center">
                            <h2 style="margin: 0px;">Invoice #{{$leadM->invoicenumber}}</h2>
                            <p>Date: {{$leadM->invoice_date}}</p>
                        </td>
                        <td class="headeraddress bordright" style="width: 40%; text-align: right">
                            <p style="font-size: 16px; font-weight: 900; font-family: sans-serif;"><i>{{$leadM->firms->name ?? ''}}</i></p>
                            <p>{{$leadM->firms->address ?? ''}}</p>
                            <p>{{$leadM->firms->phone ?? ''}}</p>
                        </td>
                    </tr>
                </table>
            </tr>
            <tr>
                <table style="width: 100%;">
                    <tr>
                        <td colspan="4" style="text-align:center">
                            <h4 style="margin: 2px;text-align:center">Transporter Information</h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            <p>TRANSPORTER </p>
                            <p>TRUCK NUMBER</p>
                            <p>DRIVER NUMBER</p>
                            <p>QUANTITY</p>
                            <p>RATE </p>
                            <p>TOTAL</p>
                        </td>
                        <td style="width: 50%">
                            <p> {{$leadM->assignleads->user->name ??  ''}} </p>
                            <p> {{$leadM->truck_no ?? ''}} </p>
                            <p> {{$leadM->phone ?? ''}} </p>
                            <p> {{$leadM->quantity ?? ''}} </p>
                            <p> ₹ {{$leadM->rate ?? ''}} </p>
                            <p>₹ {{$leadM->total ?? ''}} </p>
                        </td>

                    </tr>

                </table>
           
           
            <tr>
            <table style="width: 100%;">
                    <tr>
                        <td colspan="4" style="text-align:center">
                            <h4 style="margin: 2px;text-align:center">Payment Information</h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            <p>ADVANCE :</p>
                            <p>ADVANCE DONE BY 	:</p>
                            <p>TDS:</p>
                            <p>COMMISSION  : </p>
                            <p>HOLD AMOUNT :</p>
                            <p>Mandi Kagaj	</p>
                            <p>Dharamkanta	</p>
                            <p>Labour Charge		</p>
                            <p>Miscellaneous Expense?		</p>
                            <p>Miscellaneous Amount			</p>
                            <p>Remaining Amount			</p>
                        </td>
                        <td style="width: 50%">
                            <p> ₹ {{$leadM->advance ??  ''}} </p>
                            <p> {{$leadM->advanceby ?? ''}} / {{$leadM->advancebyname ?? ''}} </p>
                            <p>₹ {{$leadM->tds}}</p>
                            <p>₹ {{$leadM->commission ?? ''}} </p>
                            <p> ₹ {{$leadM->hold_amount ?? ''}} </p>
                            <p> ₹ {{$leadM->mandi_kagaj ?? ''}} </p>
                            <p> ₹ {{$leadM->dharamkanta ?? ''}} </p>
                            <p> ₹ {{$leadM->hammali ?? ''}} </p>
                            <p> {{$leadM->miscellaneous ?? 'no Miscellaneous Expense '}} </p>
                            <p> ₹ {{$leadM->miscellaneousexpense ?? '0'}} </p>
                            <p> ₹ {{$leadM->remaining ?? ''}} </p>
                        </td>

                    </tr>

                </table>
            </tr>

            <tr>
            <table style="width: 100%;">
                    <tr>
                        <td colspan="4" style="text-align:center">
                            <h4 style="margin: 2px;text-align:center">Bank Information</h4>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 60%">
                            <p>ACCOUNT HOLDER NAME :</p>
                            <p>ACCOUNT NUMBER	:</p>
                            <p>BANK NAME : </p>
                            <p>IFSC CODE  : </p>
                            <p>Phone Pay   : </p>
                            
                        </td>
                        <td style="width: 50%">
                            <p> {{$leadM->holder ??  ''}} </p>
                            <p> {{$leadM->account_number ?? ''}}  </p>
                            <p>{{$leadM->ifsc   ?? ''}} </p>
                            <p>{{$leadM->bankname ?? ''}} </p>
                            <p>{{$leadM->phonepay_number ?? ''}} </p>
                            
                        </td>

                    </tr>
                     <tr>
                        <td style="width: 60%">
                            <p>Final AMOUNT TO BE PAID :</p>
                            <p>Pahuch ACCOUNT HOLDER NAME :</p>
                            <p>Pahuch ACCOUNT NUMBER	:</p>
                            <p> Pahuch BANK NAME : </p>
                            <p> Pahuch IFSC CODE  : </p>
                            <p>Phone Pay   : </p>

                            
                        </td>
                        <td style="width: 50%">
                            <p> {{$leadM->remaining_hold_amount ??  ''}} </p>
                            <p> {{$leadM->holder1 ??  ''}} &nbsp;</p>
                            <p> {{$leadM->account_number1 ?? ''}} &nbsp; </p>
                            <p>{{$leadM->ifsc1   ?? ''}} &nbsp;</p>
                            <p>{{$leadM->bankname1 ?? ''}} &nbsp;</p>
                            <p>{{$leadM->phonepay_number1 ?? ''}} &nbsp;</p>

                            
                        </td>

                    </tr>

                </table>
            </tr>
           

            <tr>
                <table class="table" style="width: 100%; border: 1px solid black;">
                    <tr>
                        <td style="text-align:center">
                            <p>Remaining Balance amount of &nbsp; ₹{{$leadM->remaining ?? ''}}    &nbsp; has been transfered to   {{$leadM->account_number ?? ''}} account</p>
                        </td>
                    </tr>
                </table>
            </tr>
        </table>


        <div class="row">
            <div class="col-md-12" style="text-align:center">
                <a href="#" class="printMe">Print</a>
            </div>
        </div>


    </div>
</div>
</body>

<script>
    $('.printMe').click(function() {
        window.print();
    });
</script>


</html>