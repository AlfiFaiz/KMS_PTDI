@extends('layouts.' . auth()->user()->role)

@section('content')
<div class="container">
    @if($errors->any())
    <div class="bg-red-100 text-red-700 p-2 mb-4">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <h1 class="text-xl font-bold mb-4">Edit Wiki</h1>
<form action="{{ route('wiki.update', $wiki) }}" method="POST">
    @csrf
    @method('PUT')
    @include('modules.feature.wiki._form')
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
</form>
</div>
@endsection