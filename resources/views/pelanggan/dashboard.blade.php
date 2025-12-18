@extends('layouts.pelanggan')

@section('title', 'Dashboard')
@section('content')
    <!-- Notifikasi -->

    <div class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/hanggar.png') }}');">
        <div class="container mx-auto px-4 md:px-6 lg:px-12 py-12">
            <h2 class="text-2xl font-bold text-white mb-6">Dokumen QMS</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
                <!-- FORM -->
                <div
                    class="bg-blue-900 bg-opacity-80 shadow-lg rounded-lg p-2 transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                    <a href="{{ route('pelanggan/qms/form') }}">
                        <img src="{{ asset('images/qms/1.png') }}" alt="Form QMS"
                            class="w-full h-32 object-contain rounded-md mx-auto">
                        <p class="text-white text-center mt-2 font-semibold">FORM</p>
                    </a>
                </div>

                <!-- MANUAL -->
                <div
                    class="bg-blue-900 bg-opacity-80 shadow-lg rounded-lg p-2 transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                    <a href="{{ route('pelanggan/qms/manual') }}">
                        <img src="{{ asset('images/qms/2.png') }}" alt="Manual QMS"
                            class="w-full h-32 object-contain rounded-md mx-auto">
                        <p class="text-white text-center mt-2 font-semibold">MANUAL</p>
                    </a>
                </div>

                <!-- PROCEDURE -->
                <div
                    class="bg-blue-900 bg-opacity-80 shadow-lg rounded-lg p-2 transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                    <a href="{{ route('pelanggan/qms/procedure') }}">
                        <img src="{{ asset('images/qms/3.png') }}" alt="Procedure QMS"
                            class="w-full h-32 object-contain rounded-md mx-auto">
                        <p class="text-white text-center mt-2 font-semibold">PROCEDURE</p>
                    </a>
                </div>

                <!-- WORK INSTRUCTION -->
                <div
                    class="bg-blue-900 bg-opacity-80 shadow-lg rounded-lg p-2 transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                    <a href="{{ route('pelanggan/qms/WI') }}">
                        <img src="{{ asset('images/qms/4.png') }}" alt="Work Instruction QMS"
                            class="w-full h-32 object-contain rounded-md mx-auto">
                        <p class="text-white text-center mt-2 font-semibold">WORK INSTRUCTION</p>
                    </a>
                </div>

                <!-- PERSONAL POSTER -->
                <div
                    class="bg-blue-900 bg-opacity-80 shadow-lg rounded-lg p-2 transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                    <a href="{{ route('pelanggan/qms/PP') }}">
                        <img src="{{ asset('images/qms/6.png') }}" alt="Personal Poster QMS"
                            class="w-full h-32 object-contain rounded-md mx-auto">
                        <p class="text-white text-center mt-2 font-semibold">PERSONAL POSTER</p>
                    </a>
                </div>

                <!-- TRAINING -->
                <div
                    class="bg-blue-900 bg-opacity-80 shadow-lg rounded-lg p-2 transition-transform duration-300 hover:scale-105 hover:shadow-2xl">
                    <a href="{{ route('pelanggan/qms/training') }}">
                        <img src="{{ asset('images/qms/5.png') }}" alt="Training QMS"
                            class="w-full h-32 object-contain rounded-md mx-auto">
                        <p class="text-white text-center mt-2 font-semibold">TRAINING</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
