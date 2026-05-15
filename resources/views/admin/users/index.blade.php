@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">👥 Data Pengguna</h2>
        <p style="color:rgba(255,255,255,0.4);font-size:14px">Kelola semua akun pengguna</p>
    </div>
    <a href="/admin/users/create" class="btn-admin-primary">+ Tambah Pengguna</a>
</div>
<div class="card-admin">
    <div style="overflow-x:auto">
        <table class="table table-admin mb-0">
            <thead><tr>
                <th>No</th><th>Nama</th><th>Email</th><th>No. Telpon</th><th>Role</th><th>Aksi</th>
            </tr></thead>
            <tbody>
            @forelse($data as $d)
            <tr>
                <td style="color:rgba(255,255,255,0.3)">{{ $loop->iteration }}</td>
                <td style="font-weight:700">{{ $d->name }}</td>
                <td style="color:rgba(255,255,255,0.6)">{{ $d->email }}</td>
                <td>{{ $d->no_telpon ?? '-' }}</td>
                <td>
                    @if($d->role=='admin')
                        <span class="badge-danger">Admin</span>
                    @else
                        <span class="badge-info">Pengguna</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="/admin/users/edit/{{ $d->id }}" class="btn-admin-warning">Edit</a>
                        <a href="/admin/users/reset/{{ $d->id }}"
                            onclick="return confirm('Reset password ke 12345678?')"
                            class="btn-admin-info">Reset PW</a>
                        <a href="/admin/users/delete/{{ $d->id }}"
                            onclick="return confirm('Hapus pengguna ini?')"
                            class="btn-admin-danger">Hapus</a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:rgba(255,255,255,0.3);padding:40px">
                    Belum ada data pengguna
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection