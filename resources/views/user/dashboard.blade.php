@extends('layouts.user')
@section('content')

<!-- HERO -->
<div style="position:relative;height:480px;overflow:hidden;margin-bottom:60px">
    <div style="position:absolute;inset:0;background:url('https://images.unsplash.com/photo-1536440136628-849c177e76a1?w=1400') center/cover"></div>
    <div style="position:absolute;inset:0;background:linear-gradient(to right,rgba(10,10,15,0.95) 40%,transparent)"></div>
    <div class="container h-100 d-flex align-items-center" style="position:relative;z-index:1">
        <div style="max-width:520px">
            <span style="background:#f5c518;color:#0a0a0f;padding:6px 16px;border-radius:20px;font-size:12px;font-weight:700">
                🎬 Now Showing
            </span>
            <h1 style="font-size:48px;font-weight:900;line-height:1.1;margin:16px 0">
                Selamat Datang,<br>
                <span style="color:#f5c518">{{ auth()->user()->name }}!</span>
            </h1>
            <p style="color:rgba(255,255,255,0.65);font-size:15px;margin-bottom:28px;line-height:1.7">
                Temukan film terbaik dan pesan tiketmu sekarang. Pengalaman menonton yang tak terlupakan menantimu.
            </p>
            <a href="/user/film" style="background:#f5c518;color:#0a0a0f;padding:14px 32px;border-radius:12px;font-weight:800;text-decoration:none;font-size:15px;transition:all 0.3s">
                🎞️ Lihat Semua Film
            </a>
        </div>
    </div>
</div>

<!-- FILM SECTION -->
<div class="container mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="section-title">Film Sedang Tayang</h2>
            <p class="section-subtitle">Pilih film favoritmu dan pesan tiket sekarang</p>
        </div>
        <a href="/user/film" style="color:#f5c518;text-decoration:none;font-size:14px;font-weight:600">
            Lihat Semua →
        </a>
    </div>

    <!-- SCROLL HORIZONTAL -->
    <div class="d-flex gap-3 pb-3" style="overflow-x:auto;scroll-snap-type:x mandatory;scrollbar-width:thin;scrollbar-color:#f5c518 #16161f">
        @forelse($films as $f)
        <div class="film-card flex-shrink-0" style="width:200px;scroll-snap-align:start">
            @if($f->poster)
                <img src="{{ asset('storage/'.$f->poster) }}" alt="{{ $f->judul }}">
            @else
                <div style="height:280px;background:linear-gradient(135deg,#1a1a2e,#16213e);display:flex;align-items:center;justify-content:center">
                    <span style="font-size:48px">🎬</span>
                </div>
            @endif
            <div class="film-card-body">
                <span class="badge-genre mb-2 d-inline-block">{{ $f->genre }}</span>
                <div class="film-card-title">{{ $f->judul }}</div>
                <div class="film-card-meta mb-2">⏱ {{ $f->durasi }} menit</div>
                <a href="/user/jadwal/{{ $f->id }}" class="btn-ticket">🎫 Beli Tiket</a>
            </div>
        </div>
        @empty
        <div style="color:rgba(255,255,255,0.4);padding:40px;text-align:center;width:100%">
            Belum ada film yang tayang saat ini.
        </div>
        @endforelse
    </div>
</div>

@endsection