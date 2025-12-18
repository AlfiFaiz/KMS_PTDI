@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Manajemen Info')

@section('content')
    <br>
    <div class="bg-white p-6 rounded-xl shadow-md">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-blue-700">Daftar Info</h2>
            <a href="{{ route('infos.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                + Tambah Info
            </a>
        </div>

        <div class="mb-4 flex flex-col md:flex-row justify-between items-center gap-4">
            <!-- Search Judul/Konten -->
            <input type="text" id="search" class="border p-2 rounded w-full md:w-1/3"
                placeholder="Cari Judul atau Konten..." onkeyup="filterTable()">

            <!-- Filter Gambar -->
            <select id="filterImage" class="border p-2 rounded w-full md:w-1/3" onchange="filterTable()">
                <option value="">-- Semua --</option>
                <option value="ada">Dengan Gambar</option>
                <option value="tidak">Tanpa Gambar</option>
            </select>
        </div>

        @if (session('success'))
            <div class="p-3 bg-green-200 text-green-800 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered w-full bg-white" id="infoTable">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Judul</th>
                    <th class="p-2">Konten</th>
                    <th class="p-2">Gambar</th>
                    <th class="p-2 w-40">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($infos as $info)
                    <tr>
                        <td class="p-2">{{ $info->title }}</td>
                        <td class="p-2">{!! Str::limit($info->content, 50) !!}</td>
                        <td class="p-2">
                            @if($info->image_path)
                                <img src="{{ asset('storage/' . $info->image_path) }}" alt="Info Image"
                                     class="w-20 h-20 object-cover rounded">
                            @else
                                <span class="text-gray-500">Tidak ada gambar</span>
                            @endif
                        </td>
                         <td class="p-2 flex flex-wrap gap-2">
                            <a href="{{ route('infos.edit', $info->id) }}"
                               class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                Edit
                            </a>

                            <form action="{{ route('infos.destroy', $info->id) }}" method="POST" class="inline-block"
                                  onsubmit="return confirm('Hapus info ini?')">
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
            {{ $infos->links() }}
        </div>

    </div>

    <script>
        function filterTable() {
            let search = document.getElementById("search").value.toLowerCase();
            let filterImage = document.getElementById("filterImage").value;
            let table = document.getElementById("infoTable");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let judul = rows[i].getElementsByTagName("td")[0]?.textContent.toLowerCase() || "";
                let konten = rows[i].getElementsByTagName("td")[1]?.textContent.toLowerCase() || "";
                let gambarCell = rows[i].getElementsByTagName("td")[2];
                let adaGambar = gambarCell.querySelector("img") !== null;

                let matchesSearch = judul.includes(search) || konten.includes(search);
                let matchesFilter = filterImage === "" ||
                                    (filterImage === "ada" && adaGambar) ||
                                    (filterImage === "tidak" && !adaGambar);

                rows[i].style.display = matchesSearch && matchesFilter ? "" : "none";
            }
        }
    </script>
@endsection