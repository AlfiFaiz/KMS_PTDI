<div
    class="sidebar h-screen bg-[#0f172a] text-slate-300 p-4 w-64 flex flex-col border-r border-white/5 shadow-2xl antialiased select-none">

    <div class="flex items-center justify-center px-2 pb-4 mb-4 border-b border-white/5 shrink-0">
        <div class="flex items-center justify-center w-full py-1.5">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-6 w-auto object-contain brightness-110">
        </div>
    </div>

    <div class="px-1 mb-5 shrink-0">
        <a href="{{ route('global.search') }}"
            class="w-full h-9 px-3.5 rounded-lg border border-white/10 bg-white/[0.04] text-slate-400 text-xs flex items-center gap-3 hover:bg-white/[0.07] hover:text-slate-200 hover:border-white/20 transition-all group">
            <i
                class="fa-solid fa-magnifying-glass text-[11px] text-slate-500 group-hover:text-blue-400 transition-colors"></i>
            <span>Pencarian Global...</span>
        </a>
    </div>

    <nav class="flex-1 space-y-4 overflow-y-auto pr-1 -mr-2 custom-sidebar-scroll">

        <div class="space-y-1">
            <a href="{{ route('dashboard') }}"
                class="group flex items-center px-3 py-2 text-xs font-semibold rounded-xl transition-all duration-200
                {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/15' : 'text-slate-400 hover:bg-white/[0.05] hover:text-slate-100' }}">
                <i
                    class="fa-solid fa-gauge w-4 mr-3 text-center text-sm transition-transform duration-200 group-hover:scale-105 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400 group-hover:text-slate-300' }}"></i>
                Dashboard
            </a>
        </div>

        <div x-data="{ open: {{ request()->routeIs('users.*', 'companies.*') ? 'true' : 'false' }} }" class="space-y-1">
            <div class="px-3 pb-1 text-[10px] uppercase tracking-wider text-slate-500 font-bold">
                Master Data
            </div>

            <button @click="open = !open"
                class="w-full group flex items-center px-3 py-2 text-xs font-semibold rounded-xl transition-all duration-200 text-slate-400 hover:bg-white/[0.05] hover:text-slate-100">
                <i
                    class="fa-solid fa-database w-4 mr-3 text-center text-sm text-slate-400 group-hover:text-slate-300"></i>
                <span class="flex-1 text-left">Master Management</span>
                <i class="fa-solid text-[9px] transition-transform duration-300 text-slate-500 group-hover:text-slate-300"
                    :class="open ? 'fa-chevron-down' : 'fa-chevron-right'"></i>
            </button>

            <div x-show="open" x-collapse class="pl-4 mt-0.5 space-y-0.5 border-l border-white/5 ml-5">
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('users.index') }}"
                        class="group flex items-center px-3 py-1.5 text-[11px] font-medium rounded-lg transition-all duration-150
                        {{ request()->routeIs('users.*') ? 'text-blue-400 font-semibold bg-blue-500/[0.03]' : 'text-slate-400 hover:text-slate-200' }}">
                        <span
                            class="w-1.5 h-1.5 rounded-full mr-2.5 transition-all duration-150 {{ request()->routeIs('users.*') ? 'bg-blue-400 scale-110 shadow-sm shadow-blue-400' : 'bg-slate-600 group-hover:bg-slate-400' }}"></span>
                        User Management
                    </a>
                @endif

                <a href="{{ route('companies.index') }}"
                    class="group flex items-center px-3 py-1.5 text-[11px] font-medium rounded-lg transition-all duration-150
                    {{ request()->routeIs('companies.*') ? 'text-blue-400 font-semibold bg-blue-500/[0.03]' : 'text-slate-400 hover:text-slate-200' }}">
                    <span
                        class="w-1.5 h-1.5 rounded-full mr-2.5 transition-all duration-150 {{ request()->routeIs('companies.*') ? 'bg-blue-400 scale-110 shadow-sm shadow-blue-400' : 'bg-slate-600 group-hover:bg-slate-400' }}"></span>
                    Customer Data
                </a>
            </div>
        </div>

        <div x-data="{ open: {{ request()->routeIs('knowledge.*', 'wiki.*', 'qms.*', 'certificates.*', 'infos.*', 'activity-logs.*') ? 'true' : 'false' }} }" class="space-y-1">
            <div class="px-3 pb-1 text-[10px] uppercase tracking-wider text-slate-500 font-bold">
                Knowledge Management
            </div>

            <button @click="open = !open"
                class="w-full group flex items-center px-3 py-2 text-xs font-semibold rounded-xl transition-all duration-200 text-slate-400 hover:bg-white/[0.05] hover:text-slate-100">
                <i
                    class="fa-solid fa-book-open-reader w-4 mr-3 text-center text-sm text-slate-400 group-hover:text-slate-300"></i>
                <span class="flex-1 text-left">Knowledge Center</span>
                <i class="fa-solid text-[9px] transition-transform duration-300 text-slate-500 group-hover:text-slate-300"
                    :class="open ? 'fa-chevron-down' : 'fa-chevron-right'"></i>
            </button>

            <div x-show="open" x-collapse class="pl-4 mt-0.5 space-y-0.5 border-l border-white/5 ml-5">
                <a href="{{ route('knowledge.index') }}"
                    class="group flex items-center px-3 py-1.5 text-[11px] font-medium rounded-lg transition-all duration-150
                    {{ request()->routeIs('knowledge.*') ? 'text-blue-400 font-semibold bg-blue-500/[0.03]' : 'text-slate-400 hover:text-slate-200' }}">
                    <span
                        class="w-1.5 h-1.5 rounded-full mr-2.5 transition-all duration-150 {{ request()->routeIs('knowledge.*') ? 'bg-blue-400 scale-110 shadow-sm shadow-blue-400' : 'bg-slate-600 group-hover:bg-slate-400' }}"></span>
                    Knowledge Base
                </a>

                <a href="{{ route('wiki.index') }}"
                    class="group flex items-center px-3 py-1.5 text-[11px] font-medium rounded-lg transition-all duration-150
                    {{ request()->routeIs('wiki.*') ? 'text-blue-400 font-semibold bg-blue-500/[0.03]' : 'text-slate-400 hover:text-slate-200' }}">
                    <span
                        class="w-1.5 h-1.5 rounded-full mr-2.5 transition-all duration-150 {{ request()->routeIs('wiki.*') ? 'bg-blue-400 scale-110 shadow-sm shadow-blue-400' : 'bg-slate-600 group-hover:bg-slate-400' }}"></span>
                    Wiki System
                </a>

                <a href="{{ route('qms.index') }}"
                    class="group flex items-center px-3 py-1.5 text-[11px] font-medium rounded-lg transition-all duration-150
                    {{ request()->routeIs('qms.*') ? 'text-blue-400 font-semibold bg-blue-500/[0.03]' : 'text-slate-400 hover:text-slate-200' }}">
                    <span
                        class="w-1.5 h-1.5 rounded-full mr-2.5 transition-all duration-150 {{ request()->routeIs('qms.*') ? 'bg-blue-400 scale-110 shadow-sm shadow-blue-400' : 'bg-slate-600 group-hover:bg-slate-400' }}"></span>
                    Dokumen QMS
                </a>

                <a href="{{ route('certificates.index') }}"
                    class="group flex items-center px-3 py-1.5 text-[11px] font-medium rounded-lg transition-all duration-150
                    {{ request()->routeIs('certificates.*') ? 'text-blue-400 font-semibold bg-blue-500/[0.03]' : 'text-slate-400 hover:text-slate-200' }}">
                    <span
                        class="w-1.5 h-1.5 rounded-full mr-2.5 transition-all duration-150 {{ request()->routeIs('certificates.*') ? 'bg-blue-400 scale-110 shadow-sm shadow-blue-400' : 'bg-slate-600 group-hover:bg-slate-400' }}"></span>
                    Certificates
                </a>

                <a href="{{ route('infos.index') }}"
                    class="group flex items-center px-3 py-1.5 text-[11px] font-medium rounded-lg transition-all duration-150
                    {{ request()->routeIs('infos.*') ? 'text-blue-400 font-semibold bg-blue-500/[0.03]' : 'text-slate-400 hover:text-slate-200' }}">
                    <span
                        class="w-1.5 h-1.5 rounded-full mr-2.5 transition-all duration-150 {{ request()->routeIs('infos.*') ? 'bg-blue-400 scale-110 shadow-sm shadow-blue-400' : 'bg-slate-600 group-hover:bg-slate-400' }}"></span>
                    Informations
                </a>

                <a href="{{ route('activity-logs.index') }}"
                    class="group flex items-center px-3 py-1.5 text-[11px] font-medium rounded-lg transition-all duration-150
                    {{ request()->routeIs('activity-logs.*') ? 'text-blue-400 font-semibold bg-blue-500/[0.03]' : 'text-slate-400 hover:text-slate-200' }}">
                    <span
                        class="w-1.5 h-1.5 rounded-full mr-2.5 transition-all duration-150 {{ request()->routeIs('activity-logs.*') ? 'bg-blue-400 scale-110 shadow-sm shadow-blue-400' : 'bg-slate-600 group-hover:bg-slate-400' }}"></span>
                    Activity Logs
                </a>
            </div>
        </div>

        <div x-data="{ open: {{ request()->routeIs('aircraft-programs.*', 'tasks.*') ? 'true' : 'false' }} }" class="space-y-1">
            <div class="px-3 pb-1 text-[10px] uppercase tracking-wider text-slate-500 font-bold">
                Project Management
            </div>

            <button @click="open = !open"
                class="w-full group flex items-center px-3 py-2 text-xs font-semibold rounded-xl transition-all duration-200 text-slate-400 hover:bg-white/[0.05] hover:text-slate-100">
                <i
                    class="fa-solid fa-plane-departure w-4 mr-3 text-center text-sm text-slate-400 group-hover:text-slate-300"></i>
                <span class="flex-1 text-left">Aircraft Program</span>
                <i class="fa-solid text-[9px] transition-transform duration-300 text-slate-500 group-hover:text-slate-300"
                    :class="open ? 'fa-chevron-down' : 'fa-chevron-right'"></i>
            </button>

            <div x-show="open" x-collapse class="pl-4 mt-0.5 space-y-0.5 border-l border-white/5 ml-5">
                <a href="{{ route('aircraft-programs.index') }}"
                    class="group flex items-center px-3 py-1.5 text-[11px] font-medium rounded-lg transition-all duration-150
                    {{ request()->routeIs('aircraft-programs.*') ? 'text-blue-400 font-semibold bg-blue-500/[0.03]' : 'text-slate-400 hover:text-slate-200' }}">
                    <span
                        class="w-1.5 h-1.5 rounded-full mr-2.5 transition-all duration-150 {{ request()->routeIs('aircraft-programs.*') ? 'bg-blue-400 scale-110 shadow-sm shadow-blue-400' : 'bg-slate-600 group-hover:bg-slate-400' }}"></span>
                    Project List
                </a>

                <a href="{{ route('tasks.index') }}"
                    class="group flex items-center px-3 py-1.5 text-[11px] font-medium rounded-lg transition-all duration-150
                    {{ request()->routeIs('tasks.*') ? 'text-blue-400 font-semibold bg-blue-500/[0.03]' : 'text-slate-400 hover:text-slate-200' }}">
                    <span
                        class="w-1.5 h-1.5 rounded-full mr-2.5 transition-all duration-150 {{ request()->routeIs('tasks.*') ? 'bg-blue-400 scale-110 shadow-sm shadow-blue-400' : 'bg-slate-600 group-hover:bg-slate-400' }}"></span>
                    Task Management
                </a>
            </div>
        </div>

    </nav>

    <div class="mt-auto pt-4 border-t border-white/5 px-1 shrink-0">
        <a href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="group flex items-center px-3 py-2 text-xs font-semibold text-red-400/90 rounded-xl hover:bg-red-500/10 hover:text-red-400 transition-all duration-200 border border-transparent">
            <i
                class="fa-solid fa-power-off w-4 mr-3 text-center text-sm transition-transform duration-300 group-hover:rotate-45"></i>
            <span class="tracking-wide">Keluar Sistem</span>
        </a>
    </div>

</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>

<style>
    .custom-sidebar-scroll::-webkit-scrollbar {
        width: 4px;
    }

    .custom-sidebar-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-sidebar-scroll::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 10px;
    }

    .custom-sidebar-scroll:hover::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.12);
    }
</style>
