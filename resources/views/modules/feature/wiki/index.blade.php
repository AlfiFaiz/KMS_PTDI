@extends('layouts.' . auth()->user()->role)

@section('content')
<div class="bg-gray-50 p-6 rounded-xl shadow-md">
    <h1 class="text-xl font-bold mb-4">Daftar Wiki</h1>

    @if(in_array(auth()->user()->role, ['admin','manajemen','inspektor']))
        <a href="{{ route('wiki.create') }}" class="btn btn-primary mb-3">Tambah Wiki</a>
    @endif

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($wikis as $wiki)
            <tr>
                <td>{{ $wiki->title }}</td>
                <td>{{ $wiki->status }}</td>
                <td>
                    <a href="{{ route('wiki.show',$wiki) }}" class="btn btn-sm btn-info">Lihat</a>

                    @if(in_array(auth()->user()->role, ['admin','manajemen','inspektor']))
                        <a href="{{ route('wiki.edit',$wiki) }}" class="btn btn-sm btn-warning">Edit</a>
                    @endif

                    @if(auth()->user()->role === 'admin')
                        <form action="{{ route('wiki.destroy',$wiki) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $wikis->links() }}
</div>
@endsection