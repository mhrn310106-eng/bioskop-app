<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Booking</title>
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { font-family: Arial, sans-serif; font-size: 11px; color: #1a1a1a; padding: 24px; }

        .header { text-align:center; margin-bottom:24px; }
        .header h1 { font-size:22px; font-weight:900; color:#1a237e; }
        .header h1 span { color:#f5c518; }
        .header p { font-size:11px; color:#888; margin-top:4px; }
        .header .tanggal { font-size:11px; color:#555; margin-top:2px; }

        table { width:100%; border-collapse:collapse; margin-top:16px; }
        thead th {
            background: #1a237e;
            color: #fff;
            padding: 8px 6px;
            text-align: left;
            font-size: 10px;
            font-weight: 700;
        }
        tbody td {
            padding: 7px 6px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 10px;
            vertical-align: middle;
        }
        tbody tr:nth-child(even) td { background: #f9f9f9; }
        tbody tr:last-child td { border-bottom: none; }

        .badge {
            padding: 2px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: 700;
        }
        .badge-confirmed { background:#e8f5e9; color:#2e7d32; }
        .badge-pending   { background:#fff8e1; color:#f57f17; }
        .badge-cancelled { background:#ffebee; color:#c62828; }
        .badge-lunas     { background:#e8f5e9; color:#2e7d32; }
        .badge-menunggu  { background:#fff8e1; color:#f57f17; }
        .badge-belum     { background:#ffebee; color:#c62828; }

        .summary {
            margin-top: 24px;
            display: flex;
            gap: 16px;
        }
        .summary-box {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 12px 20px;
            text-align: center;
            flex: 1;
        }
        .summary-label { font-size: 10px; color: #888; margin-bottom: 4px; }
        .summary-value { font-size: 16px; font-weight: 900; color: #1a237e; }

        .footer {
            margin-top: 32px;
            text-align: center;
            font-size: 10px;
            color: #aaa;
            border-top: 1px solid #eee;
            padding-top: 12px;
        }
    </style>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <h1>ROYAL<span>THEATER</span></h1>
        <p>Laporan Data Booking</p>
        <p class="tanggal">Dicetak pada: {{ date('d M Y, H:i') }} WIB</p>
    </div>

    <!-- SUMMARY -->
    <div class="summary">
        <div class="summary-box">
            <div class="summary-label">Total Booking</div>
            <div class="summary-value">{{ $bookings->count() }}</div>
        </div>
        <div class="summary-box">
            <div class="summary-label">Total Confirmed</div>
            <div class="summary-value">{{ $bookings->where('status','confirmed')->count() }}</div>
        </div>
        <div class="summary-box">
            <div class="summary-label">Total Pending</div>
            <div class="summary-value">{{ $bookings->where('status','pending')->count() }}</div>
        </div>
        <div class="summary-box">
            <div class="summary-label">Total Pendapatan</div>
            <div class="summary-value" style="font-size:12px">
                Rp {{ number_format($bookings->where('status_bayar','lunas')->sum('total_harga')) }}
            </div>
        </div>
    </div>

    <!-- TABLE -->
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Booking</th>
                <th>Pengguna</th>
                <th>Film</th>
                <th>Tanggal</th>
                <th>Kursi</th>
                <th>Total</th>
                <th>Metode</th>
                <th>Status Bayar</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $b)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="font-weight:700;color:#1a237e">{{ $b->kode_booking }}</td>
                <td>{{ $b->user->name }}</td>
                <td>{{ $b->jadwal->film->judul }}</td>
                <td>{{ $b->jadwal->tanggal }}</td>
                <td>{{ $b->kursis->pluck('nomor_kursi')->join(', ') }}</td>
                <td style="font-weight:700">Rp {{ number_format($b->total_harga) }}</td>
                <td>{{ strtoupper($b->metode_bayar ?? '-') }}</td>
                <td>
                    @if($b->status_bayar=='lunas')
                        <span class="badge badge-lunas">Lunas</span>
                    @elseif($b->status_bayar=='menunggu_verifikasi')
                        <span class="badge badge-menunggu">Menunggu</span>
                    @else
                        <span class="badge badge-belum">Belum Bayar</span>
                    @endif
                </td>
                <td>
                    @if($b->status=='confirmed')
                        <span class="badge badge-confirmed">Confirmed</span>
                    @elseif($b->status=='pending')
                        <span class="badge badge-pending">Pending</span>
                    @else
                        <span class="badge badge-cancelled">Cancelled</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="footer">
        © {{ date('Y') }} Royal Theater — Laporan ini digenerate otomatis oleh sistem.
    </div>

</body>
</html>