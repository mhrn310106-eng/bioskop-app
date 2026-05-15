@extends('layouts.app')
@section('content')
<div class="mb-4">
    <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">✏️ Edit Film</h2>
    <p style="color:rgba(255,255,255,0.4);font-size:14px">Ubah data film yang sudah ada</p>
</div>

<div class="card-admin" style="max-width:640px">
    <form action="/admin/film/{{ $film->id }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label-admin">Judul Film</label>
            <input type="text" name="judul" class="form-control-admin" value="{{ $film->judul }}" required>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label-admin">Genre</label>
                <input type="text" name="genre" class="form-control-admin" value="{{ $film->genre }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label-admin">Durasi (menit)</label>
                <input type="number" name="durasi" class="form-control-admin" value="{{ $film->durasi }}" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label-admin">Sinopsis</label>
            <textarea name="sinopsis" class="form-control-admin" rows="4">{{ $film->sinopsis }}</textarea>
        </div>
        @if($film->poster)
        <div class="mb-3">
            <label class="form-label-admin">Poster Saat Ini</label>
            <div>
                <img src="{{ asset('storage/'.$film->poster) }}"
                    style="height:120px;border-radius:10px;object-fit:cover">
            </div>
        </div>
        @endif
        <div class="mb-3">
            <label class="form-label-admin">Ganti Poster (kosongkan jika tidak diubah)</label>
            <input type="file" name="poster" class="form-control-admin" accept="image/*">
        </div>
        <div class="mb-4">
            <label class="form-label-admin">Status</label>
            <select name="status" class="form-control-admin">
                <option value="tayang" {{ $film->status=='tayang' ? 'selected' : '' }}>Tayang</option>
                <option value="tidak_tayang" {{ $film->status=='tidak_tayang' ? 'selected' : '' }}>Tidak Tayang</option>
            </select>
        </div>
        <div class="d-flex gap-3">
            <button type="submit" class="btn-admin-primary">💾 Update Film</button>
            <a href="/admin/film" class="btn-admin-danger">Batal</a>
        </div>
    </form>
</div>
@endsection