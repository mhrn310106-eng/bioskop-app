@extends('layouts.app')
@section('content')
<div class="mb-4">
    <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">✏️ Edit Jadwal</h2>
</div>
<div class="card-admin" style="max-width:560px">
    <form action="/admin/jadwal/{{ $jadwal->id }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label-admin">Film</label>
            <select name="film_id" class="form-control-admin" required>
                @foreach($films as $f)
                    <option value="{{ $f->id }}" {{ $jadwal->film_id==$f->id ? 'selected' : '' }}>
                        {{ $f->judul }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label-admin">Studio</label>
            <select name="studio_id" class="form-control-admin" required>
                @foreach($studios as $s)
                    <option value="{{ $s->id }}" {{ $jadwal->studio_id==$s->id ? 'selected' : '' }}>
                        {{ $s->nama }} ({{ $s->kapasitas }} kursi)
                    </option>
                @endforeach
            </select>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label-admin">Tanggal</label>
                <input type="date" name="tanggal" class="form-control-admin" value="{{ $jadwal->tanggal }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label-admin">Jam Tayang</label>
                <input type="time" name="jam_tayang" class="form-control-admin" value="{{ substr($jadwal->jam_tayang,0,5) }}" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label-admin">Harga per Kursi (Rp)</label>
            <input type="number" name="harga" class="form-control-admin" value="{{ $jadwal->harga }}" required>
        </div>
        <div class="d-flex gap-3">
            <button type="submit" class="btn-admin-primary">💾 Update</button>
            <a href="/admin/jadwal" class="btn-admin-danger">Batal</a>
        </div>
    </form>
</div>
@endsection