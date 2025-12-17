@extends('layouts.pelanggan')

@section('page-title', 'Informasi')

@section('content')
<div class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/hanggar.png') }}');">
    <div class="bg-black bg-opacity-50 min-h-screen flex flex-col items-center justify-start py-10">
        <h1 class="text-3xl font-bold text-white mb-8">Informasi Terbaru</h1>

        <div class="w-11/12 md:w-3/4 lg:w-2/3 grid md:grid-cols-2 gap-6">
            @foreach($infos as $info)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition duration-300">
                    @if($info->image_path)
                        <div class="w-full h-56 bg-gray-100">
                            <img src="{{ asset('storage/' . $info->image_path) }}" 
                                 alt="Info Image" 
                                 class="w-full h-full object-contain">
                        </div>
                    @endif

                    <div class="p-6">
                        <h2 class="text-lg font-bold text-blue-700 mb-2">{{ $info->title }}</h2>
                        <div class="prose max-w-none text-gray-700 mb-3">
                            {!! Str::words($info->content, 20, '...') !!}
                        </div>
                        <p class="text-sm text-gray-500">
                            Dipublikasikan: {{ $info->created_at->format('d M Y') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 text-white">
            {{ $infos->links() }}
        </div>
    </div>
</div>
@endsection