<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Summary of Work Package</title>
    <style>
        @page {
            margin: 50px 30px;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            position: relative;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            height: 60px;
        }

        .title {
            text-align: center;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .footer {
            position: fixed;
            bottom: -30px;
            left: 0;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
        }

        th {
            background: #eee;
        }

        .section {
            background: #ddd;
            font-weight: bold;
        }

        .aircraft-performed {
            border: 1px solid #000;
            height: 100px;
            margin-top: 30px;
            padding: 10px;
        }

        .signature-block td {
            height: 120px;
            vertical-align: bottom;
            text-align: center;
        }
    </style>
</head>

<body>

    {{-- Logo hanya di halaman pertama --}}
    <div class="logo">
        <img src="{{ public_path('images/icon.png') }}" alt="Company Logo" style="height:60px;">

    </div>

    <div class="title">SUMMARY OF WORK PACKAGE</div>

    <div>
        <p><strong>AIRCRAFT TYPE:</strong> {{ strtoupper($summary->program->aircraft_type) }}</p>
        <p><strong>SERIAL NO:</strong> {{ strtoupper($summary->program->serial_number) }}</p>
        <p><strong>REGISTRATION:</strong> {{ strtoupper($summary->program->registration) }}</p>
        <p><strong>OWNER:</strong> {{ strtoupper($summary->program->company->name) }}</p>
        <p><strong>CONTRACT NO:</strong> {{ strtoupper($summary->program->contract_no) }}</p>
        <p><strong>WBS No:</strong> {{ strtoupper($summary->program->wbs_no) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>AIRCRAFT DELIVERY DOCUMENT</th>
                <th>STATUS</th>
                <th>REMARKS</th>

            </tr>
        </thead>
        <tbody>
            @php
                $grouped = $summary->items->groupBy('section');
                $rowNumber = 1;
            @endphp

            @foreach ($grouped as $section => $sectionItems)
                <tr class="section">
                    <td colspan="4">{{ $section }}</td>
                </tr>
                @foreach ($sectionItems as $item)
                    <tr>
                        <td>{{ $rowNumber++ }}</td>
                        <td>{{ $item->item }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->remarks }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    <div class="aircraft-performed">
        <strong>AIRCRAFT PERFORMED :</strong><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>

    <table class="signature-block" style="width:100%; border:none; margin-top:40px;">
        <tr>
            <td>
                <strong>Prepared by:</strong><br><br>
                <br><br><br>
                (...............................)<br>
                Date: .......................
            </td>
            <td>
                <strong>Checked by:</strong><br><br>
                <br><br><br>
                (...............................)<br>
                Date: .......................
            </td>
            <td>
                <strong>Approved by:</strong><br><br>
                <br><br><br>
                (...............................)<br>
                Date: .......................
            </td>
        </tr>
    </table>

    <div class="footer">
        <p style="margin-top:20px;">QC-AS-003 Summary of Work Package<br>
            Rev. 2, Issue Date: Jun. 24, 2022</p>
    </div>

</body>

</html>
