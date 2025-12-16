@extends('layouts.pelanggan')

@section('content')
    <div class="bg-cover bg-center min-h-screen" style="background-image: url('{{ asset('images/hanggar.png') }}');">
        <div class="container mx-auto px-4 md:px-6 lg:px-12 py-12">

            <!-- Judul -->
            <div class="text-center mt-4 text-white">
                <h1 class="text-3xl font-extrabold">Work Package Summary for {{ $program->aircraft_type }}</h1>
                <p class="text-lg">{{ $program->registration }} - {{ $program->company->name }}</p>
            </div>

            <!-- Detail Aircraft Program -->
            <div class="bg-white p-6 rounded-xl shadow-md mt-6">
                <h2 class="text-2xl font-bold text-blue-700 mb-4">Detail Aircraft Program</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p><span class="font-semibold">Program:</span> {{ $program->program }}</p>
                        <p><span class="font-semibold">Aircraft Type:</span> {{ $program->aircraft_type }}</p>
                        <p><span class="font-semibold">Registration:</span> {{ $program->registration }}</p>
                    </div>
                    <div>
                        <p><span class="font-semibold">Company:</span> {{ $program->company->name }}</p>
                        @if ($program->image)
                            <p class="mt-2"><span class="font-semibold">Image:</span></p>
                            <img src="{{ asset('storage/aircraft_images/' . $program->image) }}"
                                class="w-48 rounded shadow">
                        @else
                            <span class="text-gray-400">No Image</span>
                        @endif
                    </div>
                </div>
                <br>
                <div class="flex-1">
                    <div class="w-full bg-gray-700 rounded-full h-4">
                        <div class="bg-green-500 h-4 rounded-full transition-all duration-300"
                            style="width: {{ $progressPercentage }}%;"></div>
                    </div>
                    <p class="text-xs text-black mt-1 text-right">{{ $progressPercentage }}%</p>
                </div>
            </div>

            <!-- Summary Table -->
            <div class="mt-6 bg-white p-4 rounded-lg shadow-lg">
                <div class="overflow-auto max-h-[400px] border border-gray-600 p-2">
                    @if ($summary)
                        @foreach ($summary->items->groupBy('section') as $section => $sectionItems)
                            <h2 class="bg-blue-600 text-white text-lg font-bold px-4 py-2">{{ strtoupper($section) }}</h2>
                            <table class="w-full border-collapse border border-gray-600 mb-4">
                                <thead class="bg-gray-300">
                                    <tr>
                                        <th class="border border-gray-600 px-4 py-2">No</th>
                                        <th class="border border-gray-600 px-4 py-2">Item</th>
                                        <th class="border border-gray-600 px-4 py-2">Status</th>
                                        <th class="border border-gray-600 px-4 py-2">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody class="text-black">
                                    @php $rowNumber = 1; @endphp
                                    @foreach ($sectionItems as $item)
                                        <tr class="hover:bg-gray-200">
                                            <td class="border border-gray-600 px-4 py-2">{{ $rowNumber++ }}</td>
                                            <td class="border border-gray-600 px-4 py-2">{{ strtoupper($item->item) }}</td>
                                            <td class="border border-gray-600 px-4 py-2">{{ $item->status }}</td>
                                            <td class="border border-gray-600 px-4 py-2">{{ $item->remarks }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endforeach
                    @else
                        <div class="p-4 bg-red-100 text-red-700 rounded">
                            Belum ada summary untuk program ini.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tombol Download PDF -->
            @if ($summary)
                <div class="flex justify-center mt-4 gap-4">
                    <a href="{{ route('work-package.download', $summary->id) }}"
                        class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Download Summary (PDF)
                    </a>
                </div>
            @endif

            <!-- Tombol Kembali -->
            <div class="flex justify-center mt-6">
                <a href="{{ url()->previous() }}"
                    class="bg-gray-700 text-white px-6 py-2 rounded-lg font-semibold hover:bg-gray-900">
                    Kembali
                </a>
            </div>

        </div>
    </div>
@endsection
