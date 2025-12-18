@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Manajemen Sertifikat')

@section('content')
    <br>
    <div class="bg-gray-50 p-6 rounded-xl shadow-md">

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-blue-700">Daftar Sertifikat</h2>
            <a href="{{ route('certificates.create') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                + Tambah Sertifikat
            </a>
        </div>

        @if (session('success'))
            <div class="p-3 bg-green-200 text-green-800 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered w-full bg-gray-50">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-2">Nomor</th>
                    <th class="p-2">Judul</th>
                    <th class="p-2">Issued</th>
                    <th class="p-2">Issued By</th>
                    <th class="p-2 w-40">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($certificates as $c)
                    <tr>
                        <td class="p-2">{{ $c->nomor }}</td>
                        <td class="p-2">{{ $c->judul }}</td>
                        <td class="p-2">{{ $c->date_issued }}</td>
                        <td class="p-2">{{ $c->issued_by }}</td>
                        <td class="p-2 flex flex-wrap gap-2">
                            <a href="{{ route('certificates.edit', $c->id) }}"
                                class="px-3 py-1 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                Edit
                            </a>

                            <form action="{{ route('certificates.destroy', $c->id) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Hapus sertifikat ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>

                            <a href="{{ asset('storage/certificates/' . $c->file_path) }}"
                                class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700" target="_blank">
                                File
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $certificates->links() }}
        </div>

    </div>

@endsection
