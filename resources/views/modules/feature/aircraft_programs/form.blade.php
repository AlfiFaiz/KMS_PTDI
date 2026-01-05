<div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Program</label>
            <input type="text" name="program" value="{{ old('program', $program->program ?? '') }}" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all" 
                placeholder="Nama Program" required>
        </div>

        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Aircraft Type</label>
            <input type="text" name="aircraft_type" value="{{ old('aircraft_type', $program->aircraft_type ?? '') }}" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all" 
                placeholder="Contoh: CN235, NC212i" required>
        </div>

        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Registration</label>
            <input type="text" name="registration" value="{{ old('registration', $program->registration ?? '') }}" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all" 
                placeholder="Contoh: AX-2101" required>
        </div>

        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Serial Number</label>
            <input type="text" name="serial_number" value="{{ old('serial_number', $program->serial_number ?? '') }}" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all" 
                placeholder="A/C Serial Number">
        </div>

        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">WBS No.</label>
            <input type="text" name="wbs_no" value="{{ old('wbs_no', $program->wbs_no ?? '') }}" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all" 
                placeholder="Work Breakdown System Number">
        </div>

        <div>
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Contract No.</label>
            <input type="text" name="contract_no" value="{{ old('contract_no', $program->contract_no ?? '') }}" 
                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition-all" 
                placeholder="Nomor Kontrak">
        </div>

        <div class="col-span-1 md:col-span-2">
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Customer</label>
            <select name="company_id" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 bg-white outline-none cursor-pointer" required>
                <option value="" disabled selected>-- Pilih Customer --</option>
                @foreach ($companies as $c)
                    <option value="{{ $c->id }}" @selected(old('company_id', $program->company_id ?? '') == $c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="bg-blue-50 p-4 rounded-lg border-2 border-dashed border-blue-200">
            <label class="block mb-2 text-sm font-bold text-blue-800 uppercase tracking-wide">File Dokumen Return to Service (RTS) (PDF)</label>
            <input type="file" name="document_file" 
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer">
            
            @isset($program->document_file)
                <div class="mt-2 flex items-center text-xs">
                    <svg class="w-4 h-4 text-blue-600 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path></svg>
                    <a href="{{ asset('storage/aircraft_documents/' . $program->document_file) }}" target="_blank" class="text-blue-600 underline break-all">
                        {{ $program->document_file }}
                    </a>
                </div>
            @endisset
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border-2 border-dashed border-gray-200">
            <label class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Aircraft Image (JPG/PNG)</label>
            <input type="file" name="image" 
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-700 cursor-pointer">
            
            @isset($program->image)
                <div class="mt-2 flex items-center space-x-3">
                    <img src="{{ asset('storage/aircraft_images/' . $program->image) }}" class="w-16 h-16 object-cover rounded border bg-white">
                    <span class="text-xs text-gray-500 truncate max-w-[150px]">{{ $program->image }}</span>
                </div>
            @endisset
        </div>

    </div>
</div>