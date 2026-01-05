<?php

namespace App\Http\Controllers;

use App\Models\QMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QmsController extends Controller
{
    public function index()
{
    $qms = QMS::orderByRaw("FIELD(type, 'MANUAL', 'QUALITY DOCUMENT', 'PROCEDURE', 'WORK INSTRUCTION', 'FORM')")
        ->orderBy('nomor') // Urutan kedua jika type-nya sama
        ->paginate(10);

    return view('modules.feature.qms.index', compact('qms'));
}

    public function create()
    {
        return view('modules.feature.qms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'date_issued' => 'required|date',
            'rev' => 'required|integer',
            'amend' => 'nullable|integer',
            'type' => 'required|string',
            'file_path' => 'required|file|mimes:pdf,doc,docx,xlsx,xls,ppt,pptx',
        ]);
   


        // Upload file
        $fileName = time() . '_' . $request->file('file_path')->getClientOriginalName();
        $request->file('file_path')->storeAs('public/qms_files', $fileName);

        QMS::create([
            'nomor' => $request->nomor,
            'judul' => $request->judul,
            'date_issued' => $request->date_issued,
            'rev' => $request->rev,
            'amend' => $request->amend,
            'type' => $request->type,
            'file_path' => $fileName,
        ]);

        return redirect()->route('qms.index')->with('success', 'Dokumen QMS berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $qms = QMS::findOrFail($id);
        return view('modules.feature.qms.edit', compact('qms'));
    }

    public function update(Request $request, $id)
    {
        $qms = QMS::findOrFail($id);

        $request->validate([
            'nomor' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'date_issued' => 'required|date',
            'rev' => 'required|integer',
            'amend' => 'nullable|integer',
            'type' => 'required|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,xlsx,xls,ppt,pptx',
        ]);

        // Jika upload file baru
        if ($request->hasFile('file_path')) {
            // Hapus file lama
            Storage::delete('public/qms_files/' . $qms->file_path);

            $fileName = time() . '_' . $request->file('file_path')->getClientOriginalName();
            $request->file('file_path')->storeAs('public/qms_files', $fileName);

            $qms->file_path = $fileName;
        }

        $qms->update([
            'nomor' => $request->nomor,
            'judul' => $request->judul,
            'date_issued' => $request->date_issued,
            'rev' => $request->rev,
            'amend' => $request->amend,
            'type' => $request->type,
        ]);

        return redirect()->route('qms.index')->with('success', 'Dokumen QMS berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $qms = QMS::findOrFail($id);

        Storage::delete('public/qms_files/' . $qms->file_path);
        $qms->delete();

        return redirect()->route('qms.index')->with('success', 'Dokumen QMS berhasil dihapus!');
    }
}