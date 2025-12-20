<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KMS - Quality & Safety</title>
     <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

    <!-- Include Navbar -->
    @include('layouts.navbar')
<div class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/hanggar.png') }}');">
    <div class="bg-black bg-opacity-50 min-h-screen flex flex-col items-center justify-start py-10">
  <div class="container mx-auto px-4 md:px-6 lg:px-12 py-12">
        <h1 class="text-center text-white text-2xl sm:text-3xl md:text-4xl font-bold uppercase mb-8">
            CAPABILITIES
        </h1>  
<!-- MRO Section -->
<!-- MRO Section -->
<div class="bg-blue-900 bg-opacity-90 text-white p-6 rounded-lg shadow-lg max-w-6xl mx-auto flex flex-col md:flex-row items-center md:items-start">
    
    <!-- Gambar di sebelah kiri -->
    <div class="w-full md:w-1/3 flex justify-center md:justify-start">
        <img src="{{ asset('images/hanggar.png') }}" alt="MRO Image"
            class="w-full max-w-xs md:max-w-sm rounded-lg shadow-lg">
    </div>

    <!-- Teks di sebelah kanan -->
    <div class="w-full md:w-2/3 md:pl-6 mt-6 md:mt-0">
        <h2 class="text-xl sm:text-2xl md:text-3xl font-semibold mb-4">
            MAINTENANCE, REPAIR & OVERHAUL (MRO)
        </h2>
        <p class="text-md sm:text-lg leading-relaxed">
            SBU Aircraft Maintenance Organization Part 145 division offer various services to the client. We are working close with the OEM and local authority (DGCA indonesi) to ensure our maintenance activities reach the standard set by the manufacturer and at the sam time fulfiv client requirement or expectation. The maintenance activities offered could be according to the client Aircraft Maintenance Program (AMP) or customized to their operation needs. Among other, we offered standard routine maintenance services as follows :
        </p>

        <!-- List dengan Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5">
            <ul class="list-disc list-inside space-y-2">
                <li>Aircraft Schedule Maintenance Inspection</li>
                <li>Radio Annual Inspection</li>
                <li>Annual Compass Swing</li>
                <li>SB’s & AD’s Compliance</li>
                <li>Aircraft Software Database Updates</li>
                <li>ELT Programming</li>
                <li>Special Inspection Pilot Static Calibration</li>
                <li>Defect Rectification</li>
                <li>Avionic Upgrades & Refurbishment</li>
                <li>Avionic Workshop (Battery, ELT & Others)</li>
                <li>Mechanical Workshop & NDT</li>
            </ul>
        </div>
    </div>
    </div>
</div>



        <!-- DOA Section -->
<!-- MRO Section -->
<div class="bg-blue-900 bg-opacity-90 text-white p-6 rounded-lg shadow-lg max-w-6xl mx-auto flex flex-col md:flex-row-reverse items-center md:items-start">
    
    <!-- Gambar di sebelah kanan -->
    <div class="w-full md:w-1/3 flex justify-center md:justify-end">
        <img src="{{ asset('images/hanggar.png') }}" alt="MRO Image"
            class="w-full max-w-xs md:max-w-sm rounded-lg shadow-lg">
    </div>

    <!-- Teks di sebelah kiri -->
    <div class="w-full md:w-2/3 md:pr-6 mt-6 md:mt-0">
        <h2 class="text-xl sm:text-2xl md:text-3xl font-semibold mb-4">
            DESIGN ORGANIZATION APPROVAL ( DOA )
        </h2>
        <p class="text-md sm:text-lg leading-relaxed">
            SBU Aircraft Services has own internal Design office team while had great knowledge and experience in aviation design works, We shall carry out design and certification activities according to applicable CASR with the following scope of work :
        </p>

        <!-- List dengan Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-5">
            <ul class="list-disc list-inside space-y-2">
                <li>Structure repair & alteration design</li>
                <li>Avionics equipment installation design</li>
                <li> electrical repair & alteration design</li>
                <li>interior & exterior repair & alteration design</li>
            </ul>
        </div>
    </div>
</div>

<br> 
</div>
</div>

 @include('layouts.footer')

