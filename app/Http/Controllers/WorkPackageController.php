<?php

namespace App\Http\Controllers;

use App\Models\AircraftProgram;
use App\Models\WorkPackageSummary;
use App\Models\WorkPackageItem;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; // pastikan barryvdh/laravel-dompdf sudah terinstall

class WorkPackageController extends Controller
{
    // Form create summary
    public function create($programId)
    {
        $program = AircraftProgram::with('company')->findOrFail($programId);

        // Summary yang sudah ada (jika pernah disimpan)
        $summary = WorkPackageSummary::with('items')
            ->where('aircraft_program_id', $programId)
            ->first();

        // Template default (seperti yang kamu pakai sebelumnya)
        $defaultItems = [
            // Aircraft Data
            ['section' => 'Aircraft Data', 'item' => 'Preliminary Inspection'],
            ['section' => 'Aircraft Data', 'item' => 'Performa Aircraft Acceptance (PAA)'],
            ['section' => 'Aircraft Data', 'item' => 'Performa Aircraft Delivery (PAD)'],
            ['section' => 'Aircraft Data', 'item' => 'Aircraft Operating Time Record / Logbook'],

            // Engine/APU/Propeller Data
            ['section' => 'Engine/APU/Propeller Data', 'item' => 'Engine Data'],
            ['section' => 'Engine/APU/Propeller Data', 'item' => 'Propeller Data'],
            ['section' => 'Engine/APU/Propeller Data', 'item' => 'APU Data'],

            // List of Work Sheet
            ['section' => 'List of Work Sheet', 'item' => 'Maintenance Worksheet'],
            ['section' => 'List of Work Sheet', 'item' => 'Engineering Order'],

            // AD/EASB/ASB/SB Compliance Record
            ['section' => 'AD/EASB/ASB/SB Compliance Record', 'item' => 'AD Compliance Record'],
            ['section' => 'AD/EASB/ASB/SB Compliance Record', 'item' => 'EASB/ASB/SB Compliance Record'],

            // Maintenance Discrepancy Record (MDR)
            ['section' => 'Maintenance Discrepancy Record (MDR)', 'item' => 'List of MDR'],

            // Component Status Record
            ['section' => 'Component Status Record', 'item' => 'Replacement Component'],
            ['section' => 'Component Status Record', 'item' => 'Aircraft & Engine Component Status'],
            ['section' => 'Component Status Record', 'item' => 'Aircraft Inventory'],

            // Technical Data Report
            ['section' => 'Technical Data Report', 'item' => 'Weight & Balance'],
            ['section' => 'Technical Data Report', 'item' => 'Compass Swing'],

            // Ground and Flight Test Report
            ['section' => 'Ground and Flight Test Report', 'item' => 'Functional Test'],
            ['section' => 'Ground and Flight Test Report', 'item' => 'Propeller Dynamic Balance (Fixed Wing)'],
            ['section' => 'Ground and Flight Test Report', 'item' => 'Tracking and Balancing (Rotary Wing)'],
            ['section' => 'Ground and Flight Test Report', 'item' => 'Ground Run Report'],
            ['section' => 'Ground and Flight Test Report', 'item' => 'Flight Test Report'],
            ['section' => 'Ground and Flight Test Report', 'item' => 'Other'],

            // Related Certificates
            ['section' => 'Related Certificates', 'item' => 'Certificate of Maintenance / Return to Services (RTS)'],
            ['section' => 'Related Certificates', 'item' => 'Flight Acceptance Certificate (FAC)'],
            ['section' => 'Related Certificates', 'item' => 'Certificate of Airworthiness (C of A)'],
            ['section' => 'Related Certificates', 'item' => 'Airworthiness Release Certificate (ARC) or Certificate of Compliance (C of C)'],
            ['section' => 'Related Certificates', 'item' => 'Other document'],
        ];

        // Jika summary ada, gunakan item dari DB; jika tidak, pakai default
        if ($summary && $summary->items->count()) {
            // Ubah ke array yang seragam dengan defaultItems
            $items = $summary->items->map(function ($it) {
                return [
                    'section' => $it->section,
                    'item' => $it->item,
                    'status' => $it->status,
                    'remarks' => $it->remarks,
                ];
            })->toArray();
        } else {
            $items = $defaultItems;
        }

        $summary = WorkPackageSummary::firstOrCreate(
            ['aircraft_program_id' => $programId],
            ['contract_number' => null]
        );


        return view('modules.feature.aircraft_programs.work-package.create', compact('program', 'summary', 'items'));
    }

    // Simpan summary
    public function store(Request $request, $programId)
    {
        $summary = WorkPackageSummary::create([
            'aircraft_program_id' => $programId,
            'contract_number' => $request->contract_number,
        ]);

        foreach ($request->items as $item) {
            WorkPackageItem::create([
                'work_package_summary_id' => $summary->id,
                'section' => $item['section'],
                'item' => $item['item'],
                'status' => $item['status'] ?? null,
                'remarks' => $item['remarks'] ?? null,
            ]);
        }

        return redirect()->route('work-package.show', $summary->id)
            ->with('success', 'Summary berhasil disimpan');
    }

    // Tampilkan summary
    public function show($id)
    {
        $summary = WorkPackageSummary::with('items', 'program')->findOrFail($id);
        return view('modules.feature.aircraft_programs.work-package.show', compact('summary'));
    }



    public function downloadPdf($id)
    {
        $summary = WorkPackageSummary::with('items', 'program.company')->findOrFail($id);

        $pdf = Pdf::loadView('pdf.work-package', compact('summary'))
            ->setPaper('A4', 'portrait');

        // Tambahkan nomor halaman di kanan bawah
        $pdf->render();
        $canvas = $pdf->getDomPDF()->getCanvas();
        $canvas->page_script(function ($pageNumber, $pageCount, $canvas) {
            $text = "Page $pageNumber of $pageCount";
            $size = 10;
            $width = $canvas->get_width();
            $height = $canvas->get_height();
            $canvas->text($width - 100, $height - 30, $text, null, $size);
        });

        return $pdf->download('summary-of-work-package.pdf');
    }
    public function ajaxUpdate(Request $request, $programId)
    {
        $summary = WorkPackageSummary::firstOrCreate(
            ['aircraft_program_id' => $programId],
        );

        foreach ($request->items as $item) {
            WorkPackageItem::updateOrCreate(
                [
                    'work_package_summary_id' => $summary->id,
                    'section' => $item['section'],
                    'item' => $item['item'],
                ],
                [
                    'status' => $item['status'] ?? null,
                    'remarks' => $item['remarks'] ?? null,
                ]
            );
        }

        return response()->json(['success' => true]);
    }
    public function summaryPelanggan($programId)
    {

        $program = \App\Models\AircraftProgram::with('company')->findOrFail($programId);

        $summary = \App\Models\WorkPackageSummary::with('items')
            ->where('aircraft_program_id', $programId)
            ->first();



        // Hitung progress dari items
        $totalItems = $summary ? $summary->items->count() : 0;
        $completedItems = $summary ? $summary->items->where('status', 'OK')->count() : 0;
        $progressPercentage = $totalItems > 0 ? round(($completedItems / $totalItems) * 100, 2) : 0;

        return view('pelanggan.project.work-package-summary', compact('program', 'summary', 'progressPercentage'));
    }

}