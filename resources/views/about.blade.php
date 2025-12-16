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
<div class="bg-[#0B163B] text-white">

    <!-- About Us -->
    <div class="container mx-auto py-8 sm:py-12 text-center px-4">
        <h1 class="text-2xl sm:text-3xl md:text-4xl font-extrabold">ABOUT US</h1>
        <p class="mt-2 text-lg font-semibold">Meet our Team</p>
        <p class="mt-4 text-md max-w-3xl mx-auto">
            It takes dedicated, capable, and experienced leaders to ensure Strategic Business Unit Aircraft Services PT Dirgantara Indonesia stays a global leader in the aviation industry for many years to come. We are confident we have the right team in place to continue positive growth of the company.
        </p>
    </div>

    <!-- Struktur Organisasi -->
    <div class="container mx-auto py-8 sm:py-12 text-center px-4">
        <h2 class="text-2xl sm:text-3xl font-bold">OUR STRUCTURE</h2>
        <div class="flex justify-center mt-6">
            <img src="{{ asset('images/struktur.png') }}" class="w-full max-w-4xl sm:max-w-5xl rounded-lg shadow-lg" alt="Struktur Organisasi">
        </div>
    </div>
    
    <hr class="my-8 border-t-2 border-gray-400 mx-auto w-3/4">

    <!-- Lokasi -->
    <div class="container mx-auto py-8 sm:py-12 text-center px-4">
        <h2 class="text-2xl sm:text-3xl font-bold">OUR LOCATION</h2>
        <p class="mt-2">CBC Building 1st Floor, KP IV, Jl. Pajajaran No 154 Bandung, West Java</p>

        <div class="flex flex-col md:flex-row justify-center mt-6 space-y-6 md:space-y-0 md:space-x-6">
            <!-- Google Maps Embed -->
            <iframe 
                class="w-full sm:w-100 h-150 rounded-lg shadow-lg"
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3543.061037219547!2d107.57381620223322!3d-6.89667140310417!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e524ee3f486f%3A0xfdf2eafc758e63fd!2sGEDUNG%20CBC%20KP%20IV%20PT.DIRGANTARA%20INDONESIA!5e1!3m2!1sid!2sid!4v1746600086524!5m2!1sid!2sid" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>

            <!-- Gambar Gedung -->
            <img src="{{ asset('images/building.png') }}" class="w-full sm:w-100 rounded-lg shadow-lg" alt="Building">
        </div>
    </div>
    
    <hr class="my-8 border-t-2 border-gray-400 mx-auto w-3/4">

    <!-- Kontak -->
    <div class="container mx-auto py-8 sm:py-12 text-center px-4">
        <h2 class="text-2xl sm:text-3xl font-bold">OUR CONTACT</h2>
        
        <div class="mt-4">
            <p class="text-lg font-semibold">📧 Email:</p>
            <a href="mailto:marketing-ptdi@indonesian-aerospace.com" class="hover:underline text-blue-400">
                marketing-ptdi@indonesian-aerospace.com
            </a><br>
            <a href="mailto:sekretariat-ptdi@indonesian-aerospace.com" class="hover:underline text-blue-400">
                sekretariat-ptdi@indonesian-aerospace.com
            </a>
        </div>

        <div class="mt-4">
            <p class="text-lg font-semibold">📞 Phone:</p>
            <p class="text-blue-400">+62 22 6055030 | +62 22 6055031</p>
        </div>
    </div>
</div>

 @include('layouts.footer')