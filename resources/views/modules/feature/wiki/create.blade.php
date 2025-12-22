@extends('layouts.' . auth()->user()->role)

@section('content')
<div class="container">
    <h1 class="text-xl font-bold mb-4">Tambah Wiki</h1>

    <form action="{{ route('wiki.store') }}" method="POST">
        @include('modules.feature.wiki._form')
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
        <a href="{{ route('wiki.index') }}" class="ml-2 text-gray-600">Batal</a>
    </form>
</div>
@endsection