<div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Nomor Sertifikat</label>
            <input type="text" name="nomor" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" 
                placeholder="Contoh: CERT/2026/001"
                value="{{ $certificate->nomor ?? old('nomor') }}" required>
        </div>

        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Judul Sertifikat</label>
            <input type="text" name="judul" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" 
                placeholder="Contoh: Sertifikat Kelaikan Udara"
                value="{{ $certificate->judul ?? old('judul') }}" required>
        </div>

        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Date Issued</label>
            <input type="date" name="date_issued" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" 
                value="{{ $certificate->date_issued ?? old('date_issued') }}" required>
        </div>

        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Valid Until</label>
            <input type="date" name="valid_until" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" 
                value="{{ old('valid_until', $certificate->valid_until ?? '') }}">
            <p class="mt-1 text-xs text-gray-400 italic">*Kosongkan jika berlaku selamanya</p>
        </div>

        <div class="col-span-1 md:col-span-2">
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Issued By</label>
            <input type="text" name="issued_by" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" 
                placeholder="Contoh: Direktorat Kelaikudaraan dan Pengoperasian Pesawat Udara"
                value="{{ $certificate->issued_by ?? old('issued_by') }}" required>
        </div>

        <div class="col-span-1 md:col-span-2 bg-gray-50 p-4 rounded-lg border-2 border-dashed border-gray-200">
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Upload File Sertifikat (PDF/JPG)</label>
            <input type="file" name="file_path" 
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
            
            @isset($certificate)
                <div class="mt-3 p-3 bg-white rounded border border-gray-200 shadow-sm flex items-start">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                    </svg>
                    <div class="ml-3 overflow-hidden">
                        <p class="text-[10px] font-bold text-gray-400 uppercase leading-none">File saat ini:</p>
                        <a href="{{ asset('storage/certificates/' . $certificate->file_path) }}" 
                           target="_blank" 
                           class="block text-sm font-semibold text-blue-600 hover:text-blue-800 underline break-all mt-1">
                            {{ $certificate->file_path }}
                        </a>
                    </div>
                </div>
            @endisset
        </div>
    </div>
</div>