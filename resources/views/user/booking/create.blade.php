@extends('layouts.user')
@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h2 class="section-title">Booking Tiket Bioskop</h2>
        <p class="section-subtitle">Pilih tanggal, jam tayang, dan kursi sesuai keinginan kamu.</p>
    </div>

    <div class="card p-4" style="background:#16161f;border:1px solid rgba(255,255,255,0.08);border-radius:16px;">
        <div class="mb-4">
            <h4 style="color:#fff;font-weight:800;">{{ $film->judul }}</h4>
            <p style="color:rgba(255,255,255,0.6);margin-bottom:0;">
                Genre: {{ $film->genre }} | Durasi: {{ $film->durasi }} menit
            </p>
        </div>

        <form action="/user/booking/{{ $film->id }}" method="POST">
            @csrf

            <div class="row mb-4">
                <div class="col-md-6">
                    <label class="form-label" style="color:#f5c518;font-weight:700;">Pilih Tanggal</label>
                    <input type="date"
                           name="tanggal_booking"
                           id="tanggal_booking"
                           class="form-control"
                           min="{{ date('Y-m-d') }}"
                           required>
                </div>

                <div class="col-md-6">
                    <label class="form-label" style="color:#f5c518;font-weight:700;">Pilih Jam</label>
                    <input type="time"
                           name="jam_booking"
                           id="jam_booking"
                           class="form-control"
                           required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label" style="color:#f5c518;font-weight:700;">Pilih Kursi</label>

                <div id="kursi-info" style="text-align:center;margin-bottom:12px;font-size:13px;color:rgba(255,255,255,0.4);display:none;">
                    <span style="display:inline-flex;align-items:center;gap:6px;margin-right:16px;">
                        <span style="width:14px;height:14px;background:rgba(239,68,68,0.5);border:1px solid #f87171;border-radius:3px;display:inline-block;"></span> Sudah dipesan
                    </span>
                    <span style="display:inline-flex;align-items:center;gap:6px;">
                        <span style="width:14px;height:14px;background:rgba(245,197,24,0.15);border:1px solid rgba(245,197,24,0.5);border-radius:3px;display:inline-block;"></span> Tersedia
                    </span>
                </div>

                <div class="mb-3 text-center">
                    <div style="background:#f5c518;color:#0a0a0f;padding:8px;border-radius:8px;font-weight:800;">
                        LAYAR BIOSKOP
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 justify-content-center" id="kursi-container">
                    @foreach($allKursi as $kursi)
                        <div>
                            <input type="checkbox"
                                   class="btn-check kursi-checkbox"
                                   name="kursi[]"
                                   id="kursi{{ $kursi }}"
                                   value="{{ $kursi }}">

                            <label class="btn btn-outline-warning"
                                   for="kursi{{ $kursi }}"
                                   id="label-kursi{{ $kursi }}"
                                   style="width:55px;">
                                {{ $kursi }}
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn-ticket">
                    Booking Sekarang
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const filmId = {{ $film->id }};
    const tanggalInput = document.getElementById('tanggal_booking');
    const jamInput = document.getElementById('jam_booking');
    const kursiInfo = document.getElementById('kursi-info');

    function cekKursiTerpakai() {
        const tanggal = tanggalInput.value;
        const jam = jamInput.value;

        // Reset semua kursi
        document.querySelectorAll('.kursi-checkbox').forEach(cb => {
            cb.disabled = false;
            cb.checked = false;
            const label = document.getElementById('label-' + cb.id);
            if (label) {
                label.style.opacity = '1';
                label.style.cursor = 'pointer';
                label.style.background = '';
                label.style.borderColor = '';
                label.style.color = '';
            }
        });

        if (!tanggal || !jam) {
            kursiInfo.style.display = 'none';
            return;
        }

        fetch(`/user/booking/kursi-terpakai/${filmId}?tanggal=${tanggal}&jam=${jam}`)
            .then(res => res.json())
            .then(kursiTerpakai => {
                kursiInfo.style.display = 'block';

                kursiTerpakai.forEach(nomor => {
                    const cb = document.getElementById('kursi' + nomor);
                    if (cb) {
                        cb.disabled = true;
                        cb.checked = false;
                        const label = document.getElementById('label-kursi' + nomor);
                        if (label) {
                            label.style.opacity = '0.5';
                            label.style.cursor = 'not-allowed';
                            label.style.background = 'rgba(239,68,68,0.2)';
                            label.style.borderColor = '#f87171';
                            label.style.color = '#f87171';
                        }
                    }
                });
            });
    }

    tanggalInput.addEventListener('change', cekKursiTerpakai);
    jamInput.addEventListener('change', cekKursiTerpakai);
</script>
@endsection