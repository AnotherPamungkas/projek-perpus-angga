<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Perpustakaan</title>
    <style>
        :root {
            --sidebar-width: 250px;
            --primary: #4f46e5;
            --bg-body: #f3f4f6;
            --white: #ffffff;
            --text-main: #111827;
            --text-muted: #6b7280;
            --border: #e5e7eb;
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', system-ui, sans-serif; background-color: var(--bg-body); display: flex; height: 100vh; overflow: hidden; }
        
        /* Sidebar */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--white);
            border-right: 1px solid var(--border);
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
        }
        .brand { font-size: 1.5rem; font-weight: bold; color: var(--primary); margin-bottom: 2rem; display: flex; align-items: center; gap: 10px; }
        .nav-link {
            display: block;
            padding: 0.75rem 1rem;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 0.5rem;
            transition: 0.2s;
        }
        .nav-link:hover, .nav-link.active { background-color: #eef2ff; color: var(--primary); }
        .logout-btn { margin-top: auto; color: #ef4444; }
        .logout-btn:hover { background-color: #fef2f2; }

        /* Main Content */
        .main-content { flex: 1; padding: 2rem; overflow-y: auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .header h1 { font-size: 1.8rem; color: var(--text-main); }
        .user-info { display: flex; align-items: center; gap: 1rem; }
        .avatar { width: 40px; height: 40px; border-radius: 50%; background: #ddd; object-fit: cover; }

        /* Stats Cards */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: var(--white); padding: 1.5rem; border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border: 1px solid var(--border); }
        .stat-label { color: var(--text-muted); font-size: 0.875rem; margin-bottom: 0.5rem; }
        .stat-value { font-size: 1.8rem; font-weight: bold; color: var(--text-main); }

        /* Table */
        .table-container { background: var(--white); border-radius: 10px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); overflow: hidden; border: 1px solid var(--border); }
        .table-header { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border); font-weight: bold; font-size: 1.1rem; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 1rem 1.5rem; text-align: left; border-bottom: 1px solid var(--border); }
        th { background-color: #f9fafb; color: var(--text-muted); font-weight: 600; font-size: 0.875rem; }
        tr:hover { background-color: #f9fafb; }
        .status-badge { padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.75rem; font-weight: 600; }
        .status-returned { background-color: #d1fae5; color: #065f46; }
        .status-borrowed { background-color: #fef3c7; color: #92400e; }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="brand">
            <span>📚</span> PerpusAdmin
        </div>
        <nav>
            <a href="/home" class="nav-link active">Dashboard</a>
            <a href="#" class="nav-link">Data Buku</a>
            <a href="#" class="nav-link">Data Anggota</a>
            <a href="#" class="nav-link">Sirkulasi</a>
        </nav>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link logout-btn" style="border:none; background:none; cursor:pointer; width:100%; text-align:left;">
                Keluar
            </button>
        </form>
    </aside>

    <!-- Content -->
    <main class="main-content">
        <div class="header">
            <h1>Dashboard Overview</h1>
            <div class="user-info">
                <div style="text-align: right;">
                    <div style="font-weight: bold;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 0.875rem; color: var(--text-muted);">Administrator</div>
                </div>
                <img src="https://picsum.photos/seed/admin/40/40" alt="Avatar" class="avatar">
            </div>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Total Koleksi Buku</div>
                <div class="stat-value">{{ $stats['total_buku'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Anggota Aktif</div>
                <div class="stat-value">{{ $stats['total_anggota'] }}</div>
            </div>
            <div class="stat-card">
                <div class="stat-label">Peminjaman Hari Ini</div>
                <div class="stat-value">{{ $stats['peminjaman_hari_ini'] }}</div>
            </div>
        </div>

        <!-- Recent Activity Table -->
        <div class="table-container">
            <div class="table-header">Aktivitas Peminjaman Terakhir</div>
            <table>
                <thead>
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Peminjam</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>#TRX-001</td>
                        <td>Budi Santoso</td>
                        <td>Laskar Pelangi</td>
                        <td>24 Okt 2023</td>
                        <td><span class="status-badge status-borrowed">Dipinjam</span></td>
                    </tr>
                    <tr>
                        <td>#TRX-002</td>
                        <td>Siti Aminah</td>
                        <td>Bumi Manusia</td>
                        <td>24 Okt 2023</td>
                        <td><span class="status-badge status-returned">Dikembalikan</span></td>
                    </tr>
                    <tr>
                        <td>#TRX-003</td>
                        <td>Ahmad Rizky</td>
                        <td>Atomic Habits</td>
                        <td>23 Okt 2023</td>
                        <td><span class="status-badge status-borrowed">Dipinjam</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

</body>
</html>