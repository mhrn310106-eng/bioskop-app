@extends('layouts.app')
@section('content')
<div class="mb-4">
    <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">✏️ Edit Studio</h2>
</div>
<div class="card-admin" style="max-width:480px">
    <form action="/admin/studio/{{ $studio->id }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label class="form-label-admin">Nama Studio</label>
            <input type="text" name="nama" class="form-control-admin" value="{{ $studio->nama }}" required>
        </div>
        <div class="mb-4">
            <label class="form-label-admin">Kapasitas Kursi</label>
            <input type="number" name="kapasitas" class="form-control-admin" value="{{ $studio->kapasitas }}" required>
        </div>
        <div class="d-flex gap-3">
            <button type="submit" class="btn-admin-primary">💾 Update</button>
            <a href="/admin/studio" class="btn-admin-danger">Batal</a>
        </div>
    </form>
</div>
@endsection