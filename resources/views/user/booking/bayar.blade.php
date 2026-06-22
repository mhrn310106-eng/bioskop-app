@extends('layouts.user')
@section('content')
<div style="padding:32px">
    <div class="mb-4">
        <h2 style="font-size:26px;font-weight:900;margin-bottom:4px">💳 Pembayaran</h2>
        <p style="color:rgba(255,255,255,0.4);font-size:14px">Selesaikan pembayaran untuk konfirmasi booking kamu</p>
    </div>

    <div class="row g-4" style="max-width:900px">

        <!-- DETAIL BOOKING -->
        <div class="col-md-5">
            <div style="background:#16161f;border:1px solid rgba(255,255,255,0.06);border-radius:20px;padding:24px">
                <h5 style="font-weight:800;color:#f5c518;margin-bottom:20px">🎫 Detail Booking</h5>
                <div style="display:flex;flex-direction:column;gap:12px">
                    @foreach([
                        ['Film', $booking->film->judul],
                    ['Tanggal', $booking->tanggal_booking],
                    ['Jam', substr($booking->jam_booking, 0, 5)],
                    ['Studio', $booking->studio->nama ?? 'Studio Reguler'],
                        ['Kursi', $booking->kursis->pluck('nomor_kursi')->join(', ')],
                        ['Jumlah Tiket', $booking->jumlah_tiket.' tiket'],
                    ] as $row)
                    <div style="display:flex;justify-content:space-between;padding-bottom:12px;border-bottom:1px solid rgba(255,255,255,0.04)">
                        <span style="color:rgba(255,255,255,0.4);font-size:13px">{{ $row[0] }}</span>
                        <span style="font-weight:600;font-size:13px;text-align:right;max-width:55%">{{ $row[1] }}</span>
                    </div>
                    @endforeach
                    <div style="display:flex;justify-content:space-between;margin-top:4px">
                        <span style="font-size:16px;font-weight:700">Total Bayar</span>
                        <span style="font-size:22px;font-weight:900;color:#f5c518">
                            Rp {{ number_format($booking->total_harga) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- FORM PEMBAYARAN -->
        <div class="col-md-7">
            <div style="background:#16161f;border:1px solid rgba(255,255,255,0.06);border-radius:20px;padding:24px">
                <h5 style="font-weight:800;color:#f5c518;margin-bottom:20px">💰 Pilih Metode Pembayaran</h5>

                @if($errors->any())
                    <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:#f87171;border-radius:10px;padding:12px;margin-bottom:16px;font-size:13px">
                        ❌ {{ $errors->first() }}
                    </div>
                @endif

                <form action="/user/booking/bayar/{{ $booking->id }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- PILIH METODE -->
                <div class="mb-4">
                    <label style="font-size:12px;font-weight:700;color:rgba(255,255,255,0.5);letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:12px">
                        Metode Pembayaran
                    </label>
                    <div class="d-flex flex-wrap gap-2">
                        @foreach([
                            ['bca', 'BCA Transfer', '🏦'],
                            ['mandiri', 'Mandiri Transfer', '🏦'],
                            ['bni', 'BNI Transfer', '🏦'],
                            ['bri', 'BRI Transfer', '🏦'],
                            ['gopay', 'GoPay', '💚'],
                            ['ovo', 'OVO', '💜'],
                            ['dana', 'DANA', '💙'],
                            ['qris', 'QRIS', '📱'],
                        ] as $m)
                        <div>
                            <input type="radio" name="metode_bayar" value="{{ $m[0] }}"
                                id="m{{ $m[0] }}" class="d-none metode-radio">
                            <label for="m{{ $m[0] }}"
                                style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:10px 16px;cursor:pointer;font-size:13px;font-weight:600;transition:all 0.3s;display:block;color:rgba(255,255,255,0.7)"
                                class="metode-label">
                                {{ $m[2] }} {{ $m[1] }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- INFO REKENING -->
                <div id="info-rekening" style="background:rgba(245,197,24,0.06);border:1px solid rgba(245,197,24,0.2);border-radius:12px;padding:20px;margin-bottom:20px;display:none">
                    <p style="font-size:13px;font-weight:700;color:#f5c518;margin-bottom:12px">📋 Informasi Transfer</p>
                    <div id="rekening-detail" style="font-size:13px;color:rgba(255,255,255,0.7);line-height:2">
                    </div>
                    <div style="margin-top:12px;padding:12px;background:rgba(255,255,255,0.04);border-radius:8px;text-align:center">
                        <p style="font-size:12px;color:rgba(255,255,255,0.4);margin-bottom:4px">Total Transfer</p>
                        <p style="font-size:20px;font-weight:900;color:#f5c518;margin:0">
                            Rp {{ number_format($booking->total_harga) }}
                        </p>
                    </div>
                </div>

                <!-- UPLOAD BUKTI -->
                <div class="mb-4">
                    <label style="font-size:12px;font-weight:700;color:rgba(255,255,255,0.5);letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:8px">
                        Upload Bukti Pembayaran
                    </label>
                    <input type="file" name="bukti_bayar" accept="image/*"
                        style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:10px;padding:12px 16px;color:#fff;font-size:14px;width:100%;outline:none"
                        required>
                    <p style="font-size:11px;color:rgba(255,255,255,0.3);margin-top:6px">
                        Format: JPG, PNG, JPEG. Maks 2MB
                    </p>
                </div>

                <button type="submit"
                    style="background:#f5c518;color:#0a0a0f;border:none;padding:14px;border-radius:12px;font-weight:800;font-size:15px;width:100%;cursor:pointer;transition:all 0.3s">
                    📤 Kirim Bukti Pembayaran
                </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
const rekeningInfo = {
    bca:     'Bank: BCA\nNo. Rekening: 1234567890\nAtas Nama: Bioskop Online',
    mandiri: 'Bank: Mandiri\nNo. Rekening: 0987654321\nAtas Nama: Bioskop Online',
    bni:     'Bank: BNI\nNo. Rekening: 1122334455\nAtas Nama: Bioskop Online',
    bri:     'Bank: BRI\nNo. Rekening: 5544332211\nAtas Nama: Bioskop Online',
    gopay:   'GoPay: 0812-3456-7890\nAtas Nama: Bioskop Online',
    ovo:     'OVO: 0812-3456-7890\nAtas Nama: Bioskop Online',
    dana:    'DANA: 0812-3456-7890\nAtas Nama: Bioskop Online',
    qris:    'Scan QRIS di bawah ini:\n(Tunjukkan ke kasir atau scan langsung)',
};

document.querySelectorAll('.metode-radio').forEach(radio => {
    radio.addEventListener('change', function() {
        // Reset semua label
        document.querySelectorAll('.metode-label').forEach(lbl => {
            lbl.style.background = 'rgba(255,255,255,0.04)';
            lbl.style.borderColor = 'rgba(255,255,255,0.1)';
            lbl.style.color = 'rgba(255,255,255,0.7)';
        });

        // Highlight yang dipilih
        const lbl = document.querySelector('label[for="m'+this.value+'"]');
        lbl.style.background = 'rgba(245,197,24,0.12)';
        lbl.style.borderColor = '#f5c518';
        lbl.style.color = '#f5c518';

        // Tampilkan info rekening
        const info = document.getElementById('info-rekening');
        const detail = document.getElementById('rekening-detail');
        info.style.display = 'block';
        detail.innerHTML = rekeningInfo[this.value].replace(/\n/g, '<br>');
    });
});
</script>
@endsection