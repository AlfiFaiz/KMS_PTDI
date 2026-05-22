<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wiki;
use App\Models\Knowledge;
use App\Models\Qms;
use App\Models\Certificate;
use App\Models\AircraftProgram;
use App\Models\EngineeringOrder;
use App\Models\Info;
use App\Models\Task;
use App\Models\Company;

class GlobalSearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->search;

        $results = collect();

        if ($query) {

            /*
            |--------------------------------------------------------------------------
            | WIKI
            |--------------------------------------------------------------------------
            */

            $wiki = Wiki::where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")
                ->orWhere('tags', 'like', "%{$query}%")
                ->orWhere('category', 'like', "%{$query}%")
                ->get()
                ->map(function ($item) {

                    return [
                        'type' => 'Wiki',
                        'icon' => '📘',
                        'title' => $item->title,
                        'description' => strip_tags(\Str::limit($item->content, 120)),
                        'url' => route('wiki.show', $item->id),
                        'date' => $item->created_at,
                    ];
                });

            /*
            |--------------------------------------------------------------------------
            | KNOWLEDGE
            |--------------------------------------------------------------------------
            */

            $knowledge = Knowledge::where('title', 'like', "%{$query}%")
                ->orWhere('description', 'like', "%{$query}%")
                ->orWhere('category', 'like', "%{$query}%")
                ->get()
                ->map(function ($item) {

                    return [
                        'type' => 'Knowledge',
                        'icon' => '📂',
                        'title' => $item->title,
                        'description' => \Str::limit($item->description, 120),
                        'url' => route('knowledge.show', $item->id),
                        'date' => $item->created_at,
                    ];
                });

            /*
            |--------------------------------------------------------------------------
            | QMS
            |--------------------------------------------------------------------------
            */

            $qms = Qms::where('nomor', 'like', "%{$query}%")
                ->orWhere('judul', 'like', "%{$query}%")
                ->orWhere('affected_function', 'like', "%{$query}%")
                ->get()
                ->map(function ($item) {

                    return [
                        'type' => 'QMS',
                        'icon' => '📑',
                        'title' => $item->nomor . ' - ' . $item->judul,
                        'description' => $item->affected_function,
                        'url' => route('qms.edit', $item->id),
                        'date' => $item->created_at,
                    ];
                });

            /*
            |--------------------------------------------------------------------------
            | CERTIFICATE
            |--------------------------------------------------------------------------
            */

            $certificate = Certificate::where('nomor', 'like', "%{$query}%")
                ->orWhere('judul', 'like', "%{$query}%")
                ->orWhere('issued_by', 'like', "%{$query}%")
                ->get()
                ->map(function ($item) {

                    return [
                        'type' => 'Certificate',
                        'icon' => '📜',
                        'title' => $item->judul,
                        'description' => $item->issued_by,
                        'url' => route('certificates.edit', $item->id),
                        'date' => $item->created_at,
                    ];
                });

            /*
            |--------------------------------------------------------------------------
            | AIRCRAFT PROGRAM
            |--------------------------------------------------------------------------
            */

            /*
 |--------------------------------------------------------------------------
 | ENGINEERING ORDER
 |--------------------------------------------------------------------------
 */


            /*
            |--------------------------------------------------------------------------
            | INFO
            |--------------------------------------------------------------------------
            */

            $info = Info::where('title', 'like', "%{$query}%")
                ->orWhere('content', 'like', "%{$query}%")
                ->get()
                ->map(function ($item) {

                    return [
                        'type' => 'Info',
                        'icon' => '📰',
                        'title' => $item->title,
                        'description' => \Str::limit(strip_tags($item->content), 120),
                        'url' => route('infos.edit', $item->id),
                        'date' => $item->created_at,
                    ];
                });

            /*
            |--------------------------------------------------------------------------
            | TASK
            |--------------------------------------------------------------------------
            */


            /*
            |--------------------------------------------------------------------------
            | COMPANY
            |--------------------------------------------------------------------------
            */

            $company = Company::where('name', 'like', "%{$query}%")
                ->orWhere('address', 'like', "%{$query}%")
                ->get()
                ->map(function ($item) {

                    return [
                        'type' => 'Company',
                        'icon' => '🏢',
                        'title' => $item->name,
                        'description' => $item->address,
                        'url' => route('companies.edit', $item->id),
                        'date' => $item->created_at,
                    ];
                });

            /*
            |--------------------------------------------------------------------------
            | MERGE
            |--------------------------------------------------------------------------
            */

            $results = collect()
                ->merge($wiki)
                ->merge($knowledge)
                ->merge($qms)
                ->merge($certificate)
                ->merge($info)
                ->merge($company)
                ->sortByDesc('date');
        }

        return view(
            'modules.search.index',
            compact('results', 'query')
        );
    }
}