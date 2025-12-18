<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quality and Safety</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 20px;
            position: relative;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 4px;
            text-align: left;
        }

        th {
            background-color: #347ec9;
            color: white;
        }

        h1,
        p {
            margin: 0;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <table style="margin-bottom: 10px;">
        <tr>
            <td width="20%" style="vertical-align: top;">
                <img src="{{ public_path('images/icon.png') }}" alt="Company Logo" style="height:60px;">
            </td>
            <td width="50%" style="text-align: center;">
                <h1 style="font-size: 16px; font-weight: bold; text-transform: uppercase; margin-bottom: 4px;">
                    LIST OF ENGINEERING ORDER
                </h1>
                <p style="font-size: 12px;">Program: Re-assembly and Customizing</p>
            </td>
            <td width="30%" style="font-size: 10px; line-height: 1.4;">
                <p><strong>A/C Type:</strong> {{ $aircraft->aircraft_type }}</p>
                <p><strong>A/C Serial Number:</strong> {{ $aircraft->serial_number }}</p>
                <p><strong>A/C Registration:</strong> {{ $aircraft->registration }}</p>
                <p><strong>A/C Owner:</strong> {{ $aircraft->company->name }}</p>
            </td>
        </tr>
    </table>

    <!-- Engineering Order Tables -->
    @php
        $roman = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X'];
        $grouped = $orders->groupBy('type_order');
        $types = array_keys($grouped->toArray());
    @endphp

    @foreach ($types as $i => $type)
        @php $group = $grouped[$type]; @endphp

        <table style="margin-bottom: 10px;">
            <tr>
                <td colspan="7" style="border:1px solid black; background:#1f2937; color:white; font-weight:bold; padding:6px; font-size:12px;">
                    <strong>{{ $roman[$i] }}. {{ strtoupper($type) }}</strong>
                </td>
            </tr>
            <tr>
                <th>No</th>
                <th>Engineering Order No</th>
                <th>Subject Title</th>
                <th>Start Date</th>
                <th>Finish Date</th>
                <th>Insp Stamp</th>
                <th>Remarks</th>
            </tr>
            @foreach ($group as $index => $order)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $order->engineering_order_no }}</td>
                    <td>{{ $order->task->name }}</td>
                    <td>{{ $order->start_date }}</td>
                    <td>{{ $order->finish_date }}</td>
                    <td>{{ $order->insp_stamp }}</td>
                    <td style="text-align: center;">
                        @if ($order->finish_date && $order->insp_stamp)
                            <span style="color: green; font-weight: bold;">DONE</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    @endforeach

    <!-- Inspection Stamp Box -->
    <div style="
        position: absolute;
        bottom: 40px;
        left: 50%;
        transform: translateX(-50%);
        width: 220px;
        text-align: center;
    ">
        <table style="border: 1px solid black; width: 100%;">
            <tr>
                <td style="padding: 6px; font-weight: bold; font-size: 12px; background: #f3f4f6;">
                    INSPECTION STAMP
                </td>
            </tr>
            <tr>
                <td style="height: 100px; vertical-align: middle;">
                    <!-- Area kosong untuk cap -->
                </td>
            </tr>
        </table>
    </div>
</body>

</html>