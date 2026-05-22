@csrf

<div class="space-y-5">

    <div>
        <label for="title" class="block mb-1.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Judul
            Informasi</label>
        <input type="text" name="title" id="title" value="{{ old('title', $info->title ?? '') }}"
            class="w-full px-3.5 py-2.5 text-sm rounded-lg border border-gray-300 bg-gray-50/50 text-gray-800 placeholder:text-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white transition-all"
            placeholder="Masukkan judul berita atau informasi..." required>
    </div>

    <div>
        <label for="content" class="block mb-1.5 text-xs font-bold text-gray-500 uppercase tracking-wider">Konten / Isi
            Berita</label>
        <div class="prose max-w-none">
            <input id="content" type="hidden" name="content" value="{{ old('content', $info->content ?? '') }}">
            <trix-editor input="content"
                class="border border-gray-300 rounded-lg p-3 min-h-[220px] focus:outline-none focus:ring-2 focus:ring-blue-500/10 focus:border-blue-500 bg-gray-50/50 focus:bg-white text-sm text-gray-800 transition-all">
            </trix-editor>
        </div>
    </div>

    <div class="bg-gray-50/40 p-4 rounded-xl border border-dashed border-gray-300">
        <label for="image" class="block mb-2 text-xs font-bold text-gray-500 uppercase tracking-wider">Gambar
            Sampul</label>
        <input type="file" name="image" id="image"
            class="block w-full text-xs text-gray-500 file:mr-4 file:py-1.5 file:px-3.5 file:rounded-lg file:border file:border-blue-200 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100/80 file:transition-colors cursor-pointer">

        @if (!empty($info->image_path))
            <div
                class="mt-3.5 p-2.5 bg-white rounded-lg border border-gray-200 shadow-sm w-fit flex items-center gap-3">
                <img src="{{ asset('storage/' . $info->image_path) }}" alt="Info Image"
                    class="w-14 h-14 object-cover rounded-md border border-gray-100 shrink-0">
                <div class="pr-3">
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider leading-none">Preview saat
                        ini:</p>
                    <p class="text-xs font-medium text-gray-600 mt-1 truncate max-w-[180px]">
                        {{ basename($info->image_path) }}</p>
                </div>
            </div>
        @endif
    </div>

</div>

<style>
    trix-toolbar .trix-button-group {
        border-color: #d1d5db !important;
        background-color: #ffffff !important;
        border-radius: 0.375rem !important;
    }

    trix-toolbar {
        margin-bottom: 0.5rem !important;
    }

    trix-editor {
        box-shadow: none !important;
    }
</style>
