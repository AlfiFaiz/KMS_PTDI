@extends('layouts.pelanggan')

@section('title', 'Dashboard')
@section('content')
    <div class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/hanggar.png') }}');">
    <div class="bg-black bg-opacity-50 min-h-screen flex flex-col items-center justify-start py-10">
        <div class="container mx-auto px-4 md:px-6 lg:px-12 py-12">
            <h2 class="text-4xl font-black text-white mb-8 uppercase tracking-tight">Dokumen QMS</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 sm:gap-6">
                
                @php
                    $menus = [
                        ['label' => 'MANUAL', 'route' => 'pelanggan/qms/manual', 'img' => '2.png'],
                        ['label' => 'QUALITY DOCUMENT', 'route' => 'pelanggan/qms/PP', 'img' => '6.png'],
                        ['label' => 'PROCEDURE', 'route' => 'pelanggan/qms/procedure', 'img' => '3.png'],
                        ['label' => 'WORK INSTRUCTION', 'route' => 'pelanggan/qms/WI', 'img' => '4.png'],
                        ['label' => 'FORM', 'route' => 'pelanggan/qms/form', 'img' => '1.png'],
                    ];
                @endphp

                @foreach($menus as $m)
                <div class="shadow-xl rounded-xl transition-transform duration-300 hover:scale-105 border border-white/20" 
                     style="background-color: #1e3a8a;">
                    <a href="{{ route($m['route']) }}" class="p-4 block flex flex-col items-center">
                        <img src="{{ asset('images/qms/' . $m['img']) }}" alt="{{ $m['label'] }}"
                             class="w-full h-32 object-contain rounded-md mx-auto brightness-110">
                        
                        <p class="text-white text-center mt-4 font-bold text-xs tracking-widest uppercase">
                            {{ $m['label'] }}
                        </p>
                    </a>
                </div>
                @endforeach

            </div>
        </div>
    </div>
    </div>
@endsection