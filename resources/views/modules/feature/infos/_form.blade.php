<div class="bg-white p-6 rounded-xl shadow-md border border-gray-100">
    @csrf

    <div class="space-y-6">
        <div>
            <label for="title" class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Judul Informasi</label>
            <input type="text" name="title" id="title"
                value="{{ old('title', $info->title ?? '') }}"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all"
                placeholder="Masukkan judul berita atau informasi..." required>
        </div>

        <div>
            <label for="content" class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Konten / Isi Berita</label>
            <div class="prose max-w-none">
                <input id="content" type="hidden" name="content" value="{{ old('content', $info->content ?? '') }}">
                <trix-editor input="content" 
                    class="border border-gray-300 rounded-lg p-2 min-h-[200px] focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                </trix-editor>
            </div>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border-2 border-dashed border-gray-200">
            <label for="image" class="block mb-2 text-sm font-bold text-gray-700 uppercase tracking-wide">Gambar Sampul</label>
            <input type="file" name="image" id="image"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
            
            @if(!empty($info->image_path))
                <div class="mt-4 flex items-center space-x-4 p-2 bg-white rounded-lg border shadow-sm w-fit">
                    <img src="{{ asset('storage/' . $info->image_path) }}" alt="Info Image" class="w-20 h-20 object-cover rounded-md border">
                    <div class="pr-4">
                        <p class="text-[10px] font-bold text-gray-400 uppercase leading-none">Preview saat ini:</p>
                        <p class="text-xs text-gray-500 mt-1 truncate max-w-[150px]">{{ basename($info->image_path) }}</p>
                    </div>
                </div>
            @endif
        </div>

        <div class="flex justify-end pt-4 border-t border-gray-100">
            <button type="submit"
                class="flex items-center px-6 py-2.5 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 transition-all transform active:scale-95">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                </svg>
                Simpan Informasi
            </button>
        </div>
    </div>
</div>

<style>
    trix-toolbar .trix-button-group { border-color: #e5e7eb !important; }
    trix-editor { border-color: #e5e7eb !important; }
    trix-editor:focus { border-color: #3b82f6 !important; ring: 2px #3b82f6; }
</style>