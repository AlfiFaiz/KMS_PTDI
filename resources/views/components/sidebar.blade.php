<div class="sidebar h-screen overflow-y-auto bg-gray-800 text-white p-4">
    <h4 class="text-center mb-4">{{ ucfirst(auth()->user()->role) }} Panel</h4>
    

    <!-- Dashboard -->
    <a href="{{ route('dashboard') }}"
       class="{{ request()->routeIs(auth()->user()->role . '.dashboard') ? 'bg-blue-600 text-white' : '' }}">
       <i class="fa-solid fa-gauge mr-2"></i> Dashboard
    </a>
    <hr class="bg-light my-3">

    <!-- Menu khusus Admin -->
    @if (auth()->user()->role === 'admin')
        <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'bg-blue-600 text-white' : '' }}">
            <i class="fa-solid fa-users mr-2"></i> Manajemen User
        </a>
        <hr class="bg-light my-3">
    @endif

    <!-- Menu khusus Manajemen -->
    @if (auth()->user()->role === 'manajemen')
        <a href="{{ route('pelanggan.index') }}"
           class="{{ request()->routeIs('pelanggan.*') ? 'bg-blue-600 text-white' : '' }}">
           <i class="fa-solid fa-users mr-2"></i> Manajemen Pelanggan
        </a>
        <hr class="bg-light my-3">
    @endif

    <!-- Menu umum -->
    <a href="{{ route('companies.index') }}"
       class="{{ request()->routeIs('companies.*') ? 'bg-blue-600 text-white' : '' }}">
       <i class="fa-solid fa-building mr-2"></i> Manajemen Perusahaan
    </a>
    <hr class="bg-light my-3">

    <a href="{{ route('qms.index') }}" class="{{ request()->routeIs('qms.*') ? 'bg-blue-600 text-white' : '' }}">
        <i class="fa-solid fa-file-lines mr-2"></i> Manajemen QMS
    </a>
    <hr class="bg-light my-3">

    <a href="{{ route('certificates.index') }}"
       class="{{ request()->routeIs('certificates.*') ? 'bg-blue-600 text-white' : '' }}">
       <i class="fa-solid fa-certificate mr-2"></i> Manajemen Sertifikat
    </a>
    <hr class="bg-light my-3">

    <a href="{{ route('infos.index') }}"
       class="{{ request()->routeIs('infos.*') ? 'bg-blue-600 text-white' : '' }}">
       <i class="fa-solid fa-circle-info mr-2"></i> Manajemen Info
    </a>
    <hr class="bg-light my-3">

    <!-- Aircraft Program -->
    <div x-data="{ open: false }" class="mb-2">
        <button @click="open = !open"
            class="w-full text-left px-4 py-2 flex items-center justify-between text-gray-200 hover:bg-blue-700">
            <span><i class="fa-solid fa-plane mr-2"></i> Aircraft Program</span>
            <i :class="open ? 'fa-solid fa-chevron-down' : 'fa-solid fa-chevron-right'"></i>
        </button>
        <div x-show="open" x-transition class="ml-6 mt-1 space-y-1">
            <a href="{{ route('aircraft-programs.index') }}"
               class="block px-3 py-2 rounded {{ request()->routeIs('aircraft-programs.*') ? 'bg-blue-600 text-white' : 'hover:bg-blue-600 text-gray-200' }}">
               <i class="fa-solid fa-diagram-project mr-2"></i> Project
            </a>
            <a href="{{ route('tasks.index') }}"
               class="block px-3 py-2 rounded {{ request()->routeIs('tasks.*') ? 'bg-blue-600 text-white' : 'hover:bg-blue-600 text-gray-200' }}">
               <i class="fa-solid fa-list-check mr-2"></i> Task
            </a>
        </div>
    </div>
    <hr class="bg-light my-3">

    <!-- Logout -->
    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>