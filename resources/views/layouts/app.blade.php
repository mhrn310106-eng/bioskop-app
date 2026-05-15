<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin — Bioskop</title>
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
        .nav-link-admin {
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
        .nav-link-admin:hover {
            background: rgba(245,197,24,0.08);
            color: #f5c518;
        }
        .nav-link-admin.active {
            background: rgba(245,197,24,0.12);
            color: #f5c518;
            font-weight: 700;
        }
        .nav-link-admin i { font-size: 18px; width: 20px; }

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

        /* CONTENT */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            padding: 32px;
            background: #0a0a0f;
        }

        /* CARD */
        .card-admin {
            background: #16161f;
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 16px;
            padding: 24px;
        }
        .card-admin-header {
            font-size: 16px;
            font-weight: 800;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(255,255,255,0.06);
        }

        /* TABLE */
        .table-admin {
    --bs-table-bg: transparent;
    --bs-table-striped-bg: transparent;
    --bs-table-hover-bg: rgba(255,255,255,0.02);
    color: #fff;
}
        .table-admin thead th {
            background: rgba(255,255,255,0.04);
            border-color: rgba(255,255,255,0.06);
            color: rgba(255,255,255,0.5);
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 14px 16px;
        }
        .table-admin tbody td {
            border-color: rgba(255,255,255,0.04);
            padding: 14px 16px;
            font-size: 14px;
            color: rgba(255,255,255,0.85);
            vertical-align: middle;
        }
        .table-admin tbody tr:hover td { background: rgba(255,255,255,0.02); }

        /* BUTTONS */
        .btn-admin-primary {
            background: #f5c518;
            color: #0a0a0f;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }
        .btn-admin-primary:hover { background: #e6b800; color: #0a0a0f; transform: translateY(-1px); }
        .btn-admin-warning {
            background: rgba(245,197,24,0.12);
            color: #f5c518;
            border: 1px solid rgba(245,197,24,0.3);
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }
        .btn-admin-warning:hover { background: rgba(245,197,24,0.2); color: #f5c518; }
        .btn-admin-danger {
            background: rgba(239,68,68,0.12);
            color: #f87171;
            border: 1px solid rgba(239,68,68,0.2);
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
            cursor: pointer;
        }
        .btn-admin-danger:hover { background: rgba(239,68,68,0.2); color: #f87171; }
        .btn-admin-success {
            background: rgba(34,197,94,0.12);
            color: #4ade80;
            border: 1px solid rgba(34,197,94,0.2);
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }
        .btn-admin-success:hover { background: rgba(34,197,94,0.2); color: #4ade80; }
        .btn-admin-info {
            background: rgba(99,179,237,0.12);
            color: #90cdf4;
            border: 1px solid rgba(99,179,237,0.2);
            padding: 6px 14px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 12px;
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }
        .btn-admin-info:hover { background: rgba(99,179,237,0.2); color: #90cdf4; }

        /* FORM */
        .form-label-admin {
            font-size: 12px;
            font-weight: 700;
            color: rgba(255,255,255,0.5);
            letter-spacing: 1px;
            text-transform: uppercase;
            display: block;
            margin-bottom: 8px;
        }
        .form-control-admin {
            background: rgba(255,255,255,0.04);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 10px;
            padding: 12px 16px;
            color: #fff;
            font-size: 14px;
            width: 100%;
            outline: none;
            transition: all 0.3s;
        }
        .form-control-admin:focus { border-color: #f5c518; background: rgba(245,197,24,0.04); }
        .form-control-admin option { background: #16161f; }

        /* BADGE */
        .badge-success { background: rgba(34,197,94,0.15); color: #4ade80; border: 1px solid rgba(34,197,94,0.3); padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .badge-warning { background: rgba(245,197,24,0.15); color: #f5c518; border: 1px solid rgba(245,197,24,0.3); padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .badge-danger  { background: rgba(239,68,68,0.15); color: #f87171; border: 1px solid rgba(239,68,68,0.3); padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; }
        .badge-info    { background: rgba(99,179,237,0.15); color: #90cdf4; border: 1px solid rgba(99,179,237,0.3); padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 700; }

        /* ALERT */
        .alert-success-admin { background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); color: #4ade80; border-radius: 12px; padding: 14px 18px; margin-bottom: 20px; font-size: 14px; }
        .alert-danger-admin  { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); color: #f87171; border-radius: 12px; padding: 14px 18px; margin-bottom: 20px; font-size: 14px; }

        /* PAGINATION */
        .pagination .page-link { background: #16161f; border: 1px solid rgba(255,255,255,0.08); color: rgba(255,255,255,0.6); border-radius: 8px; margin: 0 2px; font-size: 13px; }
        .pagination .page-item.active .page-link { background: #f5c518; border-color: #f5c518; color: #0a0a0f; font-weight: 700; }
        .pagination .page-link:hover { background: rgba(245,197,24,0.1); color: #f5c518; border-color: rgba(245,197,24,0.3); }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <div class="sidebar-brand">ROYAL<span>THEATER</span><br>
        <span style="font-size:11px;font-weight:400;color:rgba(255,255,255,0.3)">Admin Panel</span>
    </div>

    <div class="sidebar-label">Menu Utama</div>
    <a href="/admin/dashboard" class="nav-link-admin {{ request()->is('admin/dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> Dashboard
    </a>
    <a href="/admin/film" class="nav-link-admin {{ request()->is('admin/film*') ? 'active' : '' }}">
        <i class="bi bi-film"></i> Film
    </a>
    <a href="/admin/studio" class="nav-link-admin {{ request()->is('admin/studio*') ? 'active' : '' }}">
        <i class="bi bi-building"></i> Studio
    </a>
    <a href="/admin/jadwal" class="nav-link-admin {{ request()->is('admin/jadwal*') ? 'active' : '' }}">
        <i class="bi bi-calendar3"></i> Jadwal
    </a>
    <a href="/admin/booking" class="nav-link-admin {{ request()->is('admin/booking*') ? 'active' : '' }}">
        <i class="bi bi-ticket-perforated"></i> Laporan Booking
    </a>

    <div class="sidebar-label mt-3">Manajemen</div>
    <a href="/admin/users" class="nav-link-admin {{ request()->is('admin/users*') ? 'active' : '' }}">
        <i class="bi bi-people-fill"></i> Pengguna
    </a>

    <div class="user-box mt-3">
        <div class="d-flex align-items-center gap-2 mb-2">
            <div style="width:36px;height:36px;background:rgba(245,197,24,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center">
                <i class="bi bi-person-fill" style="color:#f5c518"></i>
            </div>
            <div>
                <div class="user-box-name">{{ auth()->user()->name }}</div>
                <div class="user-box-role">Administrator</div>
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
        <div class="alert-success-admin">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert-danger-admin">❌ {{ session('error') }}</div>
    @endif
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>