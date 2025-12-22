@extends('layouts.' . auth()->user()->role)

@section('content')
<div class="container">
    <h1 class="text-xl font-bold">{{ $wiki->title }}</h1>
    <p class="text-gray-500">Kategori: {{ $wiki->category }} | Status: {{ $wiki->status }}</p>

  <div class="trix-content prose max-w-none">
    {!! $wiki->content !!}
</div>



    <div class="mt-6">
        {{-- Tombol untuk Inspektor --}}
        @if(auth()->user()->role === 'inspektor' && $wiki->status === 'draft')
            <form method="POST" action="{{ route('wiki.review',$wiki) }}">
                @csrf
                <button type="submit" class="btn btn-primary">Kirim ke Review</button>
            </form>
        @endif

        {{-- Tombol untuk Manajemen & Admin --}}
        @if(in_array(auth()->user()->role, ['manajemen','admin']))
            @if($wiki->status === 'review')
                <form method="POST" action="{{ route('wiki.publish',$wiki) }}">
                    @csrf
                    <button type="submit" class="btn btn-success">Publish</button>
                </form>
            @endif

            @if($wiki->status === 'published')
                <form method="POST" action="{{ route('wiki.archive',$wiki) }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Archive</button>
                </form>
            @endif
        @endif
    </div>

    <div class="mt-6">
        <h2 class="font-bold">Versi Sebelumnya</h2>
        <ul>
            @foreach($wiki->versions as $version)
                <li>
                    <a href="{{ route('wiki.version.show', [$wiki, $version]) }}">
                        Versi tanggal {{ $version->edited_at->format('d M Y H:i') }}
                        oleh {{ $version->editor->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection