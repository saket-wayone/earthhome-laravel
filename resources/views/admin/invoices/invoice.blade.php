<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Invoice VOL/2024/110</title>
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            max-width: 900px;
            margin: 20px auto;
            /* Center the container */
            background-color: #fff;
            padding: 30px;
            /* Adjusted padding for better spacing */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
        }

        /* Header Section */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            /* Adjusted margin */
        }

        .header img {
            width: 120px;
            /* Increased width for better visibility */
            height: auto;
        }

        .header h1 {
            font-size: 30px;
            /* Increased font size */
            color: #333;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 16px;
            /* Increased font size */
            color: #555;
        }

        /* Company & Invoice Details */
        .details-flex {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            /* Adjusted margin */
        }

        .company-info,
        .invoice-info {
            width: 48%;
        }

        .company-info h2,
        .invoice-info h2 {
            font-size: 18px;
            /* Increased heading size */
            color: #000;
            margin-bottom: 10px;
            /* Adjusted margin */
        }

        .company-info p,
        .invoice-info p {
            font-size: 14px;
            /* Increased paragraph size */
            color: #333;
            margin-bottom: 5px;
            /* Adjusted margin */
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            /* Adjusted margin */
        }

        th,
        td {
            padding: 12px;
            /* Increased padding for better readability */
            text-align: left;
            font-size: 12px;
            /* Increased font size */
        }

        th {
            background-color: #000;
            color: white;
            font-weight: bold;
            text-transform: uppercase;
        }

        td {
            border: 1px solid #ddd;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        /* Total Section */
        .totals {
            margin-top: 10px;
            /* Adjusted margin */
            text-align: right;
        }

        .totals p {
            font-size: 14px;
            /* Increased font size */
            margin-bottom: 5px;
        }

        .totals strong {
            font-size: 16px;
            /* Increased font size */
            color: #000;
        }

        /* Bank Details */
        .company-info {
            margin-top: 10px;
            /* Adjusted margin */
        }

        /* Footer */
        .footer {
            /* display: flex; */
            /* Use flex to align items */
            justify-content: space-between;
            /* Space between text and stamp */
            align-items: center;
            /* Center vertically */
            font-size: 14px;
            /* Increased font size */
            color: #666;
            margin-top: 30px;
            /* Adjusted margin */
        }

        .footer p {
            margin-bottom: 5px;
            /* Adjusted margin */
        }

        .footer img {
            width: 100px;
            /* Width of the stamp */
            height: auto;
        }

        /* Print Styles */
        @media print {
            body {
                background-color: white;
                margin: 0;
            }

            .container {
                padding: 10px;
                /* Less padding for print */
                margin: 0;
                /* No margins for print */
                width: 100%;
                /* Full width for print */
            }

            .header,
            .details-flex,
            .totals,
            .footer,
            table {
                page-break-inside: avoid;
                /* Avoid breaks in these sections */
            }

            th,
            td {
                padding: 10px;
                /* Adjusted padding */
                font-size: 12px;
                /* Increased font size */
            }

            .header h1 {
                font-size: 28px;
                /* Slightly smaller header font for print */
            }

            .footer {
                margin-top: 10px;
                /* Reduced margin */
                align-items: flex-start;
                /* Align items at the start */
            }

            .footer img {
                width: 80px;
                /* Smaller stamp for print */
                margin-top: 5px;
                /* Slight margin for visual space */
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <!-- Header Section with Logo -->
        <div class="header">
            <div>
                <h1>Tax Invoice</h1>
                <p>Original for Recipient</p>
            </div>
            <img src="{{asset('sample/company/volvrit_logo.webp')}}" alt="Company Logo">
        </div>

        <!-- Company and Invoice Details -->
        <div class="details-flex">
            <div class="company-info">
                <h2>Company Information</h2>
                <p><strong>VARANITI CONSULTANCY SERVICES PRIVATE LIMITED</strong></p>
                <p>GSTIN: 07AAJCV3439J1ZY</p>
                <p>DLF Industrial Area, Plot No. A-1, 2nd Floor</p>
                <p>Najafgarh Road, Moti Nagar, New Delhi</p>
                <p>Mobile: +91 9711279537 | Email: info@varaniti.com</p>
                <p> Pan No.: AAJCV3439J</p>

            </div>
            <div class="invoice-info">
                <h2>Invoice Details</h2>
                <p><strong>Invoice #:</strong> {{$detail->unique_id ?? ''}}</p>
                <p><strong>Invoice Date:</strong> {{$detail->invoice_date ?? ''}}</p>
                <p><strong>Due Date:</strong> {{$detail->invoice_due ?? ''}}</p>
            </div>
        </div>

        <!-- Customer and Shipping Details -->
        <div class="details-flex ">
            <div class="company-info">
                <h2>Billing Information</h2>
                <p><strong> {{ strtoupper($detail->company) ?? ''}}</strong></p>
                <p><strong> {{ strtoupper($detail->co) ?? ''}}</strong></p>
                <p><strong> {{ $detail->email ?? ''}}</strong></p>
                <p><strong> {{ $detail->phone ?? ''}}</strong></p>
                <p>GSTIN: {{$detail->gst ?? ''}}</p>
                <p>{{$detail->address ?? ''}}</p>
            </div>
            <div class="company-info" style="margin-left: 500px;">
                @php
                $upiUrl = 'upi://pay?pa=varaniti1@fbl&pn=Volvrit&am=' . $detail->totalCost . '&cu=INR';
                @endphp
                {!! DNS2D::getBarcodeHTML($upiUrl, 'QRCODE', 4, 4) !!}
                <h5 style="margin-left: 22px !important; margin-top:20px;">SCAN AND PAY</h5>


            </div>
        </div>

        <!-- Table Section -->
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($detail->services))
                @foreach(json_decode($detail->services) as $key=> $list)
                @php
                $showarr = json_decode($list);
                @endphp
                <tr>

                    <td>{{++$key}}</td>
                    <td>{{$showarr->description ?? ''}}</td>
                    <td>₹ {{$showarr->amount ?? ''}}</td>
                </tr>
                @endforeach()
                @endif()
            </tbody>
        </table>

        <!-- Total Section -->
        <div class="totals">
            <p><strong>Subtotal:</strong> ₹ {{$detail->subtotal ?? ''}}</p>
            @if($detail->igst ==1)
            <p><strong>IGST @18%:</strong> ₹ {{$detail->totalCost - $detail->subtotal }}</p>

            @else
            <p><strong>CGST @9%:</strong> ₹ {{($detail->totalCost - $detail->subtotal)/2 }}</p>
            <p><strong>SGST @9%:</strong> ₹ {{($detail->totalCost - $detail->subtotal)/2 }}</p>


            @endif
            <p><strong>Total Amount Payable: ₹ {{$detail->totalCost ?? ''}}</strong></p>
        </div>
        <div style="display: flex; margin-top:60px;">
            <div class="company-info">
                <h2>Bank Details</h2>
                <p><strong>Bank:</strong> FEDRAL BANK LIMITED </p>
                <p><strong>Account #:</strong> 18200200004584</p>
                <p><strong>IFSC Code:</strong> FDRL0001820</p>
                <p><strong> Account Type:</strong> CURRENT ACCOUNT</p>


                <p><strong>Branch:</strong> Kirti nagar, west delhi, New delhi, 110015</p>
            </div>
            <div class="company-info" style="
    text-align: end;
">
                <img src="{{asset('sample/company/stamp.png')}}" style="width: 100px;" alt="Company Stamp">
                <div>
                    <p>Authorized Signatory</p>
                </div>
            </div>


        </div>

        <!-- Bank Details -->
        <!-- Print Button -->
        <div class="no-print" style="text-align: center; margin-top: 20px;">
            <button onclick="window.print()" style="background:black;color:white;padding:10px">Print Invoice</button>
        </div>

        <!-- Footer -->
        <div class="footer" style="text-align: center !important;">
            <p> <strong>VARANITI CONSULTANCY SERVICES PRIVATE LIMITED</strong></p>

        </div>
    </div>

</body>

</html>