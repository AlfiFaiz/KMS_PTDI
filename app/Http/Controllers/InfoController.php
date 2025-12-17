<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;

class InfoController extends Controller
{
    public function index()
    {
        $infos = Info::latest()->paginate(10);
        return view('modules.feature.infos.index', compact('infos'));
    }

    public function create()
    {
        return view('modules.feature.infos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['title', 'content']);

        if ($request->hasFile('image')) {
            // Simpan file ke storage/app/public/infos
            $path = $request->file('image')->store('infos', 'public');
            $data['image_path'] = $path;
        }

        Info::create($data);

        return redirect()->route('infos.index')->with('success', 'Info berhasil ditambahkan');
    }

    public function edit(Info $info)
    {
        return view('modules.feature.infos.edit', compact('info'));
    }

    public function update(Request $request, Info $info)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['title', 'content']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('infos', 'public');
            $data['image_path'] = $path;
        }

        $info->update($data);

        return redirect()->route('infos.index')->with('success', 'Info berhasil diperbarui');
    }

    public function destroy(Info $info)
    {
        $info->delete();
        return redirect()->route('infos.index')->with('success', 'Info berhasil dihapus');
    }
}