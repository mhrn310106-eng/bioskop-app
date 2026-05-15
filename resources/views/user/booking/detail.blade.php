@extends('layouts.user')
@section('content')
<div class="container py-5">
    <div style="max-width:560px;margin:0 auto">
        <div style="background:#16161f;border-radius:20px;overflow:hidden;border:1px solid rgba(255,255,255,0.08)">
            <!-- HEADER -->
            <div style="background:linear-gradient(135deg,#1a237e,#283593);padding:32px;text-align:center">
                <div style="font-size:48px;margin-bottom:8px">🎫</div>
                <h4 style="font-weight:900;margin-bottom:4px">Bukti Booking</h4>
                <p style="color:rgba(255,255,255,0.7);font-size:14px">{{ $booking->kode_booking }}</p>
            </div>

            <!-- STATUS -->
            <div style="padding:24px 32px;border-bottom:1px solid rgba(255,255,255,0.06);text-align:center">
                @if($booking->status=='confirmed')
                    <span style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);padding:8px 24px;border-radius:20px;font-weight:700;font-size:14px">
                        ✅ Booking Dikonfirmasi
                    </span>
                @elseif($booking->status=='pending')
                    <span style="background:rgba(245,197,24,0.15);color:#f5c518;border:1px solid rgba(245,197,24,0.3);padding:8px 24px;border-radius:20px;font-weight:700;font-size:14px">
                        ⏳ Menunggu Konfirmasi
                    </span>
                @else
                    <span style="background:rgba(239,68,68,0.15);color:#f87171;border:1px solid rgba(239,68,68,0.3);padding:8px 24px;border-radius:20px;font-weight:700;font-size:14px">
                        ❌ Dibatalkan
                    </span>
                @endif
            </div>

            <!-- DETAIL -->
            <div style="padding:32px">
                @foreach([
                    ['Film', $booking->jadwal->film->judul],
                    ['Tanggal', $booking->jadwal->tanggal],
                    ['Jam', substr($booking->jadwal->jam_tayang,0,5)],
                    ['Studio', $booking->jadwal->studio->nama],
                    ['Kursi', $booking->kursis->pluck('nomor_kursi')->join(', ')],
                    ['Jumlah Tiket', $booking->jumlah_tiket.' tiket'],
                ] as $row)
                <div class="d-flex justify-content-between mb-3">
                    <span style="color:rgba(255,255,255,0.45);font-size:14px">{{ $row[0] }}</span>
                    <span style="font-weight:600;font-size:14px;text-align:right;max-width:60%">{{ $row[1] }}</span>
                </div>
                @endforeach
                <hr style="border-color:rgba(255,255,255,0.08)">
                <div class="d-flex justify-content-between">
                    <span style="font-size:16px;font-weight:700">Total Bayar</span>
                    <span style="font-size:22px;font-weight:900;color:#f5c518">
                        Rp {{ number_format($booking->total_harga) }}
                    </span>
                </div>
            </div>

            <!-- ACTION -->
            <div style="padding:0 32px 32px;display:flex;gap:12px">
                <a href="/user/riwayat"
                    style="flex:1;background:rgba(255,255,255,0.06);color:#fff;padding:12px;border-radius:10px;text-decoration:none;text-align:center;font-weight:600;font-size:14px">
                    ← Riwayat
                </a>
                    @if($booking->status_bayar == 'belum_bayar' && $booking->status != 'cancelled')
                    <a href="/user/booking/bayar/{{ $booking->id }}"
                    style="flex:1;background:#f5c518;color:#0a0a0f;padding:12px;border-radius:10px;text-decoration:none;text-align:center;font-weight:700;font-size:14px">
                    💳 Bayar Sekarang
                    </a>

                    @elseif($booking->status_bayar == 'menunggu_verifikasi')
                        <span style="flex:1;background:rgba(245,197,24,0.1);color:#f5c518;border:1px solid rgba(245,197,24,0.3);padding:12px;border-radius:10px;text-align:center;font-weight:700;font-size:14px">
                        ⏳ Menunggu Verifikasi
                        </span>
                
                    @elseif($booking->status_bayar == 'lunas')
                        <span style="flex:1;background:rgba(34,197,94,0.1);color:#4ade80;border:1px solid rgba(34,197,94,0.3);padding:12px;border-radius:10px;text-align:center;font-weight:700;font-size:14px">
                        ✅ Pembayaran Lunas
                        </span>
                    @endif


@if($booking->status_bayar == 'lunas')
<a href="/user/booking/cetak/{{ $booking->id }}"
    style="flex:1;background:rgba(99,179,237,0.15);color:#90cdf4;border:1px solid rgba(99,179,237,0.3);padding:12px;border-radius:10px;text-decoration:none;text-align:center;font-weight:700;font-size:14px">
    🖨️ Cetak Tiket PDF
</a>
@endif 

                @if($booking->status=='pending')
                <a href="/user/booking/cancel/{{ $booking->id }}"
                    onclick="return confirm('Batalkan booking ini?')"
                    style="flex:1;background:rgba(239,68,68,0.15);color:#f87171;border:1px solid rgba(239,68,68,0.3);padding:12px;border-radius:10px;text-decoration:none;text-align:center;font-weight:600;font-size:14px">
                    Batalkan
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection