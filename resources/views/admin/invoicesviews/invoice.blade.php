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
            margin: 20px auto; /* Center the container */
            background-color: #fff;
            padding: 30px; /* Adjusted padding for better spacing */
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
        }

        /* Header Section */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px; /* Adjusted margin */
        }
        .header img {
            width: 120px; /* Increased width for better visibility */
            height: auto;
        }
        .header h1 {
            font-size: 30px; /* Increased font size */
            color: #333;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 16px; /* Increased font size */
            color: #555;
        }

        /* Company & Invoice Details */
        .details-flex {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px; /* Adjusted margin */
        }
        .company-info, .invoice-info {
            width: 48%;
        }
        .company-info h2, .invoice-info h2 {
            font-size: 18px; /* Increased heading size */
            color: #000;
            margin-bottom: 10px; /* Adjusted margin */
        }
        .company-info p, .invoice-info p {
            font-size: 14px; /* Increased paragraph size */
            color: #333;
            margin-bottom: 5px; /* Adjusted margin */
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px; /* Adjusted margin */
        }
        th, td {
            padding: 12px; /* Increased padding for better readability */
            text-align: left;
            font-size: 12px; /* Increased font size */
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
            margin-top: 10px; /* Adjusted margin */
            text-align: right;
        }
        .totals p {
            font-size: 14px; /* Increased font size */
            margin-bottom: 5px;
        }
        .totals strong {
            font-size: 16px; /* Increased font size */
            color: #000;
        }

        /* Bank Details */
        .company-info {
            margin-top: 10px; /* Adjusted margin */
        }

        /* Footer */
        .footer {
            display: flex; /* Use flex to align items */
            justify-content: space-between; /* Space between text and stamp */
            align-items: center; /* Center vertically */
            font-size: 14px; /* Increased font size */
            color: #666;
            margin-top: 30px; /* Adjusted margin */
        }
        .footer p {
            margin-bottom: 5px; /* Adjusted margin */
        }
        .footer img {
            width: 100px; /* Width of the stamp */
            height: auto;
        }

        /* Print Styles */
        @media print {
            body {
                background-color: white;
                margin: 0;
            }
            .container {
                padding: 10px; /* Less padding for print */
                margin: 0; /* No margins for print */
                width: 100%; /* Full width for print */
            }
            .header, .details-flex, .totals, .footer, table {
                page-break-inside: avoid; /* Avoid breaks in these sections */
            }
            th, td {
                padding: 10px; /* Adjusted padding */
                font-size: 12px; /* Increased font size */
            }
            .header h1 {
                font-size: 28px; /* Slightly smaller header font for print */
            }
            .footer {
                margin-top: 10px; /* Reduced margin */
                align-items: flex-start; /* Align items at the start */
            }
            .footer img {
                width: 80px; /* Smaller stamp for print */
                margin-top: 5px; /* Slight margin for visual space */
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
            </div>
            <div class="invoice-info">
                <h2>Invoice Details</h2>
                <p><strong>Invoice #:</strong> {{$detail->unique_id ?? ''}}</p>
                <p><strong>Invoice Date:</strong> {{$detail->invoice_date ?? ''}}</p>
                <p><strong>Due Date:</strong> {{$detail->invoice_due ?? ''}}</p>
            </div>
        </div>

        <!-- Customer and Shipping Details -->
        <div class="details-flex">
            <div class="company-info">
                <h2>Billing Information</h2>
                <p><strong>  {{ strtoupper($detail->company) ?? ''}}</strong></p>
                <p><strong>  {{ strtoupper($detail->co) ?? ''}}</strong></p>
                <p>GSTIN: {{$detail->gst ?? ''}}</p>
                <p>{{$detail->address ?? ''}}</p>
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
            <p><strong>IGST @18%:</strong> ₹ {{$detail->totalCost - $detail->subtotal }}</p>
            <p><strong>Total Amount Payable: ₹ {{$detail->totalCost ?? ''}}</strong></p>
        </div>

        <!-- Bank Details -->
        <div class="company-info">
            <h2>Bank Details</h2>
            <p><strong>Bank:</strong> IDFC FIRST Bank</p>
            <p><strong>Account #:</strong> 10154826072</p>
            <p><strong>IFSC Code:</strong> IDFB0020195</p>
            <p><strong>Branch:</strong> NEW DELHI-KIRTI NAGAR BRANCH</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div>
                <p>For <strong>VARANITI CONSULTANCY SERVICES PRIVATE LIMITED</strong></p>
                <p>Authorized Signatory</p>
            </div>
            <img src="{{asset('sample/company/stamp.png')}}" alt="Company Stamp">
        </div>
    </div>

</body>
</html>
