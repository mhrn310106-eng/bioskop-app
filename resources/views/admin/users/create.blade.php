@extends('layouts.app')
@section('content')
<div class="mb-4">
    <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">➕ Tambah Pengguna</h2>
</div>
<div class="card-admin" style="max-width:520px">
    @if($errors->any())
        <div class="alert-danger-admin">❌ {{ $errors->first() }}</div>
    @endif
    <form action="/admin/users/store" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label-admin">Nama Lengkap</label>
            <input type="text" name="name" class="form-control-admin" placeholder="Nama lengkap" required>
        </div>
        <div class="mb-3">
            <label class="form-label-admin">Email</label>
            <input type="email" name="email" class="form-control-admin" placeholder="email@example.com" required>
        </div>
        <div class="mb-3">
            <label class="form-label-admin">No. Telepon</label>
            <input type="text" name="no_telpon" class="form-control-admin" placeholder="08xxxxxxxxxx">
        </div>
        <div class="mb-3">
            <label class="form-label-admin">Role</label>
            <select name="role" class="form-control-admin">
                <option value="user">Pengguna</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="form-label-admin">Password</label>
            <input type="password" name="password" class="form-control-admin" placeholder="Minimal 6 karakter" required>
        </div>
        <div class="d-flex gap-3">
            <button type="submit" class="btn-admin-primary">💾 Simpan</button>
            <a href="/admin/users" class="btn-admin-danger">Batal</a>
        </div>
    </form>
</div>
@endsection