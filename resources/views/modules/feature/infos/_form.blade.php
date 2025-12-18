@csrf

<div class="mb-4">
    <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
    <input type="text" name="title" id="title"
           value="{{ old('title', $info->title ?? '') }}"
           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
</div>

<div class="mb-4">
    <label for="content" class="block text-sm font-medium text-gray-700">Konten</label>
    <input id="content" type="hidden" name="content" value="{{ old('content', $info->content ?? '') }}" class="text-black focus:text-black focus:bg-white">
    <trix-editor input="content"></trix-editor>
</div>


<div class="mb-4">
    <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
    <input type="file" name="image" id="image"
           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
    @if(!empty($info->image_path))
        <div class="mt-2">
            <img src="{{ asset('storage/' . $info->image_path) }}" alt="Info Image" class="w-32 h-32 object-cover rounded">
        </div>
    @endif
</div>

<button type="submit"
        class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
    Simpan
</button>

