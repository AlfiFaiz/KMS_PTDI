<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KMS - Quality & Safety</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans min-h-full flex flex-col m-0 p-0">

    <div class="w-full block relative" style="z-index: 99999 !important;">
        @include('layouts.navbar')
    </div>

    <main class="flex-1 w-full relative flex flex-col z-10">

        <div class="w-full flex-1 bg-cover bg-center relative"
            style="background-image: url('{{ asset('images/hanggar.png') }}'); min-height: calc(100vh - 140px);">

            <div class="absolute inset-0 bg-black/50 flex items-center justify-center px-4 py-12">

                <div class="max-w-5xl text-center text-white space-y-6">
                    <h1 class="text-3xl sm:text-5xl md:text-6xl font-extrabold tracking-tight leading-tight select-text"
                        style="text-shadow: 3px 3px 10px rgba(0,0,0,0.85);">
                        "When everything seems to be going against you, <br class="hidden md:inline">
                        remember that the airplane takes off against the wind, not with it."
                    </h1>
                    <p class="text-lg sm:text-2xl font-bold text-black-400 tracking-wide italic">— Henry Ford —</p>
                </div>

            </div>

        </div>

    </main>

    <div class="w-full block relative z-20">
        @include('layouts.footer')
    </div>

</body>

</html>
