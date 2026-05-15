<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Studio;
use Illuminate\Http\Request;

class StudioController extends Controller {

    public function index() {
        $studios = Studio::latest()->paginate(10);
        return view('admin.studio.index', compact('studios'));
    }

    public function create() { return view('admin.studio.create'); }

    public function store(Request $request) {
        $request->validate(['nama'=>'required','kapasitas'=>'required|integer|min:1']);
        Studio::create($request->all());
        return redirect('/admin/studio')->with('success','Studio ditambahkan!');
    }

    public function edit(Studio $studio) {
        return view('admin.studio.edit', compact('studio'));
    }

    public function update(Request $request, Studio $studio) {
        $request->validate(['nama'=>'required','kapasitas'=>'required|integer|min:1']);
        $studio->update($request->all());
        return redirect('/admin/studio')->with('success','Studio diupdate!');
    }

    public function destroy(Studio $studio) {
        $studio->delete();
        return redirect('/admin/studio')->with('success','Studio dihapus!');
    }
}

