<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Pelanggan @yield('title')</title>

    <!-- CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <header class="shadow-md">
        <div class="bg-white py-3 bg-right bg-no-repeat bg-contain"
             style="background-image: url('{{ asset('images/heli.png') }}');">
            <div class="container mx-auto flex justify-between items-center px-6">
                <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="h-16 w-auto">
            </div>
        </div>

        <nav class="bg-blue-600 text-white">
            <div class="container mx-auto px-6 py-3 flex justify-between items-center">
                <button id="menu-toggle" class="md:hidden text-2xl focus:outline-none">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div id="menu" class="hidden md:flex md:space-x-8 text-sm font-medium">
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-200">Dashboard</a>
                    <a href="{{ route('project.index') }}" class="hover:text-gray-200">Project</a>
                    <a href="{{ route('audit') }}" class="hover:text-gray-200">Audit</a>
                    <a href="{{ route('info') }}" class="hover:text-gray-200">Info</a>
                </div>
                <div class="hidden md:flex items-center space-x-5">
    <!-- Notifikasi -->
      @php
        use App\Models\Notification;

        $unreadCount = 0;
        if (Auth::check()) {
            $unreadCount = Notification::where('user_id', Auth::id())
                ->whereNull('read_at')
                ->count();
        }
    @endphp
<div class="flex flex-wrap items-center gap-4">

    <!-- Notifikasi -->
    <div class="relative">
        <a href="{{ route('notifications.index') }}" class="text-xl hover:text-gray-200">
            <i class="fa-solid fa-bell"></i>
            @if($unreadCount > 0)
                <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full px-1">
                    {{ $unreadCount }}
                </span>
            @endif
        </a>
    </div>

    <!-- Profil -->
    <a href=" " 
       class="flex items-center space-x-2 hover:text-gray-200">
        <i class="fa-solid fa-user-circle text-2xl"></i>
        <span class="text-sm">{{ Auth::user()->name }}</span>
    </a>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="bg-red-600 px-3 py-1.5 rounded-md font-semibold hover:bg-red-700 transition">
            Logout
        </button>
    </form>
</div>
            </div>
        </nav>
    </header>

    <!-- Konten -->
    <main>
        @yield('content')
    </main>

    @include('layouts.footer')

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>