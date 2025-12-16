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
            'company_id' => 'required|exists:companies,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/aircraft_images', $imageName);
        }

        AircraftProgram::create([
            'program' => $request->program,
            'aircraft_type' => $request->aircraft_type,
            'registration' => $request->registration,
            'company_id' => $request->company_id,
            'image' => $imageName,
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
            'company_id' => 'required|exists:companies,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
        ]);

        if ($request->hasFile('image')) {
            Storage::delete('public/aircraft_images/' . $program->image);
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/aircraft_images', $imageName);
            $program->image = $imageName;
        }

        $program->update([
            'program' => $request->program,
            'aircraft_type' => $request->aircraft_type,
            'registration' => $request->registration,
            'company_id' => $request->company_id,
        ]);

        return redirect()->route('aircraft-programs.index')->with('success', 'Aircraft Program berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $program = AircraftProgram::findOrFail($id);
        Storage::delete('public/aircraft_images/' . $program->image);
        $program->delete();

        return redirect()->route('aircraft-programs.index')->with('success', 'Aircraft Program berhasil dihapus!');
    }



    public function downloadReport($id)
    {
        $aircraft = AircraftProgram::with(['company', 'engineeringOrders.task'])->findOrFail($id);
        $orders = $aircraft->engineeringOrders;

        $pdf = Pdf::loadView('pdf.aircraft-report', compact('aircraft', 'orders'));
        return $pdf->download('report-' . $aircraft->registration . '.pdf');
    }

}