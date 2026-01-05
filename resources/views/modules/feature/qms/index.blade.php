@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Manajemen QMS')

@section('content')
    <br>
    <div class="bg-gray-50 p-6 rounded-xl shadow-md">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-blue-700">Daftar Dokumen QMS</h2>
            <a href="{{ route('qms.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                + Tambah Dokumen
            </a>
        </div>
        <div class="mb-4 flex flex-col md:flex-row justify-between items-center gap-4">
            <!-- Search Nomor/Judul -->
            <input type="text" id="search" class="border p-2 rounded w-full md:w-1/3"
                placeholder="Cari Nomor atau Judul..." onkeyup="filterTable()">

            <!-- Filter Type -->
            <select id="filterType" class="border p-2 rounded w-full md:w-1/3" onchange="filterTable()">
    <option value="">-- Semua Type --</option>
    <option value="MANUAL">MANUAL</option>
    <option value="QUALITY DOCUMENT">QUALITY DOCUMENT</option>
    <option value="PROCEDURE">PROCEDURE</option>
    <option value="WORK INSTRUCTION">WORK INSTRUCTION</option>
    <option value="FORM">FORM</option>
</select>
        </div>

        @if (session('success'))
            <div class="p-3 bg-green-200 text-green-800 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered w-full bg-gray-50" id="qmsTable">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Nomor</th>
                    <th class="p-2">Judul</th>
                    <th class="p-2">Issued</th>
                    <th class="p-2">Rev</th>
                    <th class="p-2">Type</th>
                    <th class="p-2 w-40">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($qms as $q)
                    <tr>
                        <td class="p-2">{{ $q->nomor }}</td>
                        <td class="p-2">{{ $q->judul }}</td>
                        <td class="p-2">{{ $q->date_issued }}</td>
                        <td class="p-2">{{ $q->rev }}</td>
                        <td class="p-2">{{ $q->type }}</td>
                         <td class="p-2 flex flex-wrap gap-2">
                            <a href="{{ route('qms.edit', $q->id) }}"
                                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                Edit
                            </a>

                            <form action="{{ route('qms.destroy', $q->id) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Hapus dokumen ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $qms->links() }}
        </div>

    </div>
    <script>
        function filterTable() {
            let search = document.getElementById("search").value.toLowerCase();
            let filterType = document.getElementById("filterType").value.toLowerCase();
            let table = document.getElementById("qmsTable");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let nomor = rows[i].getElementsByTagName("td")[0]?.textContent.toLowerCase() || "";
                let judul = rows[i].getElementsByTagName("td")[1]?.textContent.toLowerCase() || "";
                let type = rows[i].getElementsByTagName("td")[4]?.textContent.toLowerCase() || "";

                let matchesSearch = nomor.includes(search) || judul.includes(search);
                let matchesFilter = filterType === "" || type === filterType;

                rows[i].style.display = matchesSearch && matchesFilter ? "" : "none";
            }
        }
    </script>

@endsection
