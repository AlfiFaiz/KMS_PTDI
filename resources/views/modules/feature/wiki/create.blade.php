@extends('layouts.' . auth()->user()->role)

@section('page-title', 'Create Wiki')

@section('content')
    <div class="min-h-screen bg-gray-50/50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div
                class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 bg-white p-6 rounded-2xl border border-gray-200/80 shadow-sm">
                <div>
                    <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                        Create Wiki
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Tambahkan knowledge baru ke sistem dokumentasi.
                    </p>
                </div>
                <div>
                    <a href="{{ route('wiki.index') }}"
                        class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-semibold text-gray-700 shadow-sm hover:bg-gray-50 transition-all duration-200">
                        Kembali
                    </a>
                </div>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200/60 rounded-2xl p-5 shadow-sm">
                    <div class="flex items-center space-x-2 text-red-800 font-semibold mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span>Validation Error</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-sm text-red-700 pl-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-2xl border border-gray-200/80 shadow-sm p-6 sm:p-8">
                <form action="{{ route('wiki.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    @include('modules.feature.wiki._form')
                </form>
            </div>

        </div>
    </div>
@endsection
