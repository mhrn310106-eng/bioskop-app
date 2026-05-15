@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">🎫 Manajemen Booking</h2>
        <p style="color:rgba(255,255,255,0.4);font-size:14px">Kelola semua transaksi booking tiket</p>
    </div>
    <!-- Tombol Export -->
    <div class="d-flex gap-2">
        <a href="/admin/booking/export/excel"
            style="background:rgba(34,197,94,0.12);color:#4ade80;border:1px solid rgba(34,197,94,0.3);padding:10px 20px;border-radius:10px;font-weight:700;font-size:13px;text-decoration:none;transition:all 0.3s">
            📊 Export Excel
        </a>
        <a href="/admin/booking/export/pdf"
            style="background:rgba(239,68,68,0.12);color:#f87171;border:1px solid rgba(239,68,68,0.3);padding:10px 20px;border-radius:10px;font-weight:700;font-size:13px;text-decoration:none;transition:all 0.3s">
            📄 Export PDF
        </a>
    </div>
</div>
<div class="card-admin">

    <!-- FILTER -->
    <form method="GET" action="/admin/booking" class="d-flex gap-3 mb-4 flex-wrap">
        <div>
            <label style="font-size:11px;font-weight:700;color:rgba(255,255,255,0.4);letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:6px">
                Tanggal Booking
            </label>
            <input type="date" name="tanggal"
                value="{{ request('tanggal') }}"
                style="background:#1a1a2e;border:1px solid rgba(255,255,255,0.08);border-radius:10px;padding:10px 14px;color:#fff;font-size:13px;outline:none">
        </div>
        <div>
            <label style="font-size:11px;font-weight:700;color:rgba(255,255,255,0.4);letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:6px">
                Status Bayar
            </label>
            <select name="status_bayar"
                style="background:#1a1a2e;border:1px solid rgba(255,255,255,0.08);border-radius:10px;padding:10px 14px;color:#fff;font-size:13px;outline:none">
                <option value="">Semua</option>
                <option value="belum_bayar"         {{ request('status_bayar')=='belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                <option value="menunggu_verifikasi" {{ request('status_bayar')=='menunggu_verifikasi' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                <option value="lunas"               {{ request('status_bayar')=='lunas' ? 'selected' : '' }}>Lunas</option>
            </select>
        </div>
        <div>
            <label style="font-size:11px;font-weight:700;color:rgba(255,255,255,0.4);letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:6px">
                Status Booking
            </label>
            <select name="status"
                style="background:#1a1a2e;border:1px solid rgba(255,255,255,0.08);border-radius:10px;padding:10px 14px;color:#fff;font-size:13px;outline:none">
                <option value="">Semua</option>
                <option value="pending"   {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
                <option value="confirmed" {{ request('status')=='confirmed' ? 'selected' : '' }}>Confirmed</option>
                <option value="cancelled" {{ request('status')=='cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
        </div>
        <div style="display:flex;align-items:flex-end;gap:8px">
            <button type="submit"
                style="background:#f5c518;color:#0a0a0f;border:none;padding:10px 20px;border-radius:10px;font-weight:700;font-size:13px;cursor:pointer">
                🔍 Filter
            </button>
            <a href="/admin/booking"
                style="background:rgba(255,255,255,0.06);color:rgba(255,255,255,0.6);padding:10px 20px;border-radius:10px;font-weight:700;font-size:13px;text-decoration:none">
                Reset
            </a>
        </div>
    </form>

    <div style="overflow-x:auto">
    <!-- tabel seperti biasa di bawahnya -->
        <table class="table table-admin mb-0"
        style="width:100%; border-collapse:separate; border-spacing:0 12px;">
            <thead><tr style="text-align:center;">
                <th>Kode</th>
                <th>Pengguna</th>
                <th>Film</th>
                <th>Tanggal</th>
                <th>Tiket</th>
                <th>Total</th>
                <th>Status Bayar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
            <tbody>
            @forelse($bookings as $b)
            <tr>
            
                <td style="font-family:monospace;color:#f5c518;font-size:12px;vertical-align:middle">
                    {{ $b->kode_booking }}
                </td>
                <td style="vertical-align:middle">
                    {{ $b->user->name }}
                </td>
                <td style="font-weight:700;vertical-align:middle;line-height:1.5">
                    {{ $b->jadwal->film->judul }}
                </td>
                <td style="vertical-align:middle">
                    {{ $b->jadwal->tanggal }}
                </td>
                <td style="vertical-align:middle">
                    {{ $b->jumlah_tiket }} tiket
                </td>
                <td style="font-weight:700;vertical-align:middle">
                    Rp {{ number_format($b->total_harga) }}
                </td>
                
                <!-- STATUS PEMBAYARAN -->
                <td style="vertical-align:middle;text-align:center">
                    <div class="d-flex gap-2 flex-wrap justify-content-center align-items-center">
                    @if($b->status_bayar == 'menunggu_verifikasi' && $b->status == 'pending')

                    <!-- Tampilkan bukti bayar -->
                    @if($b->bukti_bayar)
                    <a href="{{ asset('storage/'.$b->bukti_bayar) }}" target="_blank"
                        class="btn-admin-info">Lihat Bukti</a>
                    @endif
                    <a href="/admin/booking/{{ $b->id }}/verifikasi"
                        onclick="return confirm('Verifikasi pembayaran dan konfirmasi booking ini?')"
                        class="btn-admin-success">✅ Verifikasi</a>
                    <a href="/admin/booking/{{ $b->id }}/cancel"
                        class="btn-admin-warning">Tolak</a>
                    
                    @elseif($b->status == 'pending' && $b->status_bayar == 'belum_bayar')
    <span style="font-size:12px;color:rgba(255,255,255,0.3)">
        Belum bayar
    </span>

@elseif($b->status_bayar == 'lunas' || $b->status == 'confirmed')
    <span class="badge-success">
        ✅ Lunas
    </span>

    @elseif($b->status == 'cancelled')

    <span class="badge-danger">
        ❌ Tidak bayar
    </span>
@endif
                </div>
                </td>

                <td>
                    @if($b->status=='confirmed')
                        <span class="badge-success">Confirmed</span>
                    @elseif($b->status=='pending')
                        <span class="badge-warning">Pending</span>
                    @else
                        <span class="badge-danger">Cancelled</span>
                    @endif
                </td>

                <!-- ACTION -->
                <td style="vertical-align:middle;text-align:center">
                    <div class="d-flex gap-2 flex-wrap justify-content-center">
                        @if($b->status=='pending')
                            <a href="/admin/booking/{{ $b->id }}/confirm" class="btn-admin-success">Konfirmasi</a>
                            <a href="/admin/booking/{{ $b->id }}/cancel" class="btn-admin-warning">Batal</a>
                        @endif
                        <a href="/admin/booking/{{ $b->id }}/hapus"
                            onclick="return confirm('Hapus booking ini?')"
                            class="btn-admin-danger">Hapus</a>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center;color:rgba(255,255,255,0.3);padding:40px">
                    Belum ada data booking
                </td>
            </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3 d-flex justify-content-center">{{ $bookings->links() }}</div>
</div>
@endsection