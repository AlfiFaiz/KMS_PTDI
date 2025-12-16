<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QMS;

class QmsControllerUser extends Controller
{
    public function form(Request $request)
    {
        $limit = $request->get('limit', 10); // Default 10
        $qms = QMS::where('type', 'FORM')->paginate($limit);


        return view('pelanggan.qms.qms', compact('qms'));
    }
    public function manual(Request $request)
    {
        $limit = $request->get('limit', 10); // Default 10
        $qms = QMS::where('type', 'MANUAL')->paginate($limit);

        return view('pelanggan.qms.qms', compact('qms'));
    }
    public function procedure(Request $request)
    {
        $limit = $request->get('limit', 10); // Default 10
        $qms = QMS::where('type', 'PROCEDURE')->paginate($limit);

        return view('pelanggan.qms.qms', compact('qms'));
    }
    public function WI(Request $request)
    {
        $limit = $request->get('limit', 10); // Default 10
        $qms = QMS::where('type', 'WORK INTSTRUCTION')->paginate($limit);

        return view('pelanggan.qms.qms', compact('qms'));
    }
    public function PP(Request $request)
    {
        $limit = $request->get('limit', 10); // Default 10
        $qms = QMS::where('type', 'PERSONAL POSTER')->paginate($limit);

        return view('pelanggan.qms.qms', compact('qms'));
    }
    public function training(Request $request)
    {
        $limit = $request->get('limit', 10); // Default 10
        $qms = QMS::where('type', 'TRAINING')->paginate($limit);

        return view('pelanggan.qms.qms', compact('qms'));
    }

}
