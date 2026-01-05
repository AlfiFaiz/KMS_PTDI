@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Aircraft Programs')

@section('content')
    <br>
    <div class="bg-gray-50 p-6 rounded-xl shadow-md">
        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold text-blue-700">Daftar Aircraft Program</h2>
            <a href="{{ route('aircraft-programs.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
                + Tambah Program
            </a>
        </div>
        <div class="mb-4">
            <input type="text" id="search" class="border p-2 rounded w-full md:w-1/3"
                placeholder="Cari Program atau Registration..." onkeyup="filterTable()">
        </div>


        @if (session('success'))
            <div class="p-3 bg-green-200 text-green-800 rounded mb-4">{{ session('success') }}</div>
        @endif

        <table class="table w-full" id="programTable">
            <thead class="bg-gray-100">
                <tr>
                    <th>Program</th>
                    <th>Aircraft Type</th>
                    <th>Registration</th>
                    <th>Company</th>
                    <th>Gambar</th>
                    <th>Progress</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($programs as $p)
                    @php
                        $totalOrders = $p->engineeringOrders->count();
                        $finishedOrders = $p->engineeringOrders
                            ->whereNotNull('finish_date')
                            ->whereNotNull('insp_stamp')
                            ->count();
                        $progress = $totalOrders > 0 ? round(($finishedOrders / $totalOrders) * 100) : 0;
                    @endphp
                    <tr>
                        <td>{{ $p->program }}</td>
                        <td>{{ $p->aircraft_type }}</td>
                        <td>{{ $p->registration }}</td>
                        <td>{{ $p->company->name }}</td>
   <td>
    @if ($p->image)
        <a href="{{ asset('storage/aircraft_images/' . $p->image) }}" target="_blank">
            <img src="{{ asset('storage/aircraft_images/' . $p->image) }}" 
                 class="w-24 rounded shadow hover:opacity-80 transition">
        </a>
    @else
        <span class="text-gray-400">No Image</span>
    @endif
</td>

                        <td class="w-48">
                            <div class="w-full bg-gray-200 rounded-full h-4">
                                <div class="bg-blue-600 h-4 rounded-full" style="width: {{ $progress }}%"></div>
                            </div>
                            <small>{{ $finishedOrders }}/{{ $totalOrders }} selesai ({{ $progress }}%)</small>
                        </td>
                        <td>
    <div class="flex flex-wrap gap-2">
        <a href="{{ route('aircraft-programs.edit', $p->id) }}"
           class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>

        <form action="{{ route('aircraft-programs.destroy', $p->id) }}" method="POST"
              onsubmit="return confirm('Hapus program ini?')">
            @csrf @method('DELETE')
            <button class="px-2 py-1 bg-red-600 text-white rounded">Hapus</button>
        </form>

        <a href="{{ route('engineering-orders.index', $p->id) }}"
           class="px-2 py-1 bg-green-600 text-white rounded">Engineering Orders</a>
           @if($p->document_file)
    <a href="{{ asset('storage/aircraft_documents/' . $p->document_file) }}" 
       target="_blank"
       class="px-2 py-1 bg-blue-600 text-white rounded text-xs font-semibold hover:bg-blue-700 transition-colors flex items-center">
       <i class="fa-solid fa-file-pdf mr-1"></i> Lihat Dokumen RTS
    </a>
    @else
        <span class="px-2 py-1 bg-gray-400 text-white rounded text-xs font-semibold cursor-not-allowed">
            No File RTS
        </span>
    @endif

        <a href="{{ route('work-package.create', $p->id) }}"
           class="px-2 py-1 bg-indigo-600 text-white rounded">
           Summary of Work Package
        </a>
    </div>
</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $programs->links() }}</div>
    </div>
    <script>
        function filterTable() {
            let search = document.getElementById("search").value.toLowerCase();
            let table = document.getElementById("programTable");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let program = rows[i].getElementsByTagName("td")[0]?.textContent.toLowerCase() || "";
                let registration = rows[i].getElementsByTagName("td")[2]?.textContent.toLowerCase() || "";

                let matchesSearch = program.includes(search) || registration.includes(search);

                rows[i].style.display = matchesSearch ? "" : "none";
            }
        }
    </script>

@endsection
