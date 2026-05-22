<?php

namespace App\Http\Controllers;

use App\Models\Wiki;
use App\Models\WikiVersion;
use Caxy\HtmlDiff\HtmlDiff;

class WikiVersionController extends Controller
{
    public function show(Wiki $wiki, WikiVersion $version)
    {
        $newVersion = $version->load('editor');

        /*
        |--------------------------------------------------------------------------
        | Cari versi sebelumnya
        |--------------------------------------------------------------------------
        */

        $oldVersion = $wiki->versions()
            ->where('id', '<', $newVersion->id)
            ->orderBy('id', 'desc')
            ->with('editor')
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Generate Diff
        |--------------------------------------------------------------------------
        */

        $diff = null;

        if ($oldVersion) {

            $diff = HtmlDiff::create(
                $oldVersion->content,
                $newVersion->content
            )->build();

        }

        return view(
            'modules.feature.wiki.version.show',
            compact(
                'wiki',
                'newVersion',
                'oldVersion',
                'diff'
            )
        );
    }
}