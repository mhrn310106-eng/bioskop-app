<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\{Film, Studio, Booking, Kursi, Jadwal};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingUserController extends Controller
{
    public function create($film_id)
    {
        $film = Film::findOrFail($film_id);
        $studios = Studio::all();

        $allKursi = [];
        foreach (range('A', 'F') as $baris) {
            foreach (range(1, 8) as $kolom) {
                $allKursi[] = $baris . $kolom;
            }
        }

        return view('user.booking.create', compact('film', 'studios', 'allKursi'));
    }

    public function kursiTerpakai(Request $request, $film_id)
    {
        $tanggal = $request->query('tanggal');
        $jam = $request->query('jam');

        if (!$tanggal || !$jam) {
            return response()->json([]);
        }

        $kursiTerpakai = Kursi::whereHas('booking', function ($q) use ($film_id, $tanggal, $jam) {
            $q->where('film_id', $film_id)
              ->whereDate('tanggal_booking', $tanggal)
              ->where('jam_booking', $jam)
              ->where('status', '!=', 'cancelled');
        })->pluck('nomor_kursi');

        return response()->json($kursiTerpakai);
    }

    public function store(Request $request, $film_id)
    {
        $film = Film::findOrFail($film_id);

        $request->validate([
            'tanggal_booking' => 'required|date|after_or_equal:today',
            'jam_booking' => 'required',
            'kursi' => 'required|array|min:1',
        ]);

        // Cari jadwal yang cocok berdasarkan film, tanggal, dan jam
        $jadwal = Jadwal::where('film_id', $film_id)
            ->whereDate('tanggal', $request->tanggal_booking)
            ->where('jam_tayang', $request->jam_booking)
            ->first();

        // Ambil studio dari jadwal, atau fallback ke studio pertama
        if ($jadwal) {
            $studio = Studio::find($jadwal->studio_id);
            $hargaTiket = $jadwal->harga;
        } else {
            $studio = Studio::first();
            $hargaTiket = 35000; // fallback default
        }

        if (!$studio) {
            return back()->with('error', 'Studio belum tersedia. Silakan hubungi admin.');
        }

        $sudahDiambil = Kursi::whereHas('booking', function ($q) use ($film_id, $request, $studio) {
            $q->where('film_id', $film_id)
              ->where('studio_id', $studio->id)
              ->whereDate('tanggal_booking', $request->tanggal_booking)
              ->where('jam_booking', $request->jam_booking)
              ->where('status', '!=', 'cancelled');
        })
        ->whereIn('nomor_kursi', $request->kursi)
        ->count();

        if ($sudahDiambil > 0) {
            return back()->with('error', 'Salah satu kursi sudah diambil pada tanggal dan jam tersebut. Silakan pilih kursi lain.');
        }

        $jumlah = count($request->kursi);
        $total = $jumlah * $hargaTiket;

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'film_id' => $film->id,
            'studio_id' => $studio->id,
            'tanggal_booking' => $request->tanggal_booking,
            'jam_booking' => $request->jam_booking,
            'jumlah_tiket' => $jumlah,
            'harga_tiket' => $hargaTiket,
            'total_harga' => $total,
            'status' => 'pending',
            'kode_booking' => 'BSK-' . strtoupper(Str::random(8)),
        ]);

        foreach ($request->kursi as $nomor) {
            Kursi::create([
                'booking_id' => $booking->id,
                'nomor_kursi' => $nomor,
            ]);
        }

        return redirect('/user/booking/detail/' . $booking->id)
            ->with('success', 'Booking berhasil dibuat!');
    }

    public function detail($id)
    {
        $booking = Booking::with(['film', 'studio', 'kursis', 'user'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.booking.detail', compact('booking'));
    }

    public function riwayat()
    {
        $bookings = Booking::with(['film', 'studio', 'kursis'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('user.booking.riwayat', compact('bookings'));
    }

    public function cancel($id)
    {
        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($booking->status === 'confirmed') {
            return back()->with('error', 'Booking yang sudah dikonfirmasi tidak bisa dibatalkan.');
        }

        $booking->update(['status' => 'cancelled']);

        return redirect('/user/riwayat')->with('success', 'Booking berhasil dibatalkan.');
    }

    public function bayar($id)
    {
        $booking = Booking::with(['film', 'studio', 'kursis'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($booking->status_bayar !== 'belum_bayar') {
            return redirect('/user/booking/detail/' . $id)
                ->with('error', 'Pembayaran sudah diproses.');
        }

        return view('user.booking.bayar', compact('booking'));
    }

    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'metode_bayar' => 'required',
            'bukti_bayar' => 'required|image|max:2048',
        ]);

        $booking = Booking::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        $booking->update([
            'metode_bayar' => $request->metode_bayar,
            'bukti_bayar' => $path,
            'status_bayar' => 'menunggu_verifikasi',
        ]);

        return redirect('/user/booking/detail/' . $id)
            ->with('success', 'Bukti pembayaran berhasil dikirim! Menunggu verifikasi admin.');
    }

    public function cetakPdf($id)
    {
        $booking = Booking::with(['film', 'studio', 'kursis', 'user'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $pdf = Pdf::loadView('user.booking.cetak', compact('booking'))
            ->setPaper('a5', 'portrait');

        return $pdf->download('tiket-' . $booking->kode_booking . '.pdf');
    }
}