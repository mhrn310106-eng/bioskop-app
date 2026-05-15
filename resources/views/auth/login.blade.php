<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — Bioskop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { background:#0a0a0f; color:#fff; font-family:'Segoe UI',sans-serif; min-height:100vh; display:flex; }

        .left-panel {
            width: 45%;
            background: linear-gradient(135deg, #0a0a0f 0%, #1a1a2e 100%);
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 60px;
            position: relative;
            overflow: hidden;
        }
        .left-panel::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://i.pinimg.com/736x/43/a5/b8/43a5b86f6c0c4ea40c9e0580381f3704.jpg') center/cover;
            opacity: 0.25;
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
        .left-title { font-size: 42px; font-weight: 900; line-height: 1.2; margin-bottom: 16px; }
        .left-desc { font-size: 14px; color: rgba(255,255,255,0.6); line-height: 1.7; }

        .right-panel {
            width: 55%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px;
            background: #0f0f18;
        }
        .form-box { width: 100%; max-width: 420px; }
        .form-title { font-size: 32px; font-weight: 800; margin-bottom: 8px; }
        .form-subtitle { font-size: 14px; color: rgba(255,255,255,0.5); margin-bottom: 40px; }
        .form-label-custom {
            font-size: 12px;
            font-weight: 700;
            color: #f5c518;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 8px;
            display: block;
        }
        .form-control-custom {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 14px 18px;
            color: #fff;
            font-size: 14px;
            width: 100%;
            transition: all 0.3s;
            outline: none;
        }
        .form-control-custom:focus {
            border-color: #f5c518;
            background: rgba(245,197,24,0.05);
        }
        .form-control-custom::placeholder { color: rgba(255,255,255,0.25); }
        .btn-submit {
            background: #f5c518;
            color: #0a0a0f;
            border: none;
            padding: 14px;
            border-radius: 12px;
            font-weight: 800;
            font-size: 15px;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 8px;
        }
        .btn-submit:hover { background: #e6b800; transform: translateY(-2px); }
        .divider { border-color: rgba(255,255,255,0.08); margin: 24px 0; }
        .link-custom { color: #f5c518; text-decoration: none; font-weight: 600; }
        .link-custom:hover { color: #e6b800; }
        .alert-error {
            background: rgba(239,68,68,0.1);
            border: 1px solid rgba(239,68,68,0.3);
            color: #f87171;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 20px;
        }
        .alert-success-box {
            background: rgba(34,197,94,0.1);
            border: 1px solid rgba(34,197,94,0.3);
            color: #4ade80;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="left-panel">
        <div class="left-panel-content">
            <span class="left-badge">✨ Exclusive Access</span>
            <h1 class="left-title">The Screen Is<br>Waiting For You</h1>
            <p class="left-desc">Pesan tiket bioskop favoritmu dengan mudah. Nikmati pengalaman menonton film terbaik bersama orang-orang tersayang.</p>
        </div>
    </div>

    <div class="right-panel">
        <div class="form-box">
            <h2 class="form-title">Selamat Datang</h2>
            <p class="form-subtitle">Masuk ke akun kamu untuk melanjutkan.</p>

            @if(session('success'))
                <div class="alert-success-box">✅ {{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert-error">❌ {{ $errors->first() }}</div>
            @endif

            <form action="/login" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label-custom">Email Address</label>
                    <input type="email" name="email" class="form-control-custom"
                        placeholder="contoh@email.com" required>
                </div>
                <div class="mb-4">
                    <label class="form-label-custom">Password</label>
                    <input type="password" name="password" class="form-control-custom"
                        placeholder="••••••••" required>
                </div>
                <button type="submit" class="btn-submit">Masuk ke Akun</button>
            </form>

            <hr class="divider">
            <p class="text-center" style="color:rgba(255,255,255,0.5);font-size:14px">
                Belum punya akun?
                <a href="/register" class="link-custom">Daftar di sini</a>
            </p>
        </div>
    </div>
</body>
</html>