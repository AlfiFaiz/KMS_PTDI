<div class="sidebar h-screen overflow-y-auto bg-[#0f172a] text-gray-400 p-3 w-64 flex flex-col border-r border-white/5 shadow-2xl">
    
    <div class="flex items-center gap-3 px-2 py-4 mb-2 border-b border-white/5">
        <div class="bg-white p-1 rounded shadow-sm shrink-0 flex items-center justify-center" style="width: 200px;">
    <img src="{{ asset('images/logo.png') }}" 
         alt="Logo" 
         class="h-5 w-auto object-contain">
</div>
    </div>

    <nav class="flex-1 space-y-1 custom-scrollbar py-3">
    
    <a href="{{ route('dashboard') }}"
       class="group flex items-center px-4 py-2.5 text-sm font-bold rounded-xl transition-all {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/25' : 'hover:bg-gray-800 hover:text-white' }}">
       <i class="fa-solid fa-gauge w-5 mr-3 text-center text-base transition-transform group-hover:scale-110"></i> 
       Dashboard
    </a>

    <div class="pt-3 pb-1">
        
        @if (auth()->user()->role === 'admin')
        <a href="{{ route('users.index') }}" 
           class="flex items-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('users.*') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fa-solid fa-users-gear w-5 mr-3 text-center text-base"></i> User
        </a>
        @endif

        @if (auth()->user()->role === 'manajemen')
        <a href="{{ route('pelanggan.index') }}"
           class="flex items-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('pelanggan.*') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fa-solid fa-user-tie w-5 mr-3 text-center text-base"></i> Pelanggan
        </a>
        @endif

        <a href="{{ route('companies.index') }}"
           class="flex items-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('companies.*') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-gray-800 hover:text-white' }}">
           <i class="fa-solid fa-building w-5 mr-3 text-center text-base"></i> Customer
        </a>
    </div>

    <div class="pt-3 pb-1">

        <a href="{{ route('qms.index') }}" 
           class="flex items-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('qms.*') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-gray-800 hover:text-white' }}">
            <i class="fa-solid fa-file-shield w-5 mr-3 text-center text-base"></i> Dokumen QMS
        </a>

        <a href="{{ route('certificates.index') }}"
           class="flex items-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('certificates.*') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-gray-800 hover:text-white' }}">
           <i class="fa-solid fa-certificate w-5 mr-3 text-center text-base"></i> Sertifikat
        </a>

        <a href="{{ route('infos.index') }}"
           class="flex items-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all {{ request()->routeIs('infos.*') ? 'bg-blue-600 text-white shadow-md' : 'hover:bg-gray-800 hover:text-white' }}">
           <i class="fa-solid fa-circle-info w-5 mr-3 text-center text-base"></i> Informasi
        </a>
    </div>

    <div x-data="{ open: {{ request()->routeIs('aircraft-programs.*', 'tasks.*') ? 'true' : 'false' }} }" class="pt-2">
        <button @click="open = !open"
            class="w-full flex items-center px-4 py-2.5 text-sm font-semibold rounded-xl transition-all text-gray-400 hover:bg-gray-800 hover:text-white">
            <i class="fa-solid fa-plane-departure w-5 mr-3 text-center text-base"></i>
            <span class="flex-1 text-left">Aircraft Program</span>
            <i class="fa-solid transition-transform duration-300 text-[10px]" :class="open ? 'fa-chevron-down' : 'fa-chevron-right'"></i>
        </button>
        
        <div x-show="open" x-transition class="ml-8 border-l-2 border-gray-800 space-y-1 mt-1">
            <a href="{{ route('aircraft-programs.index') }}"
               class="block px-5 py-2 text-[13px] font-medium transition-all {{ request()->routeIs('aircraft-programs.*') ? 'text-blue-400 border-l-2 border-blue-400 -ml-[2px]' : 'text-gray-500 hover:text-white' }}">
               Project List
            </a>
            <a href="{{ route('tasks.index') }}"
               class="block px-5 py-2 text-[13px] font-medium transition-all {{ request()->routeIs('tasks.*') ? 'text-blue-400 border-l-2 border-blue-400 -ml-[2px]' : 'text-gray-500 hover:text-white' }}">
               Task Management
            </a>
        </div>
    </div>

    <a href="{{ route('wiki.index') }}"
       class="flex items-center px-4 py-2.5 text-sm font-bold rounded-xl mt-4 transition-all {{ request()->routeIs('wiki.*') ? 'bg-blue-600 text-white shadow-lg' : 'hover:bg-gray-800 hover:text-white' }}">
       <i class="fa-solid fa-book-open w-5 mr-3 text-center text-base"></i> Wiki System
    </a>
</nav>

    <div class="mt-auto pt-4">

</div>
        
        <a href="{{ route('logout') }}" 
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
   class="group flex items-center px-4 py-3 text-sm font-black text-red-400 rounded-xl hover:bg-red-500/10 transition-all border border-transparent hover:border-red-500/20">
    <i class="fa-solid fa-power-off w-5 mr-3 text-center text-base transition-transform duration-300 group-hover:rotate-90 group-hover:scale-110"></i> 
    <span class="tracking-wide">Keluar Sistem</span>
</a>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</div>