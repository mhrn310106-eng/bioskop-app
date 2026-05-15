<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Exports\BookingExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class BookingAdminController extends Controller {

    public function index(Request $request) {
    $query = Booking::with(['user','jadwal.film','jadwal.studio']);

    // Filter tanggal
    if ($request->filled('tanggal')) {
        $query->whereHas('jadwal', function($q) use ($request) {
            $q->whereDate('tanggal', $request->tanggal);
        });
    }

    // Filter status bayar
    if ($request->filled('status_bayar')) {
        $query->where('status_bayar', $request->status_bayar);
    }

    // Filter status booking
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $bookings = $query->latest()->paginate(10);
    return view('admin.booking.index', compact('bookings'));
}

    public function confirm($id) {
        Booking::findOrFail($id)->update(['status' => 'confirmed']);
        return redirect('/admin/booking')->with('success','Booking dikonfirmasi!');
    }

    public function cancel($id) {
        Booking::findOrFail($id)->update(['status' => 'cancelled']);
        return redirect('/admin/booking')->with('success','Booking dibatalkan!');
    }

    public function hapus($id) {
        Booking::destroy($id);
        return redirect('/admin/booking')->with('success','Booking dihapus!');
    }

    public function verifikasi($id) {
        Booking::findOrFail($id)->update([
            'status_bayar' => 'lunas',
            'status'       => 'confirmed',
        ]);
        return redirect('/admin/booking')
            ->with('success','Pembayaran diverifikasi, booking dikonfirmasi!');
    }

    // Export Excel
    public function exportExcel() {
        return Excel::download(new BookingExport, 'laporan-booking-'.date('d-m-Y').'.xlsx');
    }

    // Export PDF
    public function exportPdf() {
        $bookings = Booking::with(['user','jadwal.film','jadwal.studio','kursis'])
                    ->latest()->get();
        $pdf = Pdf::loadView('admin.booking.pdf', compact('bookings'))
                  ->setPaper('a4', 'landscape');
        return $pdf->download('laporan-booking-'.date('d-m-Y').'.pdf');
    }
}