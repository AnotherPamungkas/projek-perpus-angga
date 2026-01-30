<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Modern UI</title>
    <style>
        /* --- Reset & Base Variables --- */
        :root {
            --bg-body: #f8fafc;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --card-bg: #ffffff;
            --accent-blue: #3b82f6;
            --accent-purple: #8b5cf6;
            --accent-emerald: #10b981;
            --danger-color: #ef4444;
            --danger-bg: #fef2f2;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: var(--font-family);
            background-color: var(--bg-body);
            color: var(--text-primary);
            background-image: radial-gradient(at 0% 0%, hsla(253,16%,7%,0) 0, hsla(253,16%,7%,0) 50%), radial-gradient(at 50% 0%, hsla(225,39%,30%,0.1) 0, hsla(225,39%,30%,0) 50%), radial-gradient(at 100% 0%, hsla(339,49%,30%,0.1) 0, hsla(339,49%,30%,0) 50%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* --- Navbar --- */
.app-navbar {
    background-color: var(--card-bg);
    border-bottom: 1px solid #e2e8f0;
}

.navbar-content {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 1.5rem;
    display: flex;
    gap: 1rem;
}

.nav-link {
    position: relative;
    padding: 0.9rem 0.75rem;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.95rem;
    color: var(--text-secondary);
    transition: color 0.2s ease;
}

.nav-link:hover {
    color: var(--accent-blue);
}

/* Active state */
.nav-link.active {
    color: var(--accent-blue);
    font-weight: 600;
}

.nav-link.active::after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 3px;
    background-color: var(--accent-blue);
    border-radius: 2px 2px 0 0;
}


        /* --- Layout --- */
        .app-layout {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* --- Header Section --- */
        .app-header {
            background-color: var(--card-bg);
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 0; /* Sedikit lebih kecil paddingnya */
            box-shadow: var(--shadow-sm);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .header-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        /* --- Header Actions (User & Logout) --- */
        .header-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--text-secondary);
            font-size: 0.875rem;
            border: 2px solid white;
            box-shadow: 0 0 0 2px #e2e8f0;
            cursor: pointer;
            transition: transform 0.2s;
        }
        
        .user-avatar:hover {
            transform: scale(1.05);
        }

        /* Styling Tombol Logout */
        .btn-logout {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background-color: transparent;
        }

        .btn-logout svg {
            width: 18px;
            height: 18px;
            transition: transform 0.2s;
        }

        /* Efek Hover Logout: Berubah jadi merah muda */
        .btn-logout:hover {
            background-color: var(--danger-bg);
            color: var(--danger-color);
        }

        .btn-logout:hover svg {
            transform: translateX(3px); /* Ikon bergerak sedikit ke kanan */
        }

        /* --- Main Content --- */
        .main-content {
            flex: 1;
            padding: 3rem 0;
        }

        .container {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        /* --- Stats Grid --- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr);
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); }
        }
        @media (min-width: 1024px) {
            .stats-grid { grid-template-columns: repeat(3, 1fr); }
        }

        /* --- Cards --- */
        .stat-card {
            background-color: var(--card-bg);
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: var(--shadow-md);
            border: 1px solid #f1f5f9;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            animation: slideUpFade 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
            border-color: transparent;
        }

        .icon-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
        }

        .icon-wrapper svg { width: 24px; height: 24px; stroke-width: 2; }

        /* Specific Themes */
        .card-blue .icon-wrapper { background-color: #eff6ff; color: var(--accent-blue); }
        .card-blue:hover { border-top: 4px solid var(--accent-blue); }

        .card-purple .icon-wrapper { background-color: #f5f3ff; color: var(--accent-purple); }
        .card-purple:hover { border-top: 4px solid var(--accent-purple); }

        .card-emerald .icon-wrapper { background-color: #ecfdf5; color: var(--accent-emerald); }
        .card-emerald:hover { border-top: 4px solid var(--accent-emerald); }

        .stat-label {
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-value {
            font-size: 2.25rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1.2;
        }

        /* Decoration circle */
        .stat-card::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, rgba(0,0,0,0.03) 0%, rgba(0,0,0,0) 70%);
            top: -50px;
            right: -50px;
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }

        @keyframes slideUpFade {
            to { opacity: 1; transform: translateY(0); }
        }

        .spacer { flex: 1; }
        
        /* Responsive Text Hide for Mobile Logout */
        @media (max-width: 640px) {
            .btn-logout span { display: none; }
            .btn-logout { padding: 0.5rem; }
        }
    </style>
</head>
<body>

    <div class="app-layout">
        <!-- Header Section -->
        <header class="app-header">
            <div class="header-content">
                <!-- Title -->
                <h2 class="header-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--accent-blue);">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    Admin
                </h2>

                <!-- Header Actions: Avatar & Logout -->
                <div class="header-actions">
                    <!-- Tombol Logout -->
                    <!-- Ganti href="/logout" dengan route logout Laravel yang sebenarnya -->
                    <a href="/logout" class="btn-logout" title="Keluar">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span>Logout</span>
                    </a>

                    <!-- Avatar User -->
                    <div class="user-avatar" title="Admin User">
                        AD
                    </div>
                </div>
            </div>
        </header>

        <!-- Navbar -->
<nav class="app-navbar">
    <div class="navbar-content">
        <a href="" class="nav-link active">Dashboard</a>
        <a href="{{ route('admin.data-petugas.index') }}" class="nav-link">Data Petugas</a>
        <a href="{{ route('admin.data-kategori.index')}}" class="nav-link">Data Kategori</a>
        <a href="{{ route('admin.data-buku.index')}}" class="nav-link">Data Buku</a>
        <a href="{{ route('admin.verifikasi-buku.index')}}" class="nav-link">Verifikasi Data Buku</a>
        <a href="{{ route('admin.riwayat-peminjaman.index')}}" class="nav-link">Riwayat Peminjaman</a>
    </div>
</nav>


        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <div class="stats-grid">

                    <!-- Card 1: Total Buku -->
                    <div class="stat-card card-blue">
                        <div class="icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                                <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="stat-label">Total Buku</h3>
                            <p class="stat-value">125</p>
                        </div>
                    </div>

                    <!-- Card 2: Total Pengguna -->
                    <div class="stat-card card-purple">
                        <div class="icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="stat-label">Total Pengguna</h3>
                            <p class="stat-value">42</p>
                        </div>
                    </div>

                    <!-- Card 3: Total Peminjaman -->
                    <div class="stat-card card-emerald">
                        <div class="icon-wrapper">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <polyline points="12 6 12 12 16 14"></polyline>
                            </svg>
                        </div>
                        <div>
                            <h3 class="stat-label">Total Peminjaman</h3>
                            <p class="stat-value">310</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>