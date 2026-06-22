<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Film, Booking, User, Jadwal};
use Carbon\Carbon;

class DashboardAdminController extends Controller {
    public function index() {
        $totalFilm       = Film::count();
        $totalBooking    = Booking::count();
        $totalUser       = User::where('role','user')->count();
        $pendapatanHariIni = Booking::whereDate('created_at', Carbon::today())
            ->where('status','confirmed')->sum('total_harga');
        $jadwalHariIni   = Jadwal::whereDate('tanggal', Carbon::today())->count();
        $bookingTerbaru  = Booking::with(['user','film'])->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalFilm','totalBooking','totalUser',
            'pendapatanHariIni','jadwalHariIni','bookingTerbaru'
        ));
    }
}
