<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 0.7cm 1cm 1.5cm 1cm;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 8.5px; /* Sedikit lebih kecil agar teks panjang tidak berantakan */
            margin: 0;
            padding: 0;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* Menjaga lebar kolom tetap konsisten */
        }

        th, td {
            border: 1px solid #000;
            padding: 3px 4px;
            word-wrap: break-word;
            vertical-align: middle;
        }

        /* --- Header Styles --- */
        .header-main td { border: 1px solid #000; }
        .no-border { border: none !important; }
        
        .title-box {
            text-align: center;
        }

        .title-text {
            font-size: 13px;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 2px;
        }

        /* --- Table Header Styles (Persis Gambar) --- */
        .bg-navy { background-color: #203764 !important; color: #ffffff !important; font-weight: bold; }
        .bg-blue-light { background-color: #4a86e8 !important; color: #ffffff !important; font-weight: bold; }
        
        .text-center { text-align: center; }
        .text-bold { font-weight: bold; }

        .category-row {
            background-color: #d9d9d9; /* Abu-abu lebih gelap sesuai contoh */
            font-weight: bold;
            font-size: 9px;
            text-align: left;
        }

        /* --- Footer & Stamp --- */
        .stamp-section {
            width: 100%;
            margin-top: 0px; /* Menempel tanpa celah */
        }

        .stamp-label {
            background-color: #f2f2f2;
            font-size: 8px;
            font-weight: bold;
            text-align: center;
            border: 1px solid #000;
            border-top: none;
        }

        .stamp-area {
            border: 1px solid #000;
            border-top: none;
            height: 55px;
            text-align: center;
        }
    </style>
</head>
<body>

    <table class="header-main" style="margin-bottom: 0px;">
        <tr>
            <td width="18%" class="text-center">
                <img src="{{ public_path('images/icon.png') }}" style="height: 40px;">
            </td>
            <td width="52%" class="title-box">
                <div class="title-text">LIST OF ENGINEERING ORDER</div>
                <div style="font-size: 9px;">Program : {{ $aircraft->program ?? 'Re-assembly and Customizing' }}</div>
            </td>
            <td width="30%" style="font-size: 8px; padding: 2px 5px;">
                <table class="no-border" width="100%">
                    <tr><td class="no-border" width="45%">A/C TYPE</td><td class="no-border">: {{ $aircraft->aircraft_type }}</td></tr>
                    <tr><td class="no-border">A/C SERIAL NUMBER</td><td class="no-border">: {{ $aircraft->serial_number }}</td></tr>
                    <tr><td class="no-border">A/C REGISTRATION</td><td class="no-border">: {{ $aircraft->registration }}</td></tr>
                    <tr><td class="no-border">A/C OWNER</td><td class="no-border">: {{ $aircraft->company->name ?? '-' }}</td></tr>
                </table>
            </td>
        </tr>
    </table>

    <table style="margin-top: -1px;">
        <thead>
            <tr class="bg-navy">
                <td width="30" rowspan="2" class="text-center">NO</td>
                <td width="100" rowspan="2" class="text-center">ENGINEERING ORDER NO.</td>
                <td rowspan="2" class="text-center">SUBJECT / TITLE</td>
                <td colspan="3" class="text-center">ENGINEERING ORDER</td>
                <td width="80" rowspan="2" class="text-center">REMARKS</td>
            </tr>
            <tr class="bg-blue-light">
                <td width="60" class="text-center" style="font-size: 7.5px;">START DATE</td>
                <td width="60" class="text-center" style="font-size: 7.5px;">FINISH DATE</td>
                <td width="65" class="text-center" style="font-size: 7.5px;">INSP. STAMP</td>
            </tr>
        </thead>

        @php
            $roman = ['I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VIII', 'IX', 'X'];
            $grouped = $orders->groupBy('type_order');
        @endphp

        @foreach ($grouped as $type => $group)
            <tbody>
                <tr class="category-row">
                    <td colspan="7">{{ $roman[$loop->index] }}. {{ strtoupper($type) }}</td>
                </tr>
                @foreach ($group as $index => $order)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $order->engineering_order_no }}</td>
                    <td style="text-align: left; padding-left: 8px;">{{ $order->task->name }}</td>
                    <td class="text-center">{{ $order->start_date }}</td>
                    <td class="text-center">{{ $order->finish_date }}</td>
                    <td class="text-center" style="font-weight: bold;">{{ $order->insp_stamp }}</td>
                    <td class="text-center" style="font-size: 8px; font-weight: bold;">
                        @if($order->finish_date && $order->insp_stamp)
                            <span style="color: #000;">DONE</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        @endforeach
    </table>

    <div class="stamp-section">
        <table style="width: 250px; margin: 0 auto; border-collapse: collapse;">
            <tr>
                <td class="stamp-label">INSPECTION STAMP</td>
            </tr>
            <tr>
                <td class="stamp-area">
                    @if($orders->whereNotNull('insp_stamp')->count() > 0)
                        <div style="margin-top: 5px;">
                            <img src="{{ public_path('images/qr-sample.png') }}" style="height: 35px; width: auto; opacity: 0.8;">
                        </div>
                    @endif
                </td>
            </tr>
        </table>
    </div>

    <script type="text/php">
        if ( isset($pdf) ) {
            $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal");
            $size = 9;
            $pageText = "Page : {PAGE_NUM} of {PAGE_COUNT}";
            $y = $pdf->get_height() - 30; // Posisi vertikal dari bawah
            $x = ($pdf->get_width() - $fontMetrics->get_text_width($pageText, $font, $size)) / 2;
            $pdf->page_text($x, $y, $pageText, $font, $size, array(0,0,0));
        }
    </script>
</body>
</html>