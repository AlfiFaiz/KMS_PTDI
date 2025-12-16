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

    <!-- Hero Section -->
    <div class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/hanggar.png') }}');">
        <div class="flex items-center justify-center min-h-screen text-center px-4">
            <div class="max-w-5xl text-white">
               <h1 class="text-3xl sm:text-5xl md:text-6xl font-extrabold text-white text-center"
    style="text-shadow: 2px 2px 6px rgba(0,0,0,0.7);">
    "When everything seems to be going against you, <br>
    remember that the airplane takes off against the wind, not with it."
    <br>
    - Henry Ford -
</h1>

                <br>
                <h2 class="text-2xl sm:text-4xl md:text-4xl font-extrabold shadow-lg">
                </h2>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

</body>
</html>
