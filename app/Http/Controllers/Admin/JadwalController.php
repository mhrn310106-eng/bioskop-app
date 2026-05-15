<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Studio;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller {

    public function index() {
        $jadwals = Jadwal::with(['film','studio'])->latest()->paginate(10);
        return view('admin.jadwal.index', compact('jadwals'));
    }

    public function create() {
        $films   = Film::where('status','tayang')->get();
        $studios = Studio::all();
        return view('admin.jadwal.create', compact('films','studios'));
    }

    public function store(Request $request) {
        $request->validate([
            'film_id'   => 'required|exists:films,id',
            'studio_id' => 'required|exists:studios,id',
            'tanggal'   => 'required|date|after_or_equal:today',
            'jam_tayang'=> 'required',
            'harga'     => 'required|integer|min:1000',
        ]);
        Jadwal::create($request->all());
        return redirect('/admin/jadwal')->with('success','Jadwal ditambahkan!');
    }

    public function edit(Jadwal $jadwal) {
        $films   = Film::where('status','tayang')->get();
        $studios = Studio::all();
        return view('admin.jadwal.edit', compact('jadwal','films','studios'));
    }

    public function update(Request $request, Jadwal $jadwal) {
        $request->validate([
            'film_id'   => 'required|exists:films,id',
            'studio_id' => 'required|exists:studios,id',
            'tanggal'   => 'required|date',
            'jam_tayang'=> 'required',
            'harga'     => 'required|integer|min:1000',
        ]);
        $jadwal->update($request->all());
        return redirect('/admin/jadwal')->with('success','Jadwal diupdate!');
    }

    public function destroy(Jadwal $jadwal) {
        $jadwal->delete();
        return redirect('/admin/jadwal')->with('success','Jadwal dihapus!');
    }
}

