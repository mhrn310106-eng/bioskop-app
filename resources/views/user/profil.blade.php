@extends('layouts.user')
@section('content')
<div class="container py-5">
    <div class="mb-4">
        <h2 class="section-title">👤 Profil Saya</h2>
        <p class="section-subtitle">Kelola informasi akun kamu</p>
    </div>

    <div class="row g-4" style="max-width:800px">
        <!-- INFO AKUN -->
        <div class="col-md-6">
            <div style="background:#16161f;border-radius:20px;padding:32px;border:1px solid rgba(255,255,255,0.06)">
                <h5 style="font-weight:800;margin-bottom:24px;color:#f5c518">📋 Informasi Akun</h5>
                @if(session('success'))
                    <div style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.3);color:#4ade80;border-radius:10px;padding:12px;font-size:13px;margin-bottom:20px">
                        ✅ {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.3);color:#f87171;border-radius:10px;padding:12px;font-size:13px;margin-bottom:20px">
                        ❌ {{ $errors->first() }}
                    </div>
                @endif
                <form action="/user/profil/update" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label style="font-size:12px;font-weight:700;color:#f5c518;letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:8px">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ $user->name }}"
                            style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:12px 16px;color:#fff;font-size:14px;width:100%;outline:none;transition:all 0.3s"
                            onfocus="this.style.borderColor='#f5c518'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'"
                            required>
                    </div>
                    <div class="mb-3">
                        <label style="font-size:12px;font-weight:700;color:#f5c518;letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:8px">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}"
                            style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:12px 16px;color:#fff;font-size:14px;width:100%;outline:none;transition:all 0.3s"
                            onfocus="this.style.borderColor='#f5c518'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'"
                            required>
                    </div>
                    <div class="mb-4">
                        <label style="font-size:12px;font-weight:700;color:#f5c518;letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:8px">No. Telepon</label>
                        <input type="text" name="no_telpon" value="{{ $user->no_telpon }}"
                            style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:12px 16px;color:#fff;font-size:14px;width:100%;outline:none;transition:all 0.3s"
                            onfocus="this.style.borderColor='#f5c518'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                    </div>
                    <button type="submit"
                        style="background:#f5c518;color:#0a0a0f;border:none;padding:12px;border-radius:10px;font-weight:800;font-size:14px;width:100%;cursor:pointer;transition:all 0.3s">
                        💾 Simpan Perubahan
                    </button>
                </form>
            </div>
        </div>

        <!-- GANTI PASSWORD -->
        <div class="col-md-6">
            <div style="background:#16161f;border-radius:20px;padding:32px;border:1px solid rgba(255,255,255,0.06)">
                <h5 style="font-weight:800;margin-bottom:24px;color:#f5c518">🔒 Ganti Password</h5>
                <form action="/user/profil/update-password" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label style="font-size:12px;font-weight:700;color:#f5c518;letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:8px">Password Baru</label>
                        <input type="password" name="password"
                            style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:12px 16px;color:#fff;font-size:14px;width:100%;outline:none;transition:all 0.3s"
                            onfocus="this.style.borderColor='#f5c518'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'"
                            placeholder="Minimal 6 karakter">
                    </div>
                    <div class="mb-4">
                        <label style="font-size:12px;font-weight:700;color:#f5c518;letter-spacing:1px;text-transform:uppercase;display:block;margin-bottom:8px">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                            style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:10px;padding:12px 16px;color:#fff;font-size:14px;width:100%;outline:none;transition:all 0.3s"
                            onfocus="this.style.borderColor='#f5c518'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'"
                            placeholder="Ulangi password baru">
                    </div>
                    <button type="submit"
                        style="background:rgba(245,197,24,0.15);color:#f5c518;border:1px solid rgba(245,197,24,0.3);padding:12px;border-radius:10px;font-weight:800;font-size:14px;width:100%;cursor:pointer;transition:all 0.3s">
                        🔒 Update Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection