<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KMS - Quality & Safety</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-doughnutlabel"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans">

    <!-- Include Navbar -->
    @include('layouts.navbar')
    <div class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/hanggar.png') }}');">
        <div class="container mx-auto px-4 md:px-6 lg:px-12 py-12">
            <h1 class="text-center text-white text-2xl sm:text-3xl md:text-4xl font-bold uppercase mb-8">
                CERTIFICATE
            </h1>

            <!-- Grid untuk Responsivitas -->
            @php
                use App\Models\Certificate;
                $certificates = Certificate::all();
            @endphp

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
                @foreach ($certificates as $c)
                    <div
                        class="bg-blue-900 bg-opacity-80 shadow-lg rounded-lg p-2 w-full sm:w-200 mx-auto transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                        <img src="{{ asset('storage/certificates/' . $c->file_path) }}" alt="{{ $c->judul }}"
                            class="w-full h-auto object-cover rounded-md">
                        <p class="text-white text-center mt-2 font-semibold">{{ $c->judul }}</p>
                        <p class="text-gray-300 text-center text-sm">{{ $c->issued_by }} - {{ $c->date_issued }}</p>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    @include('layouts.footer')
