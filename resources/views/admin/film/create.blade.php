@extends('layouts.app')
@section('content')
<div class="mb-4">
    <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">➕ Tambah Film</h2>
    <p style="color:rgba(255,255,255,0.4);font-size:14px">Tambahkan film baru ke dalam sistem</p>
</div>

<div class="card-admin" style="max-width:640px">
    @if($errors->any())
        <div class="alert-danger-admin">❌ {{ $errors->first() }}</div>
    @endif
    <form action="/admin/film" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label-admin">Judul Film</label>
            <input type="text" name="judul" class="form-control-admin" placeholder="Masukkan judul film" required>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label-admin">Genre</label>
                <input type="text" name="genre" class="form-control-admin" placeholder="Action, Horror, dll" required>
            </div>
            <div class="col-md-6">
                <label class="form-label-admin">Durasi (menit)</label>
                <input type="number" name="durasi" class="form-control-admin" placeholder="120" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label-admin">Sinopsis</label>
            <textarea name="sinopsis" class="form-control-admin" rows="4" placeholder="Tulis sinopsis film..."></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label-admin">Poster Film</label>
            <input type="file" name="poster" class="form-control-admin" accept="image/*">
        </div>
        <div class="mb-4">
            <label class="form-label-admin">Status</label>
            <select name="status" class="form-control-admin">
                <option value="tayang">Tayang</option>
                <option value="tidak_tayang">Tidak Tayang</option>
            </select>
        </div>
        <div class="d-flex gap-3">
            <button type="submit" class="btn-admin-primary">💾 Simpan Film</button>
            <a href="/admin/film" class="btn-admin-danger">Batal</a>
        </div>
    </form>
</div>
@endsection