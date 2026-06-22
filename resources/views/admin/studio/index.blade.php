@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">🏢 Data Studio</h2>
        <p style="color:rgba(255,255,255,0.4);font-size:14px">Kelola studio bioskop</p>
    </div>
    <a href="/admin/studio/create" class="btn-admin-primary">+ Tambah Studio</a>
</div>
<div class="card-admin">
    <table class="table table-admin mb-0">
        <thead><tr>
            <th>No</th><th>Nama Studio</th><th>Kapasitas</th><th>Aksi</th>
        </tr></thead>
        <tbody>
        @forelse($studios as $s)
        <tr>
            <td style="color:rgba(255,255,255,0.3)">{{ $studios->firstItem() + $loop->index }}</td>
            <td style="font-weight:700">{{ $s->nama }}</td>
            <td><span class="badge-info">{{ $s->kapasitas }} kursi</span></td>
            <td>
                <div class="d-flex gap-2">
                    <a href="/admin/studio/{{ $s->id }}/edit" class="btn-admin-warning">Edit</a>
                    <form action="/admin/studio/{{ $s->id }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn-admin-danger"
                            onclick="return confirm('Hapus studio ini?')">Hapus</button>
                    </form>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" style="text-align:center;color:rgba(255,255,255,0.3);padding:40px">
                Belum ada data studio
            </td>
        </tr>
        @endforelse
        </tbody>
    </table>
    <div class="mt-3 d-flex justify-content-center">{{ $studios->links() }}</div>
</div>
@endsection