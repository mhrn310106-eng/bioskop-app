@extends('layouts.app')
@section('content')
<div class="mb-4">
    <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">➕ Tambah Jadwal</h2>
</div>
<div class="card-admin" style="max-width:560px">
    @if($errors->any())
        <div class="alert-danger-admin">❌ {{ $errors->first() }}</div>
    @endif
    <form action="/admin/jadwal" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label-admin">Film</label>
            <select name="film_id" class="form-control-admin" required>
                <option value="">-- Pilih Film --</option>
                @foreach($films as $f)
                    <option value="{{ $f->id }}">{{ $f->judul }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label-admin">Studio</label>
            <select name="studio_id" class="form-control-admin" required>
                <option value="">-- Pilih Studio --</option>
                @foreach($studios as $s)
                    <option value="{{ $s->id }}">{{ $s->nama }} ({{ $s->kapasitas }} kursi)</option>
                @endforeach
            </select>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label-admin">Tanggal</label>
                <input type="date" name="tanggal" class="form-control-admin" required>
            </div>
            <div class="col-md-6">
                <label class="form-label-admin">Jam Tayang</label>
                <input type="time" name="jam_tayang" class="form-control-admin" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label-admin">Harga per Kursi (Rp)</label>
            <input type="number" name="harga" class="form-control-admin" placeholder="50000" required>
        </div>
        <div class="d-flex gap-3">
            <button type="submit" class="btn-admin-primary">💾 Simpan</button>
            <a href="/admin/jadwal" class="btn-admin-danger">Batal</a>
        </div>
    </form>
</div>
@endsection