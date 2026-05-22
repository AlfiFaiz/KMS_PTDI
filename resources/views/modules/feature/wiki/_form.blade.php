@php
    $wiki = $wiki ?? null;
@endphp

@csrf

<div class="grid grid-cols-1 xl:grid-cols-4 gap-8">

    <div class="xl:col-span-3 space-y-6">

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-8 py-5 border-b bg-gray-50">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Article Content</h2>
                        <p class="text-sm text-gray-500 mt-1">
                            Tulis knowledge article dengan format yang jelas dan mudah dipahami.
                        </p>
                    </div>
                    <div class="hidden lg:flex items-center gap-2">
                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-semibold">
                            Wiki Editor
                        </span>
                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs font-semibold">
                            Enterprise KMS
                        </span>
                    </div>
                </div>
            </div>

            <div class="p-8 space-y-8">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Judul Artikel
                    </label>
                    <input type="text" name="title" required value="{{ old('title', $wiki?->title) }}"
                        placeholder="Contoh: Aircraft Engine Inspection Procedure"
                        class="w-full rounded-2xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 px-5 py-4 text-2xl font-bold shadow-sm">
                    <p class="text-xs text-gray-400 mt-2">
                        Gunakan judul yang spesifik dan mudah dicari.
                    </p>
                </div>

                <div>
                    <div class="flex items-center justify-between mb-3">
                        <label class="text-sm font-semibold text-gray-700">
                            Konten Artikel
                        </label>
                        <span class="text-xs text-gray-400">
                            Gunakan heading, list, dan tabel agar mudah dibaca.
                        </span>
                    </div>
                    <div class="border border-gray-200 rounded-2xl overflow-hidden shadow-sm bg-white">
                        <trix-editor input="content" class="trix-content min-h-[700px] p-8 bg-white"></trix-editor>
                    </div>
                    <input id="content" type="hidden" name="content" value="{{ old('content', $wiki?->content) }}">
                </div>
            </div>
        </div>

    </div>

    <div class="space-y-6">

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b bg-gray-50">
                <h3 class="font-bold text-gray-800">Publish Settings</h3>
            </div>

            <div class="p-5 space-y-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Category</label>
                    <input type="text" name="category" value="{{ old('category', $wiki?->category) }}"
                        placeholder="Safety, Maintenance"
                        class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-3 shadow-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tags</label>
                    <input type="text" name="tags" value="{{ old('tags', $wiki?->tags) }}"
                        placeholder="engine, aircraft, inspection"
                        class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-3 shadow-sm">
                    <p class="text-xs text-gray-400 mt-2">Pisahkan tag dengan koma.</p>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Workflow Status</label>
                    @if (auth()->user()->role === 'inspektor')
                        <div class="rounded-xl bg-yellow-50 border border-yellow-200 p-4 text-sm text-yellow-700">
                            Status otomatis: <strong>Review</strong>
                        </div>
                        <input type="hidden" name="status" value="review">
                    @else
                        <select name="status"
                            class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 px-4 py-3 shadow-sm">
                            <option value="draft" {{ old('status', $wiki?->status) == 'draft' ? 'selected' : '' }}>
                                Draft</option>
                            <option value="review" {{ old('status', $wiki?->status) == 'review' ? 'selected' : '' }}>
                                Review</option>
                            <option value="published"
                                {{ old('status', $wiki?->status) == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived"
                                {{ old('status', $wiki?->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                        </select>
                    @endif
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 rounded-2xl p-5">
            <h3 class="font-bold text-blue-800 mb-3">Writing Guide</h3>
            <ul class="space-y-3 text-sm text-blue-700">
                <li>• Gunakan heading untuk membagi section.</li>
                <li>• Tambahkan langkah secara berurutan.</li>
                <li>• Gunakan istilah teknis yang konsisten.</li>
                <li>• Tambahkan tag agar mudah ditemukan.</li>
                <li>• Hindari paragraf terlalu panjang.</li>
            </ul>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex flex-col gap-3">
                <button type="submit"
                    class="w-full px-5 py-3 rounded-2xl bg-blue-600 hover:bg-blue-700 text-white font-semibold transition shadow-lg shadow-blue-600/20">
                    {{ isset($wiki) ? 'Update Wiki' : 'Publish Wiki' }}
                </button>
                <a href="{{ url()->previous() }}"
                    class="w-full px-5 py-3 rounded-2xl border border-gray-200 text-center text-gray-600 hover:bg-gray-50 transition">
                    Cancel
                </a>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener("trix-attachment-add", function(event) {
        if (event.attachment.file) {
            uploadFileAttachment(event.attachment);
        }
    });

    function uploadFileAttachment(attachment) {
        let formData = new FormData();
        formData.append("file", attachment.file);

        fetch("{{ route('wiki.upload') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: formData
            })
            .then(response => response.json())
            .then(result => {
                attachment.setAttributes({
                    url: result.url,
                    href: result.url
                });
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>
