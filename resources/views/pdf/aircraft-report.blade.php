<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quality and Safety</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-doughnutlabel"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
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

<body style="font-family: Arial, sans-serif; font-size: 10px; margin: 20px;">

    <!-- Wrapper utama -->
    <table width="100%" style="border-collapse: collapse; margin-bottom: 10px;">
        <tr>
            <!-- Logo -->
            <td width="20%" style="vertical-align: top;">
                <img src="{{ public_path('images/icon.png') }}" alt="Company Logo" style="height:60px;">
            </td>

            <!-- Title -->
            <td width="50%" style="text-align: center;">
                <h1 style="font-size: 16px; font-weight: bold; text-transform: uppercase; margin-bottom: 4px;">
                    LIST OF ENGINEERING ORDER
                </h1>
                <p style="font-size: 12px;">Program: Re-assembly and Customizing</p>
            </td>

            <!-- Aircraft Info -->
            <td width="30%" style="font-size: 10px; line-height: 1.4;">
                <p><strong>A/C Type:</strong> {{ $aircraft->aircraft_type }}</p>
                <p><strong>A/C Serial Number:</strong> {{ $aircraft->serial_number }}</p>
                <p><strong>A/C Registration:</strong> {{ $aircraft->registration }}</p>
                <p><strong>A/C Owner:</strong> {{ $aircraft->company->name }}</p>
            </td>
        </tr>
    </table>

    <!-- Tabel EO -->
    @php
        $roman = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X'];
    @endphp
    @php
        $grouped = $orders->groupBy('type_order');
        $types = array_keys($grouped->toArray());
    @endphp

    @foreach ($types as $i => $type)
        @php $group = $grouped[$type]; @endphp

        <table width="100%" style="border-collapse: collapse; margin:0 0 10px 0;">
            <!-- Judul grup sebagai baris tabel -->
            <tr>
                <td colspan="7"
                    style="border:1px solid black; background:#1f2937; color:white; font-weight:bold; padding:6px; font-size:12px;">

                    <strong>{{ $roman[$i] }}. {{ strtoupper($type) }}</strong>
                </td>
            </tr>
            <tr>
                <th style="background-color: #347ec9; color: white; border: 1px solid black; padding: 4px;">
                    No</th>
                <th style="background-color: #347ec9; color: white; border: 1px solid black; padding: 4px;">
                    Engineering Order No</th>
                <th style="background-color: #347ec9; color: white; border: 1px solid black; padding: 4px;">
                    Subject
                    Title</th>
                <th style="background-color: #347ec9; color: white; border: 1px solid black; padding: 4px;">
                    Start
                    Date</th>
                <th style="background-color: #347ec9; color: white; border: 1px solid black; padding: 4px;">
                    Finish
                    Date</th>
                <th style="background-color: #347ec9; color: white; border: 1px solid black; padding: 4px;">
                    Insp
                    Stamp</th>
                <th style="background-color: #347ec9; color: white; border: 1px solid black; padding: 4px;">
                    Remarks
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach ($group as $index => $order)
                    <tr>
                        <td style="border: 1px solid black; padding: 4px;">{{ $index + 1 }}</td>
                        <td style="border: 1px solid black; padding: 4px;">
                            {{ $order->engineering_order_no }}</td>
                        <td style="border: 1px solid black; padding: 4px;">{{ $order->task->name }}</td>
                        <td style="border: 1px solid black; padding: 4px;">{{ $order->start_date }}</td>
                        <td style="border: 1px solid black; padding: 4px;">{{ $order->finish_date }}</td>
                        <td style="border: 1px solid black; padding: 4px;">{{ $order->insp_stamp }}</td>
                        <td style="border: 1px solid black; padding: 4px; text-align: center;">
                            @if ($order->finish_date && $order->insp_stamp)
                                <span style="color: green; font-weight: bold;">DONE</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
    </div>
    <!-- Section Inspection Stamp -->
    <div class="mt-6 text-center">
        <h3 class="text-sm font-semibold">INSPECTION STAMP.</h3>
        <div class="flex justify-center mt-2">
            <img src="{{ asset('images/inspection_stamp.png') }}" alt="Inspection Stamp" class="h-16">
        </div>
    </div>

    </div>

</body>

</html>
