@csrf

<div class="mb-4">
    <label class="block font-semibold">Judul</label>
    <input type="text" name="title" class="border p-2 w-full"
           value="{{ old('title', $wiki->title ?? '') }}" required>
</div>

<div class="mb-4">
    <label class="block font-semibold">Kategori</label>
    <input type="text" name="category" class="border p-2 w-full"
           value="{{ old('category', $wiki->category ?? '') }}">
</div>

<div class="mb-4">
    <label class="block font-semibold">Tags</label>
    <input type="text" name="tags" class="border p-2 w-full"
           value="{{ old('tags', $wiki->tags ?? '') }}">
</div>

<div class="mb-4">
    <label class="block font-semibold">Konten</label>
    <trix-editor input="content" class="trix-content"></trix-editor>
    <input id="content" type="hidden" name="content" value="{{ old('content', $wiki->content ?? '') }}">

</div>


<div class="mb-4">
    <label class="block font-semibold">Status</label>

    {{-- Jika role = inspektor, status otomatis review --}}
    @if(auth()->user()->role === 'inspektor')
        <input type="hidden" name="status" value="review">
        <p class="text-gray-600">Status: Review (otomatis)</p>
    @else
        <select name="status" class="border p-2 w-full">
            <option value="draft" {{ old('status', $wiki->status ?? '') == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="review" {{ old('status', $wiki->status ?? '') == 'review' ? 'selected' : '' }}>Review</option>
            <option value="published" {{ old('status', $wiki->status ?? '') == 'published' ? 'selected' : '' }}>Published</option>
            <option value="archived" {{ old('status', $wiki->status ?? '') == 'archived' ? 'selected' : '' }}>Archived</option>
        </select>
    @endif
</div>

<script>
document.addEventListener("trix-attachment-add", function(event) {
    const attachment = event.attachment;
    if (attachment.file) {
        uploadFile(attachment);
    }
});

function uploadFile(attachment) {
    const formData = new FormData();
    formData.append("file", attachment.file);

    fetch("/upload", {
        method: "POST",
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(result => {
        // set URL gambar ke editor
        attachment.setAttributes({ url: result.url });
    })
    .catch(error => {
        console.error(error);
    });
}
</script>