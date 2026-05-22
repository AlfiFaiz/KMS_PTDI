<?php
// app/Http/Controllers/KnowledgeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Knowledge;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class KnowledgeController extends Controller
{
    public function index()
    {
        $data = Knowledge::latest()->get();
        return view('knowledge.index', compact('data'));
    }

    public function create()
    {
        return view('knowledge.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('knowledge', 'public');
        }

        Knowledge::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'file' => $filePath,
            'created_by' => auth()->id(),
            'status' => 'pending'
        ]);

        return redirect()->route('knowledge.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        $data = Knowledge::findOrFail($id);
        return view('knowledge.show', compact('data'));
    }

    public function edit($id)
    {
        $data = Knowledge::findOrFail($id);
        return view('knowledge.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Knowledge::findOrFail($id);

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('knowledge', 'public');
            $data->file = $filePath;
        }

        $data->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category
        ]);

        return redirect()->route('knowledge.index')->with('success', 'Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $data = Knowledge::findOrFail($id);
        $data->delete();

        return redirect()->route('knowledge.index')->with('success', 'Data berhasil dihapus');
    }

    public function approve($id)
    {
        $data = Knowledge::findOrFail($id);
        $data->status = 'approved';
        $data->save();

        return back()->with('success', 'Data berhasil diapprove');
    }



    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required'
        ]);

        Comment::create([
            'knowledge_id' => $id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return back();
    }
    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);

        // 🔒 hanya pemilik komentar yang boleh hapus
        if ($comment->user_id !== Auth::id()) {
            abort(403, 'Kamu tidak diizinkan menghapus komentar ini');
        }

        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus');
    }
}