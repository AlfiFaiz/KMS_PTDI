<?php

namespace App\Http\Controllers;

use App\Models\Wiki;
use Illuminate\Http\Request;

class WikiCommentController extends Controller
{
    public function store(Request $request, Wiki $wiki)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        $wiki->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        // log activity
        $wiki->logs()->create([
            'action' => 'comment',
            'user_id' => auth()->id(),
            'notes' => 'Menambahkan komentar pada wiki',
        ]);

        return back()->with('success', 'Komentar ditambahkan');
    }
}