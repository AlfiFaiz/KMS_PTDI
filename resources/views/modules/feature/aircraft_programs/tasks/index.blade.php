@extends('layouts.' . auth()->user()->role)

@section('title', 'Tasks')
@section('page-title', 'Daftar Task')

@section('content')
    <br>
    <div class="bg-gray-50 p-6 rounded-xl shadow-md">
        <div class="flex justify-between mb-4">
            <h2 class="text-2xl font-bold text-blue-700">Daftar Task</h2>
            <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">+ Tambah Task</a>
        </div>

        @if (session('success'))
            <div class="p-3 bg-green-200 text-green-800 rounded mb-4">{{ session('success') }}</div>
        @endif

        <table class="table w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th>Nama Task</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $t)
                    <tr>
                        <td>{{ $t->name }}</td>
                        <td>{{ $t->description }}</td>
                        <td>
                            <a href="{{ route('tasks.edit', $t->id) }}"
                                class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                            <form action="{{ route('tasks.destroy', $t->id) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Hapus task ini?')">
                                @csrf @method('DELETE')
                                <button class="px-2 py-1 bg-red-600 text-white rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $tasks->links() }}</div>
    </div>
@endsection
