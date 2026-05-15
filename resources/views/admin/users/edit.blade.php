@extends('layouts.app')
@section('content')
<div class="mb-4">
    <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">✏️ Edit Pengguna</h2>
</div>
<div class="card-admin" style="max-width:520px">
    <form action="/admin/users/update/{{ $data->id }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label-admin">Nama Lengkap</label>
            <input type="text" name="name" class="form-control-admin" value="{{ $data->name }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label-admin">Email</label>
            <input type="email" name="email" class="form-control-admin" value="{{ $data->email }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label-admin">No. Telepon</label>
            <input type="text" name="no_telpon" class="form-control-admin" value="{{ $data->no_telpon }}">
        </div>
        <div class="mb-4">
            <label class="form-label-admin">Role</label>
            <select name="role" class="form-control-admin">
                <option value="user" {{ $data->role=='user' ? 'selected' : '' }}>Pengguna</option>
                <option value="admin" {{ $data->role=='admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <div class="d-flex gap-3">
            <button type="submit" class="btn-admin-primary">💾 Update</button>
            <a href="/admin/users" class="btn-admin-danger">Batal</a>
        </div>
    </form>
</div>
@endsection