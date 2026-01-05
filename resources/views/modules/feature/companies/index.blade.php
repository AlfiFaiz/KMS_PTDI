@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Manajemen Perusahaan')

@section('content')
    <br>
    <div class="bg-gray-50 p-6 rounded-xl shadow-md">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold mb-4">Daftar Customer</h1>

            <a href="{{ route('companies.create') }}" class="btn btn-primary mb-3">Tambah Customer</a>
        </div>
        <div class="mb-4">
            <input type="text" id="search" class="border p-2 rounded w-full md:w-1/3"
                placeholder="Cari Nama, Alamat, atau Telepon..." onkeyup="filterTable()">
        </div>

        <table class="table-auto w-full border" id="companyTable">
            <thead>
                <tr>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">Telepon</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                    <tr>
                        <td class="border px-4 py-2">{{ $company->name }}</td>
                        <td class="border px-4 py-2">{{ $company->address }}</td>
                        <td class="border px-4 py-2">{{ $company->phone }}</td>
                         <td class="p-2 flex flex-wrap gap-2">
                            <a href="{{ route('companies.edit', $company->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('companies.destroy', $company->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $companies->links() }}
    </div>
    <script>
        function filterTable() {
            let search = document.getElementById("search").value.toLowerCase();
            let table = document.getElementById("companyTable");
            let rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                let name = rows[i].getElementsByTagName("td")[0]?.textContent.toLowerCase() || "";
                let address = rows[i].getElementsByTagName("td")[1]?.textContent.toLowerCase() || "";
                let phone = rows[i].getElementsByTagName("td")[2]?.textContent.toLowerCase() || "";

                let matchesSearch = name.includes(search) || address.includes(search) || phone.includes(search);

                rows[i].style.display = matchesSearch ? "" : "none";
            }
        }
    </script>
@endsection
