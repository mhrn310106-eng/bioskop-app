@extends('layouts.user')
@section('content')
<div class="container py-5">
    <!-- FILM INFO -->
    <div class="d-flex gap-4 mb-5 align-items-start">
        @if($film->poster)
            <img src="{{ asset('storage/'.$film->poster) }}"
                style="width:140px;height:200px;object-fit:cover;border-radius:16px;flex-shrink:0">
        @else
            <div style="width:140px;height:200px;background:linear-gradient(135deg,#1a1a2e,#16213e);border-radius:16px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <span style="font-size:40px">🎬</span>
            </div>
        @endif
        <div>
            <span class="badge-genre mb-2 d-inline-block">{{ $film->genre }}</span>
            <h2 style="font-size:32px;font-weight:900;margin-bottom:8px">{{ $film->judul }}</h2>
            <p style="color:rgba(255,255,255,0.5);font-size:14px;margin-bottom:12px">
                ⏱ {{ $film->durasi }} menit
            </p>
            <p style="color:rgba(255,255,255,0.65);font-size:14px;line-height:1.7;max-width:600px">
                {{ $film->sinopsis }}
            </p>
        </div>
    </div>

    <h4 style="font-weight:800;margin-bottom:24px">📅 Pilih Jadwal Tayang</h4>

    @if($jadwals->isEmpty())
        <div style="text-align:center;padding:60px;color:rgba(255,255,255,0.4)">
            <div style="font-size:48px">📅</div>
            <p>Belum ada jadwal tersedia untuk film ini.</p>
        </div>
    @else
    <div class="row g-3">
        @foreach($jadwals as $j)
        <div class="col-md-4">
            <div style="background:#16161f;border:1px solid rgba(255,255,255,0.08);border-radius:16px;padding:24px;transition:all 0.3s" onmouseover="this.style.borderColor='#f5c518'" onmouseout="this.style.borderColor='rgba(255,255,255,0.08)'">
                <div style="font-size:13px;color:rgba(255,255,255,0.5);margin-bottom:8px">
                    📅 {{ $j->tanggal }} &nbsp;|&nbsp; 🕐 {{ substr($j->jam_tayang,0,5) }}
                </div>
                <div style="font-size:16px;font-weight:700;margin-bottom:4px">
                    {{ $j->studio->nama }}
                </div>
                <div style="font-size:13px;color:rgba(255,255,255,0.5);margin-bottom:16px">
                    💺 {{ $j->studio->kapasitas }} kursi
                </div>
                <div style="font-size:24px;font-weight:900;color:#f5c518;margin-bottom:16px">
                    Rp {{ number_format($j->harga) }}
                    <span style="font-size:13px;font-weight:400;color:rgba(255,255,255,0.4)">/ kursi</span>
                </div>
                <a href="/user/booking/{{ $j->id }}"
                    style="background:#f5c518;color:#0a0a0f;padding:12px;border-radius:10px;font-weight:800;text-decoration:none;display:block;text-align:center;font-size:14px;transition:all 0.3s">
                    🎫 Pesan Sekarang
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @endif
</div>
@endsection