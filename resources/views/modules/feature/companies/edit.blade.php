@extends('layouts.admin')

@section('page-title', 'Edit Perusahaan')

@section('content')

    <div class="max-w-xl mx-auto py-6 px-4">

        <!-- CARD CONTAINER -->
        <div class="bg-white rounded-xl border border-gray-200/80 shadow-sm p-6 sm:p-8">

            <!-- HEADER FORM -->
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900 tracking-tight">
                    Edit Perusahaan
                </h2>
                <p class="text-xs text-gray-500 mt-1">
                    Perbarui informasi data customer atau perusahaan di bawah ini.
                </p>
            </div>

            <!-- FORM -->
            <form action="{{ route('companies.update', $company->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <!-- NAMA PERUSAHAAN -->
                <div class="space-y-1">
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">
                        Nama Perusahaan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" value="{{ $company->name }}" required
                        class="w-full px-3.5 py-2 rounded-lg border border-gray-300 bg-gray-50/50
                        text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/10 
                        focus:border-blue-500 focus:bg-white transition-all">
                </div>

                <!-- ALAMAT -->
                <div class="space-y-1">
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">
                        Alamat
                    </label>
                    <input type="text" name="address" value="{{ $company->address }}"
                        class="w-full px-3.5 py-2 rounded-lg border border-gray-300 bg-gray-50/50
                        text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/10 
                        focus:border-blue-500 focus:bg-white transition-all">
                </div>

                <!-- TELEPON -->
                <div class="space-y-1">
                    <label class="text-[11px] font-bold text-gray-400 uppercase tracking-wider block">
                        Telepon
                    </label>
                    <input type="text" name="phone" value="{{ $company->phone }}"
                        class="w-full px-3.5 py-2 rounded-lg border border-gray-300 bg-gray-50/50
                        text-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/10 
                        focus:border-blue-500 focus:bg-white transition-all">
                </div>

                <!-- BUTTON ACTIONS -->
                <div class="flex items-center justify-end gap-2.5 pt-4 border-t border-gray-100 mt-6">
                    <a href="{{ route('companies.index') }}"
                        class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-gray-600 
                        text-xs font-semibold transition-colors text-center">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white 
                        text-xs font-semibold shadow-sm shadow-blue-500/10 transition-colors text-center">
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>

    </div>

@endsection
