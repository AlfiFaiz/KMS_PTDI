<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WikiAttachmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240'
        ]);

        $path = $request->file('file')->store('wiki', 'public');

        return response()->json([
            'url' => asset('storage/' . $path)
        ]);
    }
}