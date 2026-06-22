<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tiket {{ $booking->kode_booking }}</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body {
            font-family: Arial, sans-serif;
            background: #fff;
            color: #1a1a1a;
            padding: 32px;
        }

        /* HEADER */
        .header {
            background: #1a237e;
            color: #fff;
            padding: 24px 32px;
            border-radius: 16px 16px 0 0;
            text-align: center;
            margin-bottom: 0;
        }
        .header h1 { font-size: 28px; font-weight: 900; letter-spacing: 2px; }
        .header h1 span { color: #f5c518; }
        .header p { font-size: 13px; opacity: 0.7; margin-top: 4px; }

        /* KODE BOOKING */
        .kode-box {
            background: #f5c518;
            color: #1a1a1a;
            text-align: center;
            padding: 16px;
            font-size: 22px;
            font-weight: 900;
            letter-spacing: 3px;
        }

        /* STATUS */
        .status-box {
            text-align: center;
            padding: 12px;
            font-size: 14px;
            font-weight: 700;
            background: #e8f5e9;
            color: #2e7d32;
            border-bottom: 2px dashed #ccc;
        }

        /* DETAIL */
        .detail-box {
            border: 1px solid #e0e0e0;
            border-top: none;
            border-radius: 0 0 16px 16px;
            padding: 24px 32px;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f5f5f5;
            font-size: 13px;
        }
        .detail-row:last-child { border-bottom: none; }
        .detail-label { color: #888; }
        .detail-value { font-weight: 700; text-align: right; max-width: 60%; }

        /* TOTAL */
        .total-box {
            background: #1a237e;
            color: #fff;
            padding: 16px 32px;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }
        .total-box .label { font-size: 14px; opacity: 0.8; }
        .total-box .amount { font-size: 24px; font-weight: 900; color: #f5c518; }

        /* FOOTER */
        .footer {
            text-align: center;
            margin-top: 24px;
            font-size: 11px;
            color: #aaa;
            line-height: 1.8;
        }

        /* DIVIDER DASHED */
        .dashed { border-top: 2px dashed #ddd; margin: 20px 0; }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <h1>ROYAL<span>THEATER</span></h1>
        <p>Tiket Bioskop Online</p>
    </div>

    <!-- KODE BOOKING -->
    <div class="kode-box">
        {{ $booking->kode_booking }}
    </div>

    <!-- STATUS -->
    <div class="status-box">
        Pembayaran Lunas — Booking Dikonfirmasi
    </div>

    <!-- DETAIL -->
    <div class="detail-box">
        <div class="detail-row">
            <span class="detail-label">Nama Pemesan : </span>
            <span class="detail-value">{{ $booking->user->name }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Film : </span>
            <span class="detail-value">{{ $booking->film->judul }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Genre : </span>
            <span class="detail-value">{{ $booking->film->genre }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Tanggal Tayang : </span>
            <span class="detail-value">{{ $booking->tanggal_booking }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Jam Tayang : </span>
            <span class="detail-value">{{ substr($booking->jam_booking, 0, 5) }} WIB</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Studio : </span>
            <span class="detail-value">{{ $booking->studio->nama ?? 'Studio Reguler' }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Nomor Kursi : </span>
            <span class="detail-value">{{ $booking->kursis->pluck('nomor_kursi')->join(', ') }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Jumlah Tiket : </span>
            <span class="detail-value">{{ $booking->jumlah_tiket }} tiket</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Metode Pembayaran : </span>
            <span class="detail-value">{{ strtoupper($booking->metode_bayar ?? '-') }}</span>
        </div>
        <div class="detail-row">
            <span class="detail-label">Tanggal Booking : </span>
            <span class="detail-value">{{ $booking->created_at->format('d M Y, H:i') }} WIB</span>
        </div>

        <!-- TOTAL -->
        <div class="total-box">
            <span class="label">Total Pembayaran </span>
            <span class="amount">Rp {{ number_format($booking->total_harga) }}</span>
        </div>
    </div>

    <div class="dashed"></div>

    <!-- FOOTER -->
    <div class="footer">
        <p>Tunjukkan tiket ini kepada petugas bioskop sebelum masuk.</p>
        <p>Tiket ini tidak dapat dipindahtangankan.</p>
        <p style="margin-top:8px;color:#1a237e;font-weight:700">
            © {{ date('Y') }} Royal Theater — Terima kasih telah memesan tiket bersama kami!
        </p>
    </div>

</body>
</html>

