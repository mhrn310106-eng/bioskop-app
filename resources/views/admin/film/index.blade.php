@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">🎞️ Data Film</h2>
        <p style="color:rgba(255,255,255,0.4);font-size:14px">Kelola semua data film bioskop</p>
    </div>
    <a href="/admin/film/create" class="btn-admin-primary">+ Tambah Film</a>
</div>

<div class="card-admin">
    <div style="overflow-x:auto">
        <table class="table table-admin mb-0">
            <thead><tr>
                <th>No</th><th>Judul Film</th><th>Genre</th><th>Durasi</th><th>Status</th><th>Aksi</th>
            </tr></thead>
            <tbody>
            @forelse($films as $f)
            <tr>
                <td style="color:rgba(255,255,255,0.3)">{{ $films->firstItem() + $loop->index }}</td>
                <td style="font-weight:700">{{ $f->judul }}</td>
                <td><span class="badge-info">{{ $f->genre }}</span></td>
                <td>{{ $f->durasi }} menit</td>
                <td>
                    @if($f->status=='tayang')
                        <span class="badge-success">Tayang</span>
                    @else
                        <span class="badge-danger">Tidak Tayang</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="/admin/film/{{ $f->id }}/edit" class="btn-admin-warning">Edit</a>
                        <form action="/admin/film/{{ $f->id }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn-admin-danger"
                                onclick="return confirm('Hapus film ini?')">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;color:rgba(255,255,255,0.3);padding:40px">
                    Belum ada data film
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 d-flex justify-content-center">
        {{ $films->links() }}
    </div>
</div>
@endsection