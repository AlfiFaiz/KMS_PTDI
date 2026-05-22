<?php

namespace App\Http\Controllers;

use App\Models\Wiki;

class WikiInteractionController extends Controller
{
    // BOOKMARK
    public function bookmark(Wiki $wiki)
    {
        $exists = $wiki->bookmarks()
            ->where('user_id', auth()->id())
            ->exists();

        if (!$exists) {

            $wiki->bookmarks()->create([
                'user_id' => auth()->id(),
            ]);

            $wiki->logs()->create([
                'action' => 'bookmark',
                'user_id' => auth()->id(),
                'notes' => 'Bookmark wiki',
            ]);
        }

        return back();
    }

    // HELPFUL
    public function helpful(Wiki $wiki)
    {
        $exists = $wiki->helpfuls()
            ->where('user_id', auth()->id())
            ->exists();

        if (!$exists) {

            $wiki->helpfuls()->create([
                'user_id' => auth()->id(),
            ]);

            $wiki->logs()->create([
                'action' => 'helpful',
                'user_id' => auth()->id(),
                'notes' => 'Menandai wiki helpful',
            ]);
        }

        return back();
    }
}