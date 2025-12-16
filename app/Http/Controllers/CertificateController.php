<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function index()
    {
        $certificates = Certificate::orderBy('date_issued', 'desc')->paginate(10);
        return view('modules.feature.certificates.index', compact('certificates'));
    }

    public function create()
    {
        return view('modules.feature.certificates.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'date_issued' => 'required|date',
            'issued_by' => 'required|string|max:255',
            'file_path' => 'required|file|mimes:pdf,jpg,jpeg,png',
        ]);

        $fileName = time() . '_' . $request->file('file_path')->getClientOriginalName();
        $request->file('file_path')->storeAs('public/certificates', $fileName);

        Certificate::create([
            'nomor' => $request->nomor,
            'judul' => $request->judul,
            'date_issued' => $request->date_issued,
            'issued_by' => $request->issued_by,
            'file_path' => $fileName,
        ]);

        return redirect()->route('certificates.index')->with('success', 'Sertifikat berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $certificate = Certificate::findOrFail($id);
        return view('modules.feature.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, $id)
    {
        $certificate = Certificate::findOrFail($id);

        $request->validate([
            'nomor' => 'required|string|max:255',
            'judul' => 'required|string|max:255',
            'date_issued' => 'required|date',
            'issued_by' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png',
        ]);

        if ($request->hasFile('file_path')) {
            Storage::delete('public/certificates/' . $certificate->file_path);

            $fileName = time() . '_' . $request->file('file_path')->getClientOriginalName();
            $request->file('file_path')->storeAs('public/certificates', $fileName);

            $certificate->file_path = $fileName;
        }

        $certificate->update([
            'nomor' => $request->nomor,
            'judul' => $request->judul,
            'date_issued' => $request->date_issued,
            'issued_by' => $request->issued_by,
        ]);

        return redirect()->route('certificates.index')->with('success', 'Sertifikat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $certificate = Certificate::findOrFail($id);

        Storage::delete('public/certificates/' . $certificate->file_path);
        $certificate->delete();

        return redirect()->route('certificates.index')->with('success', 'Sertifikat berhasil dihapus!');
    }
}