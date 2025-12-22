<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SebastianBergmann\Diff\Differ;
use SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder;
use App\Models\Wiki;
use App\Models\WikiVersion;

class WikiVersionController extends Controller
{
    public function show(Wiki $wiki, WikiVersion $version)
    {
        // builder untuk format unified diff
            $newVersion = $version->load('editor');

    // Versi lama: cari versi sebelum newVersion
    $oldVersion = $wiki->versions()
        ->where('edited_at', '<', $newVersion->edited_at)
        ->orderBy('edited_at', 'desc')
        ->with('editor')
        ->first();


        return view('modules.feature.wiki.version.show', compact('wiki', 'newVersion', 'oldVersion'));
    }
}