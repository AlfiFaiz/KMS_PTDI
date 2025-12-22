@extends('layouts.' . auth()->user()->role)

@section('content')
<div class="container">
    <h1 class="text-xl font-bold">Perbandingan Versi</h1>
    <p class="text-gray-500">
        Versi baru tanggal {{ \Carbon\Carbon::parse($newVersion->edited_at)->format('d M Y H:i') }}
        oleh {{ $newVersion->editor->name }}
    </p>

    <div class="grid grid-cols-2 gap-6 mt-6">
        <div>
            <h2 class="font-semibold text-gray-700">Versi Lama</h2>
            @if($oldVersion)
                <div class="prose max-w-none border p-4 bg-white">
                    {!! $oldVersion->content !!}
                </div>
                <p class="text-xs text-gray-500 mt-2">
                    Diedit {{ \Carbon\Carbon::parse($oldVersion->edited_at)->format('d M Y H:i') }} oleh {{ $oldVersion->editor->name }}
                </p>
            @else
                <div class="border p-4 bg-white text-gray-500">
                    Tidak ada versi sebelumnya untuk dibandingkan.
                </div>
            @endif
        </div>

        <div>
            <h2 class="font-semibold text-gray-700">Versi Baru</h2>
            <div class="prose max-w-none border p-4 bg-white">
                {!! $newVersion->content !!}
            </div>
        </div>
    </div>
</div>
@endsection