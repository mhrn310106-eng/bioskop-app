<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\{Film, Jadwal, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};

class DashboardUserController extends Controller {

    public function index() {
        $films = Film::where('status','tayang')->latest()->take(12)->get();
        return view('user.dashboard', compact('films'));
    }

    public function film() {
        $films = Film::where('status','tayang')->latest()->paginate(8);
        return view('user.film', compact('films'));
    }

    public function jadwal($film_id) {
    $film = Film::findOrFail($film_id);
    
    $tanggalTersedia = Jadwal::with('studio')
        ->where('film_id', $film_id)
        ->whereDate('tanggal', '>=', now())
        ->select('tanggal')
        ->distinct()
        ->orderBy('tanggal', 'asc')
        ->get();
    return view('user.jadwal', compact('film', 'tanggalTersedia'));
    }

    public function profil() {
        $user = Auth::user();
        return view('user.profil', compact('user'));
    }

    public function updateProfil(Request $request) {
        $user = Auth::user();
        $request->validate(['name'=>'required','email'=>'required|email|unique:users,email,'.$user->id]);
        $data = $request->only('name','email','no_telpon');
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);
        return back()->with('success','Profil diperbarui!');
    }

    public function updatePassword(Request $request) {
    $request->validate([
        'password' => 'required|min:6|confirmed',
    ]);

    Auth::user()->update([
        'password' => Hash::make($request->password),
    ]);

    return back()->with('success', 'Password berhasil diubah!');
    }

    
}
