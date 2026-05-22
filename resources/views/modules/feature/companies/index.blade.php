@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Manajemen Perusahaan')

@section('content')

    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <!-- HEADER -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">
                    Daftar Customer
                </h1>
                <p class="text-sm text-gray-500 mt-1">
                    Kelola data customer perusahaan dengan tampilan modern dan terorganisir.
                </p>
            </div>

            @if (auth()->user()->role != 'inspektor')
                <a href="{{ route('companies.create') }}"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl
                    bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium 
                    shadow-sm shadow-blue-500/10 transition-all duration-200 shrink-0">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Tambah Customer
                </a>
            @endif
        </div>

        <!-- SEARCH BAR -->
        <div class="bg-white rounded-xl border border-gray-200/80 shadow-sm p-4 mb-6">
            <div class="relative">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" id="search" placeholder="Cari nama, alamat, atau telepon..."
                    onkeyup="filterTable()"
                    class="w-full pl-11 pr-4 py-2.5 rounded-lg border border-gray-300 bg-gray-50/50
                    text-gray-800 text-sm placeholder:text-gray-400 focus:outline-none
                    focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all">
            </div>
        </div>

        <!-- CARD GRID -->
        <div id="companyGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach ($companies as $company)
                <div
                    class="company-card bg-white rounded-xl border border-gray-200/80 shadow-sm 
                    hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 overflow-hidden flex flex-col">

                    <!-- TOP / HEADER CARD -->
                    <div class="p-5 border-b border-gray-100 bg-gray-50/30">
                        <div class="flex items-start justify-between gap-3">
                            <div class="space-y-0.5">
                                <h2 class="text-base font-semibold text-gray-900 leading-snug line-clamp-1">
                                    {{ $company->name }}
                                </h2>
                                <span
                                    class="inline-flex items-center text-[11px] font-medium text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md">
                                    Customer Perusahaan
                                </span>
                            </div>
                            <div
                                class="w-9 h-9 rounded-lg bg-gray-100 flex items-center justify-center shrink-0 text-gray-500">
                                <i class="fa-solid fa-building text-sm"></i>
                            </div>
                        </div>
                    </div>

                    <!-- CONTENT -->
                    <div class="p-5 space-y-3.5 flex-1 text-sm">
                        <!-- ADDRESS -->
                        <div class="flex gap-3 items-start">
                            <div class="w-5 h-5 flex items-center justify-center shrink-0 text-gray-400 mt-0.5">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="space-y-0.5">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Alamat</p>
                                <p class="text-gray-600 leading-relaxed line-clamp-2">
                                    {{ $company->address }}
                                </p>
                            </div>
                        </div>

                        <!-- PHONE -->
                        <div class="flex gap-3 items-start">
                            <div class="w-5 h-5 flex items-center justify-center shrink-0 text-gray-400 mt-0.5">
                                <i class="fa-solid fa-phone"></i>
                            </div>
                            <div class="space-y-0.5">
                                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Telepon</p>
                                <p class="text-gray-600 font-medium">
                                    {{ $company->phone }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER / ACTIONS -->
                    <div class="px-5 py-3 border-t border-gray-100 bg-gray-50/50 mt-auto">
                        @if (auth()->user()->role == 'inspektor')
                            <div
                                class="w-full py-1.5 rounded-lg bg-gray-100 text-gray-500 text-center font-medium text-xs flex items-center justify-center gap-1.5">
                                <i class="fa-solid fa-eye text-[11px]"></i>
                                View Only
                            </div>
                        @else
                            <div class="flex gap-2">
                                <!-- EDIT -->
                                <a href="{{ route('companies.edit', $company->id) }}"
                                    class="flex-1 py-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 
                                    text-xs font-semibold text-center transition-colors flex items-center justify-center gap-1">
                                    <i class="fa-solid fa-pen text-[10px]"></i>
                                    Edit
                                </a>

                                <!-- DELETE -->
                                <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="flex-1"
                                    onsubmit="return confirm('Hapus customer ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="w-full py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 
                                        text-xs font-semibold transition-colors flex items-center justify-center gap-1">
                                        <i class="fa-solid fa-trash text-[10px]"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>

        <!-- PAGINATION -->
        <div class="mt-6">
            {{ $companies->links() }}
        </div>

    </div>

    <script>
        function filterTable() {
            let search = document.getElementById("search").value.toLowerCase();
            let cards = document.querySelectorAll(".company-card");

            cards.forEach(card => {
                let text = card.innerText.toLowerCase();
                if (text.includes(search)) {
                    card.style.display = "flex"; /* Menjaga struktur flex pada card */
                } else {
                    card.style.display = "none";
                }
            });
        }
    </script>

@endsection
