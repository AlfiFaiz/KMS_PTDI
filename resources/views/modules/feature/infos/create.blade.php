@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Tambah Info')

@section('content')
<div class="bbg-gray-50 p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">Tambah Info</h2>

    <form action="{{ route('infos.store') }}" method="POST" enctype="multipart/form-data">
        @include('modules.feature.infos._form')
    </form>
</div>
@endsection