{{-- resources/views/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HabeKasir - Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    :root{
      --primary:#134686;
      --ink:#1E293B;
      --muted:#64748B;
      --card:#FFFFFF;
      --line:#F1F5F9;
    }
    *{box-sizing:border-box;font-family:'Poppins',sans-serif}
    body{
      margin:0; padding:0; min-height:100vh; display:flex; flex-direction:column;
      background: linear-gradient(to bottom, #D3D3D3 0%, #FFFFFF 50%, var(--primary) 100%);
    }

    /* NAVBAR */
    .navbar{
      height:64px; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,.1);
      display:flex; justify-content:space-between; align-items:center; padding:0 24px;
      position:fixed; top:0; width:100%; z-index:1000;
    }
    .navbar-title{font-size:20px;font-weight:700;color:var(--ink)}
    .navbar-right{display:flex;align-items:center;gap:16px}
    .welcome-text{font-size:14px;color:var(--muted)}
    .profile-icon{width:24px;height:24px;color:var(--primary)}
    .logout-btn{background:var(--primary);color:#fff;border:0;padding:8px 16px;border-radius:8px;cursor:pointer}
    .logout-btn:hover{background:#0F3A5F}
    .hamburger{display:none;cursor:pointer}

    /* SIDEBAR */
    .sidebar{
      width:250px;background:#fff;box-shadow:2px 0 8px rgba(0,0,0,.1);
      position:fixed; top:64px; left:0; height:calc(100vh - 64px); padding:24px 0; overflow-y:auto;
    }
    .sidebar-menu{list-style:none;margin:0;padding:0}
    .sidebar-menu li{padding:12px 24px;display:flex;align-items:center;gap:12px;color:var(--ink);cursor:pointer}
    .sidebar-menu li.active{background:var(--primary);color:#fff}
    .sidebar-menu li:not(.active):hover{background:#F1F5F9}

    /* MAIN */
    .main-content{margin-top:64px;margin-left:250px;padding:24px;flex:1}
    .cards-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:24px}
    .card{background:#fff;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,.1);padding:24px;text-align:center}
    .card-icon{width:48px;height:48px;color:var(--primary);margin-bottom:12px}
    .card-title{font-size:14px;color:var(--muted);margin-bottom:6px}
    .card-value{font-size:24px;font-weight:700;color:var(--ink);margin-bottom:6px}
    .card-label{font-size:12px;color:#16A34A}

    /* AKTIVITAS */
    .activity-section h2{font-size:20px;color:var(--ink);margin:0 0 12px}
    .activity-table{width:100%;border-collapse:collapse;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 4px 12px rgba(0,0,0,.1)}
    .activity-table th{background:var(--primary);color:#fff;padding:12px;text-align:left}
    .activity-table td{padding:12px;border-bottom:1px solid var(--line)}
    .activity-table tr:nth-child(even){background:#F8FAFC}

    .footer{background:#fff;text-align:center;padding:16px;color:var(--muted);font-size:12px}

    /* RESPONSIVE */
    @media (max-width: 1024px){ .cards-grid{grid-template-columns:repeat(2,1fr)} }
    @media (max-width: 768px){
      .sidebar{transform:translateX(-100%);transition:transform .3s}
      .sidebar.show{transform:translateX(0)}
      .main-content{margin-left:0}
      .cards-grid{grid-template-columns:1fr}
      .hamburger{display:block}
      .navbar-right{display:none}
    }
  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar">
    <div class="hamburger" onclick="toggleSidebar()">
      <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
      </svg>
    </div>
    <h1 class="navbar-title">HabeKasir</h1>
    <div class="navbar-right">
    
      <svg class="" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
      </svg>
      <form method="POST" action="{{ url('/logout') }}">
        @csrf
        <button class="logout-btn">Logout</button>
      </form>
    </div>
  </nav>

  <!-- SIDEBAR -->
  <aside class="sidebar" id="sidebar">
    <ul class="sidebar-menu">
      <li class="active">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
          <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
        </svg>
        Dashboard
      </li>
      <li onclick="window.location.href='{{ url('#') }}'">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
          <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
        </svg>
        Transaksi
      </li>
      <li onclick="window.location.href='{{ url('#') }}'">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V7l-7-5z" clip-rule="evenodd"></path>
        </svg>
        Barang
      </li>
      <li onclick="window.location.href='{{ url('#') }}'">
        <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
          <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        Laporan
      </li>
    </ul>
  </aside>

  <!-- MAIN -->
  <main class="main-content">
    <!-- CARDS -->
    <div class="cards-grid">
      <div class="card">
        <svg class="card-icon" fill="currentColor" viewBox="0 0 20 20">
          <path d="M3 1a1 1 0 000 2h1.22l.94 3.76A2 2 0 007.1 8h6.8a2 2 0 001.93-1.24l1.2-3A1 1 0 0016.1 2H6"></path>
        </svg>
        <div class="card-title">Total Transaksi Hari Ini</div>
        <div class="card-value">{{ $totalTransaksiHariIni }}</div>
        <div class="card-label">&nbsp;</div>
      </div>

      <div class="card">
        <svg class="card-icon" fill="currentColor" viewBox="0 0 20 20">
          <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v4H2V5zm0 6h16v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
        </svg>
        <div class="card-title">Total Penjualan Hari Ini</div>
        <div class="card-value">Rp {{ number_format($totalPenjualanHariIni,0,',','.') }}</div>
        <div class="card-label">&nbsp;</div>
      </div>

      <div class="card">
        <svg class="card-icon" fill="currentColor" viewBox="0 0 20 20">
          <path d="M4 3h12a1 1 0 011 1v12a1 1 0 01-1 1H4a1 1 0 01-1-1V4a1 1 0 011-1zm2 3v10m4-10v10m4-10v10"></path>
        </svg>
        <div class="card-title">Jumlah Barang</div>
        <div class="card-value">{{ $jumlahBarang }}</div>
        <div class="card-label">&nbsp;</div>
      </div>

      <div class="card">
        <svg class="card-icon" fill="currentColor" viewBox="0 0 20 20">
          <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
        </svg>
        <div class="card-title">Penjualan Bulan Ini</div>
        <div class="card-value">Rp {{ number_format($penjualanBulanIni,0,',','.') }}</div>
        <div class="card-label">&nbsp;</div>
      </div>
    </div>

   
   



  <script>
    function toggleSidebar(){
      const el = document.getElementById('sidebar');
      el.classList.toggle('show');
    }
  </script>
</body>
</html>
