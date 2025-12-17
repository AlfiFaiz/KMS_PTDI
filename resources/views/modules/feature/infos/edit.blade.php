@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Edit Info')

@section('content')
<div class="bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold text-blue-700 mb-4">Edit Info</h2>

    <form action="{{ route('infos.update', $info->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @include('modules.feature.infos._form')
    </form>
</div>
@endsection