<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::orderBy('name')->paginate(10);

        return view('modules.feature.companies.index', compact('companies'));
    }

    public function create()
    {
        return view('modules.feature.companies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
        ]);

        Company::create($request->all());

        return redirect()->route('companies.index')
            ->with('success', 'Perusahaan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('modules.feature.companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
        ]);

        $company = Company::findOrFail($id);
        $company->update($request->all());

        return redirect()->route('companies.index')
            ->with('success', 'Perusahaan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Company::findOrFail($id)->delete();
        return redirect()->route('companies.index')
            ->with('success', 'Perusahaan berhasil dihapus!');
    }
}