<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register — Bioskop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { background:#0a0a0f; color:#fff; font-family:'Segoe UI',sans-serif; min-height:100vh; display:flex; }
        .left-panel {
            width: 45%;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 60px;
        }
        .left-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1517604931442-7e0c8ed2963c?w=800') center/cover;
            opacity: 0.3;
        }
        .left-panel::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, #0a0a0f 30%, transparent);
        }
        .left-panel-content { position: relative; z-index: 1; }
        .left-badge {
            display: inline-block;
            background: #f5c518;
            color: #0a0a0f;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 16px;
        }
        .left-title { font-size: 38px; font-weight: 900; line-height: 1.2; margin-bottom: 12px; }
        .left-desc { font-size: 14px; color: rgba(255,255,255,0.6); line-height: 1.7; }
        .right-panel {
            width: 55%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 60px;
            background: #0f0f18;
            overflow-y: auto;
        }
        .form-box { width: 100%; max-width: 440px; }
        .form-title { font-size: 30px; font-weight: 800; margin-bottom: 6px; }
        .form-subtitle { font-size: 14px; color: rgba(255,255,255,0.5); margin-bottom: 32px; }
        .form-label-custom {
            font-size: 12px; font-weight: 700; color: #f5c518;
            letter-spacing: 1px; text-transform: uppercase;
            margin-bottom: 8px; display: block;
        }
        .form-control-custom {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px; padding: 13px 18px;
            color: #fff; font-size: 14px; width: 100%;
            transition: all 0.3s; outline: none;
        }
        .form-control-custom:focus { border-color: #f5c518; background: rgba(245,197,24,0.05); }
        .form-control-custom::placeholder { color: rgba(255,255,255,0.25); }
        .btn-submit {
            background: #f5c518; color: #0a0a0f; border: none;
            padding: 14px; border-radius: 12px; font-weight: 800;
            font-size: 15px; width: 100%; cursor: pointer;
            transition: all 0.3s; margin-top: 8px;
        }
        .btn-submit:hover { background: #e6b800; transform: translateY(-2px); }
        .divider { border-color: rgba(255,255,255,0.08); margin: 20px 0; }
        .link-custom { color: #f5c518; text-decoration: none; font-weight: 600; }
        .link-custom:hover { color: #e6b800; }
        .alert-error {
            background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3);
            color: #f87171; border-radius: 12px; padding: 12px 16px;
            font-size: 13px; margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="left-panel">
        <div class="left-panel-content">
            <span class="left-badge">🎬 Bergabung Sekarang</span>
            <h1 class="left-title">Mulai Perjalanan<br>Sinematikmu</h1>
            <p class="left-desc">Daftar sekarang dan nikmati kemudahan memesan tiket bioskop kapan saja dan di mana saja.</p>
        </div>
    </div>

    <div class="right-panel">
        <div class="form-box">
            <h2 class="form-title">Buat Akun Baru</h2>
            <p class="form-subtitle">Isi data kamu untuk memulai.</p>

            @if($errors->any())
                <div class="alert-error">❌ {{ $errors->first() }}</div>
            @endif

            <form action="/register" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label-custom">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control-custom"
                        placeholder="Nama lengkap kamu" required>
                </div>
                <div class="mb-3">
                    <label class="form-label-custom">Email Address</label>
                    <input type="email" name="email" class="form-control-custom"
                        placeholder="contoh@email.com" required>
                </div>
                <div class="mb-3">
                    <label class="form-label-custom">No. Telepon</label>
                    <input type="text" name="no_telpon" class="form-control-custom"
                        placeholder="08xxxxxxxxxx">
                </div>
                <div class="mb-3">
                    <label class="form-label-custom">Password</label>
                    <input type="password" name="password" class="form-control-custom"
                        placeholder="Minimal 6 karakter" required>
                </div>
                <div class="mb-4">
                    <label class="form-label-custom">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control-custom"
                        placeholder="Ulangi password" required>
                </div>
                <button type="submit" class="btn-submit">🎬 Daftar Sekarang</button>
            </form>

            <hr class="divider">
            <p class="text-center" style="color:rgba(255,255,255,0.5);font-size:14px">
                Sudah punya akun?
                <a href="/login" class="link-custom">Masuk di sini</a>
            </p>
        </div>
    </div>
</body>
</html>