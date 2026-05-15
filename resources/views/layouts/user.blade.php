<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Royal Theater</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; }
        body { background:#0a0a0f; color:#fff; font-family:'Segoe UI',sans-serif; }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #0f0f18;
            border-right: 1px solid rgba(255,255,255,0.06);
            padding: 24px 16px;
            position: fixed;
            top: 0; left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }
        .sidebar-brand {
            font-size: 22px;
            font-weight: 900;
            color: #fff;
            text-align: center;
            padding: 16px 0 24px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
            margin-bottom: 24px;
            letter-spacing: 1px;
            text-decoration: none;
            display: block;
        }
        .sidebar-brand span { color: #f5c518; }
        .sidebar-label {
            font-size: 10px;
            font-weight: 700;
            color: rgba(255,255,255,0.25);
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 0 12px;
            margin-bottom: 8px;
        }
        .nav-link-user {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            border-radius: 10px;
            color: rgba(255,255,255,0.6);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s;
            margin-bottom: 4px;
        }
        .nav-link-user:hover {
            background: rgba(245,197,24,0.08);
            color: #f5c518;
        }
        .nav-link-user.active {
            background: rgba(245,197,24,0.12);
            color: #f5c518;
            font-weight: 700;
        }
        .nav-link-user i { font-size: 18px; width: 20px; }

        /* USER BOX */
        .user-box {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 12px;
            padding: 16px;
            margin-top: auto;
        }
        .user-box-name { font-size: 14px; font-weight: 700; margin-bottom: 2px; }
        .user-box-role { font-size: 12px; color: #f5c518; font-weight: 600; }
        .btn-logout {
            background: rgba(239,68,68,0.12);
            color: #f87171;
            border: 1px solid rgba(239,68,68,0.2);
            padding: 10px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 13px;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 12px;
        }
        .btn-logout:hover { background: rgba(239,68,68,0.2); }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            background: #0a0a0f;
        }

        /* FILM CARD */
        .film-card {
            background: #16161f;
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
            border: 1px solid rgba(255,255,255,0.06);
        }
        .film-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        }
        .film-card img { width:100%; height:280px; object-fit:cover; }
        .film-card-body { padding: 14px; }
        .film-card-title { font-size:15px; font-weight:700; color:#fff; margin-bottom:4px; }
        .film-card-meta { font-size:12px; color:rgba(255,255,255,0.5); }
        .badge-genre {
            background: rgba(245,197,24,0.15);
            color: #f5c518;
            border: 1px solid rgba(245,197,24,0.3);
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
        .btn-ticket {
            background: #f5c518;
            color: #0a0a0f;
            border: none;
            padding: 8px 0;
            border-radius: 8px;
            font-weight: 700;
            font-size: 13px;
            width: 100%;
            text-decoration: none;
            display: block;
            text-align: center;
            transition: all 0.3s;
            margin-top: 10px;
        }
        .btn-ticket:hover { background: #e6b800; color: #0a0a0f; }

        /* SECTION */
        .section-title { font-size:22px; font-weight:800; color:#fff; margin-bottom:4px; }
        .section-subtitle { font-size:13px; color:rgba(255,255,255,0.45); }

        /* ALERT */
        .alert-custom-success {
            background: rgba(34,197,94,0.15);
            border: 1px solid rgba(34,197,94,0.3);
            color: #4ade80;
            border-radius: 12px;
            padding: 12px 20px;
            margin-bottom: 16px;
        }
        .alert-custom-danger {
            background: rgba(239,68,68,0.15);
            border: 1px solid rgba(239,68,68,0.3);
            color: #f87171;
            border-radius: 12px;
            padding: 12px 20px;
            margin-bottom: 16px;
        }

        /* PAGINATION */
        .pagination .page-link {
            background: #16161f;
            border: 1px solid rgba(255,255,255,0.1);
            color: rgba(255,255,255,0.7);
            border-radius: 8px;
            margin: 0 2px;
            font-size: 13px;
        }
        .pagination .page-item.active .page-link {
            background: #f5c518;
            border-color: #f5c518;
            color: #0a0a0f;
            font-weight: 700;
        }
        .pagination .page-link:hover {
            background: rgba(245,197,24,0.15);
            color: #f5c518;
        }

        /* FOOTER */
        .footer-custom {
            background: #0d0d14;
            border-top: 1px solid rgba(255,255,255,0.06);
            padding: 32px;
            margin-top: 60px;
        }
        .footer-text { color:rgba(255,255,255,0.4); font-size:13px; }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <a href="/user/dashboard" class="sidebar-brand">
        ROYAL<span>THEATER</span><br>
        <span style="font-size:11px;font-weight:400;color:rgba(255,255,255,0.3)">Member Area</span>
    </a>

    <div class="sidebar-label">Menu</div>
    <a href="/user/dashboard" class="nav-link-user {{ request()->is('user/dashboard') ? 'active' : '' }}">
        <i class="bi bi-house-fill"></i> Beranda
    </a>
    <a href="/user/film" class="nav-link-user {{ request()->is('user/film') ? 'active' : '' }}">
        <i class="bi bi-film"></i> Film
    </a>
    <a href="/user/riwayat" class="nav-link-user {{ request()->is('user/riwayat') ? 'active' : '' }}">
        <i class="bi bi-clock-history"></i> Riwayat Booking
    </a>

    <div class="sidebar-label mt-3">Akun</div>
    <a href="/user/profil" class="nav-link-user {{ request()->is('user/profil') ? 'active' : '' }}">
        <i class="bi bi-person-fill"></i> Profil Saya
    </a>

    <div class="user-box mt-3">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div style="width:36px;height:36px;background:rgba(245,197,24,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center">
                <i class="bi bi-person-fill" style="color:#f5c518"></i>
            </div>
            <div>
                <div class="user-box-name">{{ auth()->user()->name }}</div>
                <div class="user-box-role">Member</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn-logout">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="main-content">
    @if(session('success'))
        <div style="padding:24px 32px 0">
            <div class="alert-custom-success">✅ {{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div style="padding:24px 32px 0">
            <div class="alert-custom-danger">❌ {{ session('error') }}</div>
        </div>
    @endif

    @yield('content')

    <!-- FOOTER -->
    <footer class="footer-custom">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div style="font-size:18px;font-weight:900;color:#fff;margin-bottom:4px">
                    ROYAL<span style="color:#f5c518">THEATER</span>
                </div>
                <p class="footer-text mb-0">Nikmati pengalaman menonton film terbaik.</p>
            </div>
            <p class="footer-text mb-0">© 2025 Royal Theater. All rights reserved.</p>
        </div>
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>