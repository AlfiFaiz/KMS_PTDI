<?php

namespace App\Http\Controllers;

use App\Models\AircraftProgram;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class AircraftProgramController extends Controller
{
    public function index()
    {
        $programs = AircraftProgram::with('company')->paginate(10);
        return view('modules.feature.aircraft_programs.index', compact('programs'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('modules.feature.aircraft_programs.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'program' => 'required|string|max:255',
            'aircraft_type' => 'required|string|max:255',
            'registration' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'wbs_no' => 'nullable|string|max:255',
            'contract_no' => 'nullable|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'document_file' => 'nullable|file|mimes:pdf,docx,doc|max:5120', // Validasi file dokumen
        ]);

        // Handle Image Upload
        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_img_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/aircraft_images', $imageName);
        }

        // Handle Document Upload
        $documentName = null;
        if ($request->hasFile('document_file')) {
            $documentName = time() . '_doc_' . $request->file('document_file')->getClientOriginalName();
            $request->file('document_file')->storeAs('public/aircraft_documents', $documentName);
        }

        AircraftProgram::create([
            'program' => $request->program,
            'aircraft_type' => $request->aircraft_type,
            'registration' => $request->registration,
            'serial_number' => $request->serial_number,
            'wbs_no' => $request->wbs_no,
            'contract_no' => $request->contract_no,
            'company_id' => $request->company_id,
            'image' => $imageName,
            'document_file' => $documentName, // Simpan nama file dokumen
        ]);

        return redirect()->route('aircraft-programs.index')->with('success', 'Aircraft Program berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $program = AircraftProgram::findOrFail($id);
        $companies = Company::all();
        return view('modules.feature.aircraft_programs.edit', compact('program', 'companies'));
    }

    public function update(Request $request, $id)
    {
        $program = AircraftProgram::findOrFail($id);

        $request->validate([
            'program' => 'required|string|max:255',
            'aircraft_type' => 'required|string|max:255',
            'registration' => 'required|string|max:255',
            'serial_number' => 'nullable|string|max:255',
            'wbs_no' => 'nullable|string|max:255',
            'contract_no' => 'nullable|string|max:255',
            'company_id' => 'required|exists:companies,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'document_file' => 'nullable|file|mimes:pdf,docx,doc|max:5120',
        ]);

        // Update Image
        if ($request->hasFile('image')) {
            if ($program->image && Storage::exists('public/aircraft_images/' . $program->image)) {
                Storage::delete('public/aircraft_images/' . $program->image);
            }
            $imageName = time() . '_img_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/aircraft_images', $imageName);
            $program->image = $imageName;
        }

        // Update Document
        if ($request->hasFile('document_file')) {
            if ($program->document_file && Storage::exists('public/aircraft_documents/' . $program->document_file)) {
                Storage::delete('public/aircraft_documents/' . $program->document_file);
            }
            $documentName = time() . '_doc_' . $request->file('document_file')->getClientOriginalName();
            $request->file('document_file')->storeAs('public/aircraft_documents', $documentName);
            $program->document_file = $documentName;
        }

        $program->update([
            'program' => $request->program,
            'aircraft_type' => $request->aircraft_type,
            'registration' => $request->registration,
            'serial_number' => $request->serial_number,
            'wbs_no' => $request->wbs_no,
            'contract_no' => $request->contract_no,
            'company_id' => $request->company_id,
            'image' => $program->image,
            'document_file' => $program->document_file,
        ]);

        return redirect()->route('aircraft-programs.index')->with('success', 'Aircraft Program berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $program = AircraftProgram::findOrFail($id);
        
        // Hapus Gambar
        if ($program->image) {
            Storage::delete('public/aircraft_images/' . $program->image);
        }

        // Hapus Dokumen
        if ($program->document_file) {
            Storage::delete('public/aircraft_documents/' . $program->document_file);
        }

        $program->delete();
        return redirect()->route('aircraft-programs.index')->with('success', 'Aircraft Program berhasil dihapus!');
    }

    public function downloadReport($id)
{
    $aircraft = AircraftProgram::with(['company', 'engineeringOrders.task'])->findOrFail($id);
    $orders = $aircraft->engineeringOrders;

    $pdf = Pdf::loadView('pdf.aircraft-report', compact('aircraft', 'orders'))
              ->setPaper('a4', 'portrait');

    // Opsi ini penting untuk merender "Page x of x"
    $pdf->getDomPDF()->set_option("isPhpEnabled", true);

    return $pdf->download('report-' . $aircraft->registration . '.pdf');
}
}