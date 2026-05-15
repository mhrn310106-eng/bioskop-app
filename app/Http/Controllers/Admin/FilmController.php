<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Film;
use Illuminate\Http\Request;

class FilmController extends Controller {

    public function index() {
        $films = Film::latest()->paginate(10);
        return view('admin.film.index', compact('films'));
    }

    public function create() {
        return view('admin.film.create');
    }

    public function store(Request $request) {
        $request->validate([
            'judul'   => 'required|max:200',
            'genre'   => 'required|max:100',
            'durasi'  => 'required|integer|min:1',
            'sinopsis'=> 'nullable',
            'poster'  => 'nullable|image|max:2048',
            'status'  => 'required|in:tayang,tidak_tayang',
        ]);

        $data = $request->all();
        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters','public');
        }
        Film::create($data);
        return redirect('/admin/film')->with('success','Film berhasil ditambahkan!');
    }

    public function edit(Film $film) {
        return view('admin.film.edit', compact('film'));
    }

    public function update(Request $request, Film $film) {
        $request->validate([
            'judul'   => 'required|max:200',
            'genre'   => 'required|max:100',
            'durasi'  => 'required|integer|min:1',
            'status'  => 'required|in:tayang,tidak_tayang',
        ]);
        $data = $request->except('poster');
        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('posters','public');
        }
        $film->update($data);
        return redirect('/admin/film')->with('success','Film berhasil diupdate!');
    }

    public function destroy(Film $film) {
        $film->delete();
        return redirect('/admin/film')->with('success','Film berhasil dihapus!');
    }
}
