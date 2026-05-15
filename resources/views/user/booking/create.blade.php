@extends('layouts.user')
@section('content')
<div class="container py-5">
    <h2 style="font-weight:900;margin-bottom:4px">🎫 Pilih Kursi</h2>
    <p style="color:rgba(255,255,255,0.5);margin-bottom:32px">
        {{ $jadwal->film->judul }} &nbsp;|&nbsp;
        {{ $jadwal->tanggal }} {{ substr($jadwal->jam_tayang,0,5) }} &nbsp;|&nbsp;
        {{ $jadwal->studio->nama }}
    </p>

    <form action="/user/booking/{{ $jadwal->id }}" method="POST">
    @csrf
    <div style="background:#16161f;border-radius:20px;padding:32px;margin-bottom:24px">

        <!-- LAYAR -->
        <div style="background:linear-gradient(90deg,transparent,rgba(245,197,24,0.3),transparent);height:4px;border-radius:2px;margin-bottom:8px"></div>
        <p style="text-align:center;color:rgba(255,255,255,0.3);font-size:12px;margin-bottom:32px;letter-spacing:4px">LAYAR</p>

        <!-- KURSI -->
        <div class="d-flex flex-wrap gap-2 justify-content-center mb-4">
            @foreach($allKursi as $k)
                @if(in_array($k, $kursiBooked))
                    <button type="button"
                        style="width:48px;height:48px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;color:rgba(255,255,255,0.2);font-size:12px;font-weight:600;cursor:not-allowed"
                        disabled>{{ $k }}</button>
                @else
                    <input type="checkbox" name="kursi[]" value="{{ $k }}"
                        id="k{{ $k }}" class="d-none kursi-check">
                    <label for="k{{ $k }}"
                        style="width:48px;height:48px;background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.4);border-radius:8px;color:#4ade80;font-size:12px;font-weight:600;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all 0.2s"
                        class="kursi-label">{{ $k }}</label>
                @endif
            @endforeach
        </div>

        <!-- LEGEND -->
        <div class="d-flex gap-4 justify-content-center" style="font-size:12px;color:rgba(255,255,255,0.5)">
            <span style="display:flex;align-items:center;gap:6px">
                <span style="width:16px;height:16px;background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.4);border-radius:4px;display:inline-block"></span>
                Tersedia
            </span>
            <span style="display:flex;align-items:center;gap:6px">
                <span style="width:16px;height:16px;background:#f5c518;border-radius:4px;display:inline-block"></span>
                Dipilih
            </span>
            <span style="display:flex;align-items:center;gap:6px">
                <span style="width:16px;height:16px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:4px;display:inline-block"></span>
                Terisi
            </span>
        </div>
    </div>

    <!-- SUMMARY -->
    <div style="background:#16161f;border-radius:16px;padding:24px;margin-bottom:24px">
        <div class="d-flex justify-content-between mb-2">
            <span style="color:rgba(255,255,255,0.5)">Kursi dipilih</span>
            <span style="font-weight:700" id="count">0 kursi</span>
        </div>
        <div class="d-flex justify-content-between mb-2">
            <span style="color:rgba(255,255,255,0.5)">Harga per kursi</span>
            <span style="font-weight:700">Rp {{ number_format($jadwal->harga) }}</span>
        </div>
        <hr style="border-color:rgba(255,255,255,0.08)">
        <div class="d-flex justify-content-between">
            <span style="font-size:18px;font-weight:700">Total</span>
            <span style="font-size:22px;font-weight:900;color:#f5c518" id="total">Rp 0</span>
        </div>
    </div>

    <button type="submit" style="background:#f5c518;color:#0a0a0f;border:none;padding:16px;border-radius:12px;font-weight:800;font-size:16px;width:100%;cursor:pointer;transition:all 0.3s">
        🎫 Konfirmasi Booking
    </button>
    </form>
</div>

<script>
const harga = {{ $jadwal->harga }};
document.querySelectorAll('.kursi-check').forEach(cb => {
    cb.addEventListener('change', function() {
        const lbl = document.querySelector('label[for="' + this.id + '"]');
        if (this.checked) {
            lbl.style.background = '#f5c518';
            lbl.style.borderColor = '#f5c518';
            lbl.style.color = '#0a0a0f';
        } else {
            lbl.style.background = 'rgba(34,197,94,0.1)';
            lbl.style.borderColor = 'rgba(34,197,94,0.4)';
            lbl.style.color = '#4ade80';
        }
        const checked = document.querySelectorAll('.kursi-check:checked').length;
        document.getElementById('count').textContent = checked + ' kursi';
        document.getElementById('total').textContent = 'Rp ' + (checked * harga).toLocaleString('id-ID');
    });
});
</script>
@endsection