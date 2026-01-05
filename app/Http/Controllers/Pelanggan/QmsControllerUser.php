<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QMS;

class QmsControllerUser extends Controller
{
    public function manual(Request $request) {
        $qms = QMS::where('type', 'MANUAL')->paginate($request->get('limit', 10));
        return view('pelanggan.qms.qms', compact('qms'));
    }

    public function PP(Request $request) { // Route untuk Quality Document
        $qms = QMS::where('type', 'QUALITY DOCUMENT')->paginate($request->get('limit', 10));
        return view('pelanggan.qms.qms', compact('qms'));
    }

    public function procedure(Request $request) {
        $qms = QMS::where('type', 'PROCEDURE')->paginate($request->get('limit', 10));
        return view('pelanggan.qms.qms', compact('qms'));
    }

    public function WI(Request $request) {
        $qms = QMS::where('type', 'WORK INSTRUCTION')->paginate($request->get('limit', 10));
        return view('pelanggan.qms.qms', compact('qms'));
    }

    public function form(Request $request) {
        $qms = QMS::where('type', 'FORM')->paginate($request->get('limit', 10));
        return view('pelanggan.qms.qms', compact('qms'));
    }
}