@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">📅 Data Jadwal</h2>
        <p style="color:rgba(255,255,255,0.4);font-size:14px">Kelola jadwal tayang film</p>
    </div>
    <a href="/admin/jadwal/create" class="btn-admin-primary">+ Tambah Jadwal</a>
</div>
<div class="card-admin">
    <div style="overflow-x:auto">
        <table class="table table-admin mb-0">
            <thead><tr>
                <th>No</th><th>Film</th><th>Studio</th><th>Tanggal</th><th>Jam</th><th>Harga</th><th>Aksi</th>
            </tr></thead>
            <tbody>
            @forelse($jadwals as $j)
            <tr>
                <td style="color:rgba(255,255,255,0.3)">{{ $jadwals->firstItem() + $loop->index }}</td>
                <td style="font-weight:700">{{ $j->film->judul }}</td>
                <td>{{ $j->studio->nama }}</td>
                <td>{{ $j->tanggal }}</td>
                <td><span class="badge-info">{{ substr($j->jam_tayang,0,5) }}</span></td>
                <td style="color:#f5c518;font-weight:700">Rp {{ number_format($j->harga) }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="/admin/jadwal/{{ $j->id }}/edit" class="btn-admin-warning">Edit</a>
                        <form action="/admin/jadwal/{{ $j->id }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn-admin-danger"
                                onclick="return confirm('Hapus jadwal ini?')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;color:rgba(255,255,255,0.3);padding:40px">
                    Belum ada data jadwal
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 d-flex justify-content-center">{{ $jadwals->links() }}</div>
</div>
@endsection