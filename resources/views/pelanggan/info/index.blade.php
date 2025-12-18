@extends('layouts.pelanggan')

@section('title', 'Informasi')

@section('content')
<div class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/hanggar.png') }}');">
    <div class="bg-black bg-opacity-50 min-h-screen flex flex-col items-center justify-start py-10">
        <h1 class="text-3xl font-bold text-white mb-8">Informasi Terbaru</h1>

        <div class="w-11/12 md:w-3/4 lg:w-2/3 grid md:grid-cols-2 gap-6">
            @foreach($infos as $info)
                <!-- Card -->
                <div 
                    class="bg-blue-900 bg-opacity-80 shadow-lg rounded-lg overflow-hidden transform hover:scale-105 transition duration-300 cursor-pointer"
                    onclick="openModal({{ $info->id }})">
                    
                    @if($info->image_path)
                        <div class="w-full h-56 bg-gray-100">
                            <img src="{{ asset('storage/' . $info->image_path) }}" 
                                 alt="Info Image" 
                                 class="w-full h-full object-contain rounded-md mx-auto">
                        </div>
                    @endif

                    <div class="p-6">
                        <h2 class="text-lg font-bold text-white mb-2">{{ $info->title }}</h2>
                        <div class="text-gray-200 mb-3">
                            {!! Str::words($info->content, 20, '...') !!}
                        </div>
                        <p class="text-sm text-gray-300">
                            Dipublikasikan: {{ $info->created_at->format('d M Y') }}
                        </p>
                    </div>
                </div>

                <!-- Modal -->
                <div id="modal-{{ $info->id }}" 
                     class="fixed inset-0 hidden items-center justify-center z-50 
                            bg-cover bg-center backdrop-blur-md"
                     style="background-image: url('{{ asset('images/hanggar.png') }}');">
                    <div class="bg-blue-900 bg-opacity-90 rounded-lg shadow-lg max-w-lg w-full p-6 relative text-white">
                        <button onclick="closeModal({{ $info->id }})" 
                                class="absolute top-3 right-3 text-gray-200 hover:text-red-400">
                            ✖
                        </button>
                        <h2 class="text-xl font-bold mb-4">{{ $info->title }}</h2>
                        @if($info->image_path)
                            <img src="{{ asset('storage/' . $info->image_path) }}" 
                                 alt="Info Image" 
                                 class="w-full h-64 object-contain mb-4">
                        @endif
                        <div class="prose max-w-none text-gray-100 mb-3">
                            {!! $info->content !!}
                        </div>
                        <p class="text-sm text-gray-300">
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

<script>
    function openModal(id) {
        const modal = document.getElementById('modal-' + id);
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    function closeModal(id) {
        const modal = document.getElementById('modal-' + id);
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>
@endsection