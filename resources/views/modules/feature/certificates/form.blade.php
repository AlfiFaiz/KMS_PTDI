<div class="space-y-5">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        <div>
            <label class="block mb-1.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Nomor Sertifikat</label>
            <input type="text" name="nomor"
                class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
                placeholder="Contoh: CERT/2026/001" value="{{ $certificate->nomor ?? old('nomor') }}" required>
        </div>

        <div>
            <label class="block mb-1.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Judul Sertifikat</label>
            <input type="text" name="judul"
                class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
                placeholder="Contoh: Sertifikat Kelaikan Udara" value="{{ $certificate->judul ?? old('judul') }}"
                required>
        </div>

        <div>
            <label class="block mb-1.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Date Issued</label>
            <input type="date" name="date_issued"
                class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
                value="{{ $certificate->date_issued ?? old('date_issued') }}" required>
        </div>

        <div>
            <label class="block mb-1.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Valid Until</label>
            <input type="date" name="valid_until"
                class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
                value="{{ old('valid_until', $certificate->valid_until ?? '') }}">
            <p class="mt-1 text-[11px] text-gray-400 italic">*Kosongkan jika berlaku selamanya</p>
        </div>

        <div class="col-span-1 md:col-span-2">
            <label class="block mb-1.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Issued By</label>
            <input type="text" name="issued_by"
                class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
                placeholder="Contoh: Direktorat Kelaikudaraan dan Pengoperasian Pesawat Udara"
                value="{{ $certificate->issued_by ?? old('issued_by') }}" required>
        </div>

        <div class="col-span-1 md:col-span-2 bg-gray-50/40 p-4 rounded-xl border border-dashed border-gray-300">
            <label class="block mb-2 text-xs font-bold text-gray-500 uppercase tracking-wider">Upload File Sertifikat
                (PDF/JPG)</label>
            <input type="file" name="file_path"
                class="block w-full text-xs text-gray-500 file:mr-4 file:py-1.5 file:px-3.5 file:rounded-lg file:border file:border-blue-200 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100/80 file:transition-colors cursor-pointer">

            @isset($certificate)
                <div class="mt-3 p-3 bg-white rounded-lg border border-gray-200 shadow-sm">
                    <div class="flex items-start gap-2.5">
                        <div class="w-7 h-7 rounded-md bg-red-50 flex items-center justify-center shrink-0 text-red-500">
                            <i class="fa-solid fa-file-pdf text-sm"></i>
                        </div>
                        <div class="overflow-hidden w-full">
                            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">File Saat Ini</p>
                            <a href="{{ asset('storage/certificates/' . $certificate->file_path) }}" target="_blank"
                                class="block text-xs font-semibold text-blue-600 hover:text-blue-800 underline break-all mt-0.5">
                                {{ $certificate->file_path }}
                            </a>
                        </div>
                    </div>
                </div>
            @endisset
        </div>

    </div>
</div>
