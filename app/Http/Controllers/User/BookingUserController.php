<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\{Jadwal, Booking, Kursi};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingUserController extends Controller {

    // Tampilkan form booking + kursi tersedia
    public function create($jadwal_id) {
        $jadwal = Jadwal::with(['film','studio'])->findOrFail($jadwal_id);
        $kursiBooked = Kursi::where('jadwal_id', $jadwal_id)->pluck('nomor_kursi')->toArray();

        // Generate semua kursi (baris A-F, kolom 1-8 = 48 kursi)
        $allKursi = [];
        foreach (range('A','F') as $baris) {
            foreach (range(1,8) as $kolom) {
                $allKursi[] = $baris.$kolom;
            }
        }
        return view('user.booking.create', compact('jadwal','kursiBooked','allKursi'));
    }

    // Simpan booking
    public function store(Request $request, $jadwal_id) {
        $jadwal = Jadwal::findOrFail($jadwal_id);
        $request->validate([
            'kursi' => 'required|array|min:1',
        ]);

        // Cek kursi sudah diambil orang lain
        $sudahDiambil = Kursi::where('jadwal_id', $jadwal_id)
            ->whereIn('nomor_kursi', $request->kursi)->count();
        if ($sudahDiambil > 0) {
            return back()->with('error','Salah satu kursi sudah diambil, silakan pilih ulang.');
        }

        $jumlah = count($request->kursi);
        $total  = $jumlah * $jadwal->harga;

        $booking = Booking::create([
            'user_id'      => Auth::id(),
            'jadwal_id'    => $jadwal_id,
            'jumlah_tiket' => $jumlah,
            'total_harga'  => $total,
            'status'       => 'pending',
            'kode_booking' => 'BSK-'.strtoupper(Str::random(8)),
        ]);

        foreach ($request->kursi as $nomor) {
            Kursi::create([
                'booking_id'   => $booking->id,
                'jadwal_id'    => $jadwal_id,
                'nomor_kursi'  => $nomor,
            ]);
        }

        return redirect('/user/booking/detail/'.$booking->id)->with('success','Booking berhasil dibuat!');
    }

    public function detail($id) {
        $booking = Booking::with(['jadwal.film','jadwal.studio','kursis','user'])->findOrFail($id);
        return view('user.booking.detail', compact('booking'));
    }

    public function cancel($id) {
        $booking = Booking::where('id',$id)->where('user_id',Auth::id())->firstOrFail();
        if ($booking->status === 'confirmed') {
            return back()->with('error','Booking yang sudah dikonfirmasi tidak bisa dibatalkan.');
        }
        $booking->update(['status'=>'cancelled']);
        return redirect('/user/riwayat')->with('success','Booking berhasil dibatalkan.');
    }

    public function riwayat() {
        $bookings = Booking::with(['jadwal.film'])->where('user_id',Auth::id())->latest()->paginate(10);
        return view('user.booking.riwayat', compact('bookings'));
    }

    // Tampilkan halaman pembayaran
public function bayar($id) {
    $booking = Booking::with(['jadwal.film','jadwal.studio','kursis'])
                ->where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

    if ($booking->status_bayar !== 'belum_bayar') {
        return redirect('/user/booking/detail/'.$id)
            ->with('error','Pembayaran sudah diproses.');
    }

    return view('user.booking.bayar', compact('booking'));
}

// Upload bukti pembayaran
public function uploadBukti(Request $request, $id) {
    $request->validate([
        'metode_bayar' => 'required',
        'bukti_bayar'  => 'required|image|max:2048',
    ]);

    $booking = Booking::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

    $path = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

    $booking->update([
        'metode_bayar' => $request->metode_bayar,
        'bukti_bayar'  => $path,
        'status_bayar' => 'menunggu_verifikasi',
    ]);

    return redirect('/user/booking/detail/'.$id)
        ->with('success','Bukti pembayaran berhasil dikirim! Menunggu verifikasi admin.');
}

//cetakbooking
public function cetakPdf($id) {
    $booking = Booking::with(['jadwal.film','jadwal.studio','kursis','user'])
                ->where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

    $pdf = Pdf::loadView('user.booking.cetak', compact('booking'))
              ->setPaper('a5', 'portrait');
    return $pdf->download('tiket-'.$booking->kode_booking.'.pdf');
}

}
