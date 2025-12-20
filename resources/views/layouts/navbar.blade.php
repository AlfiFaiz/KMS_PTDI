<header class="shadow-md">
    <div class="bg-white py-3 bg-right bg-no-repeat bg-contain"
        style="background-image: url('{{ asset('images/heli.png') }}');">
        <div class="container mx-auto flex justify-between items-center px-6">
            <!-- Logo Kiri -->
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
                <a href="/" class="hover:text-gray-200">Home</a>
                <a href="about" class="hover:text-gray-200">About Us</a>
                <a href="capabilities" class="hover:text-gray-200">Capabilities</a>
                <a href="certificate" class="hover:text-gray-200">Certificates</a>
            </div>

            <!-- Tombol Login & Registrasi -->
            <div class="hidden md:flex space-x-3">
                <a href="{{ route('login') }}"
                    class="bg-white text-blue-700 border border-blue-700 px-3 py-1.5 rounded-md font-semibold hover:bg-blue-700 hover:text-white transition">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="bg-blue-700 text-white px-3 py-1.5 rounded-md font-semibold border border-white hover:bg-white hover:text-blue-700 transition">
                    Registrasi
                </a>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div id="mobile-menu"
            class="fixed inset-0 bg-blue-900 bg-opacity-95 flex flex-col items-center justify-center text-lg transform translate-x-full transition-transform duration-300 z-50">
            <button id="close-menu" class="absolute top-6 right-6 text-3xl text-white">
                <i class="fa-solid fa-times"></i>
            </button>

            <div class="flex flex-col space-y-6 text-center">
                <a href="/" class="text-white text-xl font-semibold hover:text-gray-300">Home</a>
                <a href="about" class="text-white text-xl font-semibold hover:text-gray-300">About Us</a>
                <a href="capabilities" class="text-white text-xl font-semibold hover:text-gray-300">Capabilities</a>
                <a href="certificaties" class="text-white text-xl font-semibold hover:text-gray-300">Certificates</a>
            </div>

            <div class="mt-8 flex flex-col space-y-3">
                <a href="{{ route('login') }}"
                    class="bg-white text-blue-700 border border-blue-700 px-5 py-2 rounded-md font-semibold hover:bg-blue-700 hover:text-white transition">Login</a>
                <a href="{{ route('register') }}"
                    class="bg-blue-700 text-white px-5 py-2 rounded-md font-semibold border border-white hover:bg-white hover:text-blue-700 transition">Registrasi</a>
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
