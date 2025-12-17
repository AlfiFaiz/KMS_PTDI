<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Trix Editor CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
<title>Admin @yield('title')</title>
<!-- jQuery harus duluan -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Chart.js plugin -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-doughnutlabel"></script>

<!-- Alpine.js -->
<script src="//unpkg.com/alpinejs" defer></script>

<!-- Trix Editor JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/2.0.0/trix.js"></script>
<script src="https://cdn.tailwindcss.com"> 
</head>
<header class="shadow-md">
    <div class="bg-white py-3 bg-right bg-no-repeat bg-contain"
        style="background-image: url('{{ asset('images/heli.png') }}');">
        <div class="container mx-auto flex justify-between items-center px-6">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="h-16 w-auto">
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="bg-blue-600 text-white">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <!-- Tombol Hamburger (Mobile) -->
            <button id="menu-toggle" class="md:hidden text-2xl focus:outline-none">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Menu Navigasi -->
            <div id="menu" class="hidden md:flex md:space-x-8 text-sm font-medium">
                <a href="{{ route('dashboard') }}" class="hover:text-gray-200">Dashboard</a>
                <a href="{{ route('project.index') }}" class="hover:text-gray-200">Project</a>
                <a href="{{ route('audit') }}" class="hover:text-gray-200">Audit</a>
                <a href="{{ route('info') }}" class="hover:text-gray-200">Info</a>


            </div>

            <!-- User Info + Logout -->
            <div class="hidden md:flex items-center space-x-3">
                <a href="{{ route('notifications.index') }}" class="relative">
                    <i class="fa-solid fa-bell text-xl"></i>
                    @php $badge = $unreadCount ?? 0; @endphp
                    @if ($badge > 0)
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full px-1">
                            {{ $badge }}
                        </span>
                    @endif
                </a>


                <span class="text-sm">Halo, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-600 px-3 py-1.5 rounded-md font-semibold hover:bg-red-700 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div id="mobile-menu"
            class="fixed inset-0 bg-blue-900 bg-opacity-95 flex flex-col items-center justify-center text-lg transform translate-x-full transition-transform duration-300 z-50">
            <button id="close-menu" class="absolute top-6 right-6 text-3xl text-white">
                <i class="fa-solid fa-times"></i>
            </button>

            <div class="flex flex-col space-y-6 text-center">
                <a href="{{ route('dashboard') }}"
                    class="text-white text-xl font-semibold hover:text-gray-300">Dashboard</a>
                <a href="{{ route('project.index') }}"
                    class="text-white text-xl font-semibold hover:text-gray-300">Project</a>
                <a href="{{ route('audit') }}"
                    class="text-white text-xl font-semibold hover:text-gray-300">Audit</a>
                <a href="{{ route('info') }}"
                    class="text-white text-xl font-semibold hover:text-gray-300">Info</a>
            </div>

            <div class="mt-8 flex flex-col space-y-3">
                <span class="text-white text-lg">Halo, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="bg-red-600 px-5 py-2 rounded-md font-semibold hover:bg-red-700 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>

<script>
    document.getElementById("menu-toggle").addEventListener("click", function() {
        document.getElementById("mobile-menu").classList.remove("translate-x-full");
    });

    document.getElementById("close-menu").addEventListener("click", function() {
        document.getElementById("mobile-menu").classList.add("translate-x-full");
    });
</script>

<body class="bg-gray-100 font-sans">

    <!-- Konten -->
    <main>
        @yield('content')
    </main>

</body>
@include('layouts.footer')

</html>
