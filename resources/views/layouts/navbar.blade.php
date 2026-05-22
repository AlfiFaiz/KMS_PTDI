<header class="relative w-full z-50 shadow-sm">
    <div class="bg-white py-4 border-b border-gray-100 bg-right bg-no-repeat bg-contain"
        style="background-image: url('{{ asset('images/heli.png') }}'); min-height: 90px;">
        <div class="container mx-auto flex justify-between items-center px-6 sm:px-10">
            <div class="flex items-center space-x-4 group cursor-pointer">
                <div
                    class="p-1.5 bg-white rounded-xl shadow-sm border border-gray-100 group-hover:shadow-md transition-all duration-300">
                    <img src="{{ asset('images/logo.png') }}" alt="Company Logo" class="h-14 w-auto object-contain">
                </div>
                <div class="hidden sm:block">
                    <span
                        class="block text-[10px] font-bold text-blue-500 uppercase tracking-[0.2em] leading-none">Aviation
                        Portal</span>
                    <span class="block text-lg font-black text-slate-800 tracking-tight mt-1">KMS Quality &
                        Safety</span>
                </div>
            </div>
        </div>
    </div>

    <nav class="bg-gradient-to-r from-blue-700 to-blue-600 text-white sticky top-0 shadow-lg">
        <div class="container mx-auto px-6 sm:px-10 flex justify-between items-center h-14">

            <button id="menu-toggle"
                class="md:hidden text-xl focus:outline-none hover:text-blue-200 transition-all p-2 -ml-2"
                aria-label="Open Menu">
                <i class="fa-solid fa-bars-staggered"></i>
            </button>

            <div id="menu"
                class="hidden md:flex space-x-2 h-full items-center text-[11px] font-bold uppercase tracking-widest">
                @php
                    $links = [
                        ['url' => '/', 'label' => 'Home'],
                        ['url' => '/about', 'label' => 'About Us'],
                        ['url' => '/capabilities', 'label' => 'Capabilities'],
                        ['url' => '/certificate', 'label' => 'Certificates'],
                    ];
                @endphp

                @foreach ($links as $link)
                    <a href="{{ url($link['url']) }}"
                        class="relative flex items-center h-full px-5 text-white/90 hover:text-white transition-colors duration-300 group">
                        <span>{{ $link['label'] }}</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-0.5 bg-white scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-left"></span>
                    </a>
                @endforeach
            </div>

            <div class="hidden md:flex items-center space-x-5">
                <a href="{{ route('login') }}"
                    class="text-xs font-bold uppercase tracking-widest hover:text-blue-100 transition duration-200">
                    Sign In
                </a>
                <a href="{{ route('register') }}"
                    class="bg-white text-blue-700 px-5 py-2 rounded-lg text-xs font-black uppercase tracking-widest shadow-md hover:bg-blue-50 hover:scale-105 active:scale-95 transition-all duration-200 border border-transparent">
                    Get Started
                </a>
            </div>
        </div>

        <div id="mobile-menu" class="hidden fixed inset-0 z-[60] transition-all duration-300">
            <div id="menu-backdrop" class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm"></div>

            <div
                class="absolute right-0 top-0 w-72 h-full bg-white shadow-2xl p-8 flex flex-col justify-between transform transition-transform duration-300 ease-in-out">
                <div>
                    <div class="flex items-center justify-between mb-10 pb-4 border-b border-gray-100">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Navigation</span>
                        <button id="close-menu" class="text-gray-400 hover:text-red-500 transition-colors">
                            <i class="fa-solid fa-xmark text-xl"></i>
                        </button>
                    </div>

                    <nav class="flex flex-col space-y-4">
                        @foreach ($links as $link)
                            <a href="{{ url($link['url']) }}"
                                class="text-sm font-bold text-slate-700 hover:text-blue-600 hover:translate-x-2 transition-all duration-200 flex items-center justify-between">
                                {{ $link['label'] }}
                                <i class="fa-solid fa-chevron-right text-[10px] opacity-30"></i>
                            </a>
                        @endforeach
                    </nav>
                </div>

                <div class="space-y-3">
                    <a href="{{ route('login') }}"
                        class="block w-full text-center py-3 rounded-xl bg-slate-50 text-slate-700 font-bold text-sm hover:bg-slate-100 transition">Sign
                        In</a>
                    <a href="{{ route('register') }}"
                        class="block w-full text-center py-3 rounded-xl bg-blue-600 text-white font-bold text-sm hover:bg-blue-700 shadow-lg shadow-blue-600/20 transition">Register
                        Now</a>
                </div>
            </div>
        </div>
    </nav>
</header>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuToggle = document.getElementById("menu-toggle");
        const closeMenu = document.getElementById("close-menu");
        const mobileMenu = document.getElementById("mobile-menu");
        const menuBackdrop = document.getElementById("menu-backdrop");
        const drawerPanel = mobileMenu ? mobileMenu.querySelector('.bg-white') : null;

        function openMenu() {
            mobileMenu.classList.remove("hidden");
            // Small timeout to allow transition to trigger
            setTimeout(() => {
                drawerPanel.style.transform = "translateX(0)";
            }, 10);
            document.body.style.overflow = "hidden";
        }

        function closeMenuFunc() {
            drawerPanel.style.transform = "translateX(100%)";
            setTimeout(() => {
                mobileMenu.classList.add("hidden");
            }, 300);
            document.body.style.overflow = "";
        }

        if (menuToggle) menuToggle.addEventListener("click", openMenu);
        if (closeMenu) closeMenu.addEventListener("click", closeMenuFunc);
        if (menuBackdrop) menuBackdrop.addEventListener("click", closeMenuFunc);
    });
</script>
