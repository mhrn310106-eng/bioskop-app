@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">Dashboard</h2>
        <p style="color:rgba(255,255,255,0.4);font-size:14px">Selamat datang kembali, {{ auth()->user()->name }}</p>
    </div>
</div>

<!-- STATS CARDS -->
<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div style="background:#16161f;border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:24px">
            <div style="display:flex;justify-content:space-between;align-items:flex-start">
                <div>
                    <p style="color:rgba(255,255,255,0.4);font-size:13px;margin-bottom:8px">Total Film</p>
                    <h2 style="font-size:36px;font-weight:900;color:#fff;margin:0">{{ $totalFilm }}</h2>
                </div>
                <div style="width:48px;height:48px;background:rgba(245,197,24,0.12);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px">🎞️</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div style="background:#16161f;border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:24px">
            <div style="display:flex;justify-content:space-between;align-items:flex-start">
                <div>
                    <p style="color:rgba(255,255,255,0.4);font-size:13px;margin-bottom:8px">Total Booking</p>
                    <h2 style="font-size:36px;font-weight:900;color:#fff;margin:0">{{ $totalBooking }}</h2>
                </div>
                <div style="width:48px;height:48px;background:rgba(34,197,94,0.12);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px">🎫</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div style="background:#16161f;border:1px solid rgba(255,255,255,0.06);border-radius:16px;padding:24px">
            <div style="display:flex;justify-content:space-between;align-items:flex-start">
                <div>
                    <p style="color:rgba(255,255,255,0.4);font-size:13px;margin-bottom:8px">Total Pengguna</p>
                    <h2 style="font-size:36px;font-weight:900;color:#fff;margin:0">{{ $totalUser }}</h2>
                </div>
                <div style="width:48px;height:48px;background:rgba(99,179,237,0.12);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px">👥</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div style="background:#16161f;border:1px solid rgba(245,197,24,0.15);border-radius:16px;padding:24px">
            <div style="display:flex;justify-content:space-between;align-items:flex-start">
                <div>
                    <p style="color:rgba(255,255,255,0.4);font-size:13px;margin-bottom:8px">Pendapatan Hari Ini</p>
                    <h3 style="font-size:22px;font-weight:900;color:#f5c518;margin:0">
                        Rp {{ number_format($pendapatanHariIni) }}
                    </h3>
                </div>
                <div style="width:48px;height:48px;background:rgba(245,197,24,0.12);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px">💰</div>
            </div>
        </div>
    </div>
</div>

<!-- BOOKING TERBARU -->
<div class="card-admin">
    <div class="card-admin-header">📋 Booking Terbaru</div>
    <div style="overflow-x:auto">
        <table class="table table-admin mb-0">
            <thead>
                <tr>
                    <th>Kode Booking</th>
                    <th>Pengguna</th>
                    <th>Film</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookingTerbaru as $b)
                <tr>
                    <td style="font-family:monospace;color:#f5c518">{{ $b->kode_booking }}</td>
                    <td>{{ $b->user->name }}</td>
                    <td>{{ $b->jadwal->film->judul }}</td>
                    <td style="font-weight:700">Rp {{ number_format($b->total_harga) }}</td>
                    <td>
                        @if($b->status=='confirmed')
                            <span class="badge-success">Confirmed</span>
                        @elseif($b->status=='pending')
                            <span class="badge-warning">Pending</span>
                        @else
                            <span class="badge-danger">Cancelled</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align:center;color:rgba(255,255,255,0.3);padding:40px">
                        Belum ada data booking
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection