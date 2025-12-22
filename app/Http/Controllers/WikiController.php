<?php

namespace App\Http\Controllers;

use App\Models\Wiki;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WikiController extends Controller
{
    // Tampilkan daftar wiki
    public function index()
    {
        // pelanggan hanya bisa lihat published
        if (auth()->user()->role === 'pelanggan') {
    $wikis = Wiki::where('status','published')->latest()->paginate(10);
} else {
    $wikis = Wiki::latest()->paginate(10);
}


        return view('modules.feature.wiki.index', compact('wikis'));
    }

    // Form tambah wiki
    public function create()
    {
        return view('modules.feature.wiki.create');
    }

    // Simpan wiki baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required',
            'category'=> 'nullable|string',
            'tags'    => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['title']);
        $data['created_by'] = auth()->id();
        $data['status'] = 'draft';

        Wiki::create($data);

        return redirect()->route('wiki.index')->with('success','Wiki berhasil dibuat');
    }

    // Detail wiki
   public function show(Wiki $wiki)
{
    // pelanggan hanya boleh lihat published
    if (auth()->user()->role === 'pelanggan' && $wiki->status !== 'published') {
        abort(403, 'Anda tidak punya akses');
    }

    return view('modules.feature.wiki.show', compact('wiki'));
}


    // Form edit wiki
    public function edit(Wiki $wiki)
    {
        return view('modules.feature.wiki.edit', compact('wiki'));
    }

    // Update wiki
   public function update(Request $request, Wiki $wiki)
{
    // Validasi input
    $data = $request->validate([
        'title'   => 'required|string|max:255|unique:wikis,title,' . $wiki->id,
        'content' => 'required',
        'category'=> 'nullable|string',
        'tags'    => 'nullable|string',
        'status'  => 'required|in:draft,review,published,archived',
    ]);

    // Role based workflow
    if (auth()->user()->role === 'inspektor' && $data['status'] !== 'review') {
        return back()->withErrors('Inspektor hanya bisa kirim ke review');
    }
    if (auth()->user()->role === 'pelanggan') {
        abort(403, 'Pelanggan tidak boleh edit');
    }

    // Simpan versi lama sebelum update
    $wiki->versions()->create([
        'title'     => $wiki->title,
        'category'  => $wiki->category,
        'tags'      => $wiki->tags,
        'content'   => $wiki->content,
        'status'    => $wiki->status,
        'edited_by' => auth()->id(),
        'edited_at' => now(),
    ]);

    // Update metadata
    $data['slug'] = Str::slug($data['title']);
    $data['updated_by'] = auth()->id();
    if ($data['status'] === 'review')    $data['reviewed_at']  = now();
    if ($data['status'] === 'published') $data['published_at'] = now();
    if ($data['status'] === 'archived')  $data['archived_at']  = now();

    // Update wiki
    $wiki->update($data);

    // Audit log
    $wiki->logs()->create([
        'action'  => 'update',
        'user_id' => auth()->id(),
        'notes'   => 'Wiki diperbarui',
    ]);

    return redirect()->route('wiki.show', $wiki)->with('success', 'Wiki berhasil diperbarui');
}

    // Hapus wiki
    public function destroy(Wiki $wiki)
    {
        $wiki->delete();

        $wiki->logs()->create([
            'action' => 'delete',
            'user_id' => auth()->id(),
            'notes' => 'Wiki dihapus',
        ]);

        return redirect()->route('wiki.index')->with('success','Wiki berhasil dihapus');
    }

    // Aksi khusus workflow
    public function review(Wiki $wiki)
    {
        $wiki->update([
            'status' => 'review',
            'reviewed_at' => now(),
            'updated_by' => auth()->id(),
        ]);

        $wiki->logs()->create([
            'action' => 'review',
            'user_id' => auth()->id(),
            'notes' => 'Wiki masuk review',
        ]);

        return back()->with('success','Wiki masuk review');
    }

    public function publish(Wiki $wiki)
    {
        $wiki->update([
            'status' => 'published',
            'published_at' => now(),
            'updated_by' => auth()->id(),
        ]);

        $wiki->logs()->create([
            'action' => 'publish',
            'user_id' => auth()->id(),
            'notes' => 'Wiki dipublish',
        ]);

        return back()->with('success','Wiki dipublish');
    }

    public function archive(Wiki $wiki)
    {
        $wiki->update([
            'status' => 'archived',
            'archived_at' => now(),
            'updated_by' => auth()->id(),
        ]);

        $wiki->logs()->create([
            'action' => 'archive',
            'user_id' => auth()->id(),
            'notes' => 'Wiki diarsipkan',
        ]);

        return back()->with('success','Wiki diarsipkan');
    }
}