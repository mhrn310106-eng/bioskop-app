@extends('layouts.user')
@section('content')
<div class="container py-5">
    <div class="mb-5">
        <h2 class="section-title">🎞️ Semua Film Tayang</h2>
        <p class="section-subtitle">Pilih film favoritmu dan pesan tiket sekarang</p>
    </div>

    <div class="row g-4">
        @forelse($films as $f)
        <div class="col-md-3 col-sm-6">
            <div class="film-card h-100">
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
                    <div class="film-card-meta mb-1">⏱ {{ $f->durasi }} menit</div>
                    <div class="film-card-meta mb-3" style="font-size:11px">
                        {{ Str::limit($f->sinopsis, 70) }}
                    </div>
                    <a href="/user/jadwal/{{ $f->id }}" class="btn-ticket">🎫 Beli Tiket</a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5" style="color:rgba(255,255,255,0.4)">
            <div style="font-size:64px">🎬</div>
            <p>Belum ada film yang tayang saat ini.</p>
        </div>
        @endforelse
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $films->links() }}
    </div>
</div>
@endsection