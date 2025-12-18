@extends('layouts.pelanggan')


@section('title', 'QMS - ' . optional($qms->first())->type)
@section('content')
<div class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/hanggar.png') }}');">
    <div class="bg-black bg-opacity-50 min-h-screen flex flex-col items-center justify-start py-10">
    <div class="container mx-auto px-4 md:px-6 lg:px-12 py-12">
        <div class="mt-6 bg-white p-6 shadow rounded-lg">
            <h2 class="text-xl font-bold mb-4">Daftar QMS</h2>

            <!-- Pencarian & Filter -->
            <div class="mb-4 flex flex-col md:flex-row justify-between items-center gap-4">
                <input type="text" id="search" class="border p-2 rounded w-full md:w-1/3" placeholder="Cari berdasarkan Nomor atau Judul..." onkeyup="filterTable()">
                
            </div>

            <!-- Tabel -->
            <div class="overflow-x-auto">
                <table class="w-full border-collapse" id="formTable">
                    <thead>
                        <tr class="bg-blue-600 text-white">
                            <th class="p-2 border">No</th>
                            <th class="p-2 border">Nomor</th>
                            <th class="p-2 border">Judul</th>
                            <th class="p-2 border">Date Issued</th>
                            <th class="p-2 border">Org</th>
                            <th class="p-2 border">Rev</th>
                            <th class="p-2 border">Amend</th>
                            <th class="p-2 border">Affected Function</th>
                            <th class="p-2 border">File</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($qms as $index => $q)
                        <tr class="border text-center">
                            <td class="p-2 border">{{ $qms->firstItem() + $index }}</td>
                            <td class="p-2 border">{{ $q->nomor }}</td>
                            <td class="p-2 border">{{ $q->judul }}
                                <P class="text-blue-600 font-bold"> [ {{ $q->type }} ]</P>
                            </td>
                            <td class="p-2 border">{{ $q->date_issued }}</td>
                            <td class="p-2 border">{{ $q->org }}</td>
                            <td class="p-2 border">{{ $q->rev }}</td>
                            <td class="p-2 border">{{ $q->amend }}</td>
                            <td class="p-2 border">{{ $q->affected_function }}</td>
                            <td class="p-2 border">
                                @if ($q->file_path)
                                <a href="{{ asset('storage/' . $q->file_path) }}" target="_blank" class="text-blue-600 hover:underline">Download</a>
                                @else
                                    <span class="text-gray-500">Tidak ada file</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pesan jika kosong -->
            @if($qms->isEmpty())
                <p class="text-center text-gray-500 mt-4">Tidak ada data.</p>
            @endif
            



<!-- Pagination -->
<div id="pagination">
    {{ $qms->appends(['limit' => request('limit')])->links() }}
</div>

            </div>
            <div class="flex justify-center mt-6">
                        <a href="{{ url()->previous() }}" class="bg-gray-700 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-900">
                            Kembali
                        </a>
                    </div>
        </div>
    </div>
</div>


<!-- JavaScript -->
<script>
  function filterTable() {
    let search = document.getElementById("search").value.toLowerCase();
    let filterType = document.getElementById("filterType").value.toLowerCase();
    let table = document.getElementById("formTable");
    let rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {
        let nomor = rows[i].getElementsByTagName("td")[1]?.textContent.toLowerCase() || "";
        let judulCell = rows[i].getElementsByTagName("td")[2]; // Kolom Judul
        let judul = judulCell?.textContent.toLowerCase() || "";

        // Ambil type dari dalam <p> di kolom judul
        let type = judulCell?.querySelector('p')?.textContent.toLowerCase().replace(/\[|\]/g, '').trim() || "";

        let matchesSearch = nomor.includes(search) || judul.includes(search);
        let matchesFilter = filterType === "" || type === filterType;

        rows[i].style.display = matchesSearch && matchesFilter ? "" : "none";
    }
}



    function changeLimit() {
    let limit = document.getElementById("limit").value;
    window.location.href = `?limit=${limit}`;
}

// Sembunyikan pagination jika "Tampilkan Semua" dipilih
document.addEventListener("DOMContentLoaded", function() {
    let limit = document.getElementById("limit").value;
    if (limit === "all") {
        document.getElementById("pagination").style.display = "none";
    }
});

</script>
@endsection
