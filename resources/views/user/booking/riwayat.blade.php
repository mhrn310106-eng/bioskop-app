@extends('layouts.user')
@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h2 class="section-title">📋 Riwayat Booking</h2>
        <p class="section-subtitle">Semua riwayat pemesanan tiket kamu</p>
    </div>

    @if($bookings->isEmpty())
        <div style="text-align:center;padding:80px;color:rgba(255,255,255,0.3)">
            <div style="font-size:64px;margin-bottom:16px">🎫</div>
            <p style="font-size:16px">Kamu belum pernah melakukan booking.</p>
            <a href="/user/film" style="color:#f5c518;text-decoration:none;font-weight:600">
                Mulai pesan tiket →
            </a>
        </div>
    @else
        <div style="display:flex;flex-direction:column;gap:16px">
            @foreach($bookings as $b)
            <div style="background:#16161f;border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:24px;display:flex;justify-content:space-between;align-items:center;transition:all 0.3s" onmouseover="this.style.borderColor='rgba(245,197,24,0.3)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.06)'">
                <div>
                    <div style="font-size:13px;color:rgba(255,255,255,0.4);margin-bottom:4px">
                        {{ $b->kode_booking }}
                    </div>
                    <div style="font-size:18px;font-weight:800;margin-bottom:4px">
                        {{ $b->film->judul }}
                    </div>
                    <div style="font-size:13px;color:rgba(255,255,255,0.5)">
                        📅 {{ $b->tanggal_booking }} &nbsp;|&nbsp;
                        🎫 {{ $b->jumlah_tiket }} tiket
                    </div>
                </div>
                <div style="text-align:right">
                    <div style="font-size:20px;font-weight:900;color:#f5c518;margin-bottom:8px">
                        Rp {{ number_format($b->total_harga) }}
                    </div>
                    <div style="margin-bottom:12px">
                        @if($b->status=='confirmed')
                            <span style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700">✅ Confirmed</span>
                        @elseif($b->status=='pending')
                            <span style="background:rgba(245,197,24,0.15);color:#f5c518;border:1px solid rgba(245,197,24,0.3);padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700">⏳ Pending</span>
                        @else
                            <span style="background:rgba(239,68,68,0.15);color:#f87171;border:1px solid rgba(239,68,68,0.3);padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700">❌ Cancelled</span>
                        @endif
                    </div>
                    <div style="display:flex;gap:8px;justify-content:flex-end">
                        <a href="/user/booking/detail/{{ $b->id }}"
                            style="background:rgba(245,197,24,0.15);color:#f5c518;border:1px solid rgba(245,197,24,0.3);padding:6px 14px;border-radius:8px;text-decoration:none;font-size:12px;font-weight:600">
                            Detail
                        </a>
                        @if($b->status=='pending')
                        <a href="/user/booking/cancel/{{ $b->id }}"
                            onclick="return confirm('Batalkan booking ini?')"
                            style="background:rgba(239,68,68,0.15);color:#f87171;border:1px solid rgba(239,68,68,0.3);padding:6px 14px;border-radius:8px;text-decoration:none;font-size:12px;font-weight:600">
                            Batal
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="mt-4 d-flex justify-content-center">
            {{ $bookings->links() }}
        </div>
    @endif
</div>
@endsection