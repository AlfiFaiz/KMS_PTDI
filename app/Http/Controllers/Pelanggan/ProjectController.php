<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AircraftProgram;
use App\Models\EngineeringOrder;

class ProjectController extends Controller
{
    // Index: daftar semua program + progress
    public function index()
    {
        $companyId = auth()->user()->pelanggan->company_id;
        $aircraftPrograms = AircraftProgram::where('company_id', $companyId)->get();


        return view('pelanggan.project.index', compact('aircraftPrograms'));
    }


    // Detail: tampilkan satu program + semua engineering order
    public function detail($id)
    {
        $aircraft = AircraftProgram::findOrFail($id);
        $orders = EngineeringOrder::where('aircraft_id', $id)->get();
        return view('pelanggan.project.detail', compact('aircraft', 'orders'));

    }
}