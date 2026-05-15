@extends('layouts.app')
@section('content')
<div class="mb-4">
    <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">➕ Tambah Studio</h2>
</div>
<div class="card-admin" style="max-width:480px">
    @if($errors->any())
        <div class="alert-danger-admin">❌ {{ $errors->first() }}</div>
    @endif
    <form action="/admin/studio" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label-admin">Nama Studio</label>
            <input type="text" name="nama" class="form-control-admin" placeholder="Studio 1" required>
        </div>
        <div class="mb-4">
            <label class="form-label-admin">Kapasitas Kursi</label>
            <input type="number" name="kapasitas" class="form-control-admin" placeholder="48" required>
        </div>
        <div class="d-flex gap-3">
            <button type="submit" class="btn-admin-primary">💾 Simpan</button>
            <a href="/admin/studio" class="btn-admin-danger">Batal</a>
        </div>
    </form>
</div>
@endsection