{{-- resources/views/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HabeKasir - Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    :root{ --primary:#134686; --ink:#1E293B; --muted:#64748B; --card:#FFFFFF; --line:#F1F5F9; }
    *{ box-sizing:border-box; font-family:'Poppins',sans-serif }
    body{
  margin:0;
  min-height:100vh;
  display:flex;
  flex-direction:column;


  background: linear-gradient(120deg, #f5f5f5, #3b5a9e, #f5f5f5);
  background-size: 300% 300%;
  animation: bgMove 10s ease-in-out infinite alternate;
}


@keyframes bgMove{
  0%   { background-position: left   top; }
  100% { background-position: right  bottom; }
}



      .card-icon{
        width:48px;height:48px;
        color:#134686; 
         display:block;margin:0 auto 12px;
    }


    .navbar{ height:64px; background:#fff; box-shadow:0 2px 8px rgba(0,0,0,.1);
      display:flex; justify-content:space-between; align-items:center; padding:0 24px;
      position:fixed; top:0; width:100%; z-index:1000; }
    .navbar-title{ font-size:20px; font-weight:700; color:var(--ink) }
    .navbar-right{ display:flex; align-items:center; gap:16px }
    .logout-btn{ background:var(--primary); color:#fff; border:0; padding:8px 16px; border-radius:8px; cursor:pointer }
    .logout-btn:hover{ background:#0F3A5F }
    .hamburger{ display:none; cursor:pointer }

   
    .sidebar{ width:250px; background:#fff; box-shadow:2px 0 8px rgba(0,0,0,.1);
      position:fixed; top:64px; left:0; height:calc(100vh - 64px); padding:24px 0; overflow-y:auto; }
    .sidebar-menu{ list-style:none; margin:0; padding:0 }
    .sidebar-menu li{ padding:12px 24px; display:flex; align-items:center; gap:12px; color:var(--ink); cursor:pointer }
    .sidebar-menu li.active{ background:var(--primary); color:#fff }
    .sidebar-menu li:not(.active):hover{ background:#F1F5F9 }


    .main-content{ margin-top:64px; margin-left:250px; padding:24px; flex:1; opacity:0; transform:translateY(8px); animation:fadeIn .4s ease-out .05s forwards; }
    @keyframes fadeIn{ to{ opacity:1; transform:none } }

    .cards-grid{ display:grid; grid-template-columns:repeat(4,1fr); gap:16px; margin-bottom:24px }
    .card{
      background:#fff; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,.10); padding:24px; text-align:center;
      position:relative; overflow:hidden; transform:translateY(0); transition:transform .2s ease, box-shadow .2s ease;
    }
    .card:hover{ transform:translateY(-4px); box-shadow:0 10px 24px rgba(0,0,0,.15) }

    .card::before{
      content:""; position:absolute; left:-30%; top:0; width:60%; height:3px; background:linear-gradient(90deg, transparent, rgba(19,70,134,.4), transparent);
      transform:translateX(-100%); animation:shimmer 2.2s ease-in-out infinite;
    }
    @keyframes shimmer{ 0%{transform:translateX(-100%)} 100%{transform:translateX(400%)} }

    .card-icon{ width:48px; height:48px; color:var(--primary); margin-bottom:12px }
    .card-title{ font-size:14px; color:var(--muted); margin-bottom:6px }
    .card-value{ font-size:24px; font-weight:700; color:var(--ink); margin-bottom:6px }
    .card-label{ font-size:12px; color:#16A34A }

    .footer{ background:#fff; text-align:center; padding:16px; color:var(--muted); font-size:12px }

  
    .overlay{ position:fixed; inset:0; background:rgba(15,23,42,.45); display:none; place-items:center; z-index:1200; backdrop-filter:saturate(120%) blur(4px); }
    .overlay.show{ display:grid; animation:fadeOverlay .2s ease-out; }
    @keyframes fadeOverlay{ from{ opacity:0 } to{ opacity:1 } }
    .modal{
      width:min(440px, 92vw); background:#fff; border-radius:12px; box-shadow:0 20px 60px rgba(0,0,0,.25);
      padding:22px; text-align:center; transform:scale(.96); opacity:0; animation:pop .25s ease-out forwards;
    }
    @keyframes pop{ to{ transform:none; opacity:1 } }
    .modal h3{ margin:8px 0 6px; color:var(--ink); font-size:18px }
    .modal p{ margin:0 0 16px; color:var(--muted); font-size:14px }
    .modal-actions{ display:flex; gap:10px; justify-content:center }
    .btn{ border:0; border-radius:8px; padding:10px 14px; cursor:pointer; }
    .btn-secondary{ background:#EFF4FA; color:#0f172a }
    .btn-primary{ background:var(--primary); color:#fff }
    .btn-primary:hover{ background:#0F3A5F }

    
    @media (max-width: 1024px){ .cards-grid{ grid-template-columns:repeat(2,1fr) } }
    @media (max-width: 768px){
      .sidebar{ transform:translateX(-100%); transition:transform .3s }
      .sidebar.show{ transform:translateX(0) }
      .main-content{ margin-left:0 }
      .cards-grid{ grid-template-columns:1fr }
      .hamburger{ display:block }
      .navbar-right{ display:none }
       
        .overlay{position:fixed;inset:0;display:none;place-items:center;z-index:1200;
                background:rgba(15,23,42,.45);backdrop-filter:saturate(120%) blur(4px);}
        .overlay.show{display:grid;animation:fadeOverlay .2s ease-out;}
        @keyframes fadeOverlay{from{opacity:0}to{opacity:1}}
        .modal{
        width:min(440px,92vw);background:#fff;border-radius:12px;
        box-shadow:0 20px 60px rgba(0,0,0,.25);
        padding:22px;text-align:center;
        transform:scale(.96);opacity:0;
        animation:pop .25s ease-out forwards;
        }
        @keyframes pop{to{transform:none;opacity:1}}
        .modal h3{margin:8px 0 6px;color:var(--ink);font-size:18px}
        .modal p{margin:0 0 16px;color:var(--muted);font-size:14px}
        .modal-actions{display:flex;gap:10px;justify-content:center}
        .btn{border:0;border-radius:8px;padding:10px 14px;cursor:pointer}
        .btn-secondary{background:#EFF4FA;color:#0f172a}
        .btn-primary{background:#ef4444;color:#fff}
        .btn-primary:hover{filter:brightness(.9)}

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
      <form id="logoutForm" method="POST" action="{{ url('/logout') }}">
  @csrf
  <button type="button" class="logout-btn" id="btnLogout">Logout</button>
</form>

    </div>
  </nav>


@include('partials.sidebar')


  <main class="main-content">
 
    <div class="cards-grid">
      <div class="card">
       <svg class="card-icon" viewBox="0 0 48 48" fill="none"
         stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
         <path d="M6 10h6l4 18h22l4-12H14" />
        <circle cx="20" cy="38" r="3" />
         <circle cx="34" cy="38" r="3" />
        </svg>
        <div class="card-title">Total Transaksi Hari Ini</div>
        <div class="card-value" data-count="{{ $totalTransaksiHariIni }}">0</div>
        <div class="card-label">&nbsp;</div>
      </div>

      <div class="card">    

        <svg class="card-icon" viewBox="0 0 48 48" fill="none"
         stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
         <rect x="6" y="12" width="36" height="24" rx="4" />
        <circle cx="24" cy="24" r="6" />
         <path d="M12 18h0M36 30h0" />
        </svg>
        <div class="card-title">Total Penjualan Hari Ini</div>
        <div class="card-value" data-currency="IDR" data-count="{{ $totalPenjualanHariIni }}">0</div>
        <div class="card-label">&nbsp;</div>
      </div>

      <div class="card">
       <svg class="card-icon" viewBox="0 0 48 48" fill="none"
     stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
  <path d="M8 16l16-8 16 8-16 8-16-8z" />
  <path d="M24 24v16" />
  <path d="M40 16v16l-16 8-16-8V16" />
</svg>

        <div class="card-title">Jumlah Barang</div>
        <div class="card-value" data-count="{{ $jumlahBarang }}">0</div>
        <div class="card-label">&nbsp;</div>
      </div>

      <div class="card">
       <svg class="card-icon" viewBox="0 0 48 48" fill="none"
     stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
  <path d="M8 40h32" />
  <rect x="12" y="24" width="6" height="12" rx="2" />
  <rect x="22" y="18" width="6" height="18" rx="2" />
  <rect x="32" y="12" width="6" height="24" rx="2" />
</svg>

        <div class="card-title">Penjualan Bulan Ini</div>
        <div class="card-value" data-currency="IDR" data-count="{{ $penjualanBulanIni }}">0</div>
        <div class="card-label">&nbsp;</div>
      </div>
    </div>
  </main>


<div class="overlay" id="logoutOverlay">
  <div class="modal">
    <h3>Konfirmasi Log Out</h3>
    <p>Apakah Anda yakin ingin keluar dari sistem?</p>
    <div class="modal-actions">
      <button class="btn btn-secondary" id="btnCancelLogout">Batal</button>
     <button class="btn btn-primary" id="btnConfirmLogout" style="background:#ef4444;">Ya, Logout</button>

    </div>
  </div>
</div>




  <script>
    function toggleSidebar(){ document.getElementById('sidebar').classList.toggle('show'); }

    
    (function(){
      const els = document.querySelectorAll('.card-value[data-count]');
      const ease = t => 1 - Math.pow(1 - t, 3); // easeOutCubic
      const dur = 900; // ms

      els.forEach(el=>{
        const target = parseFloat(el.getAttribute('data-count') || '0') || 0;
        const isIDR = el.getAttribute('data-currency') === 'IDR';
        const start = performance.now();

        function tick(now){
          const p = Math.min(1, (now - start)/dur);
          const val = Math.round(ease(p) * target);
          el.textContent = isIDR ? formatRupiah(val) : val.toLocaleString('id-ID');
          if(p<1) requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
      });

      function formatRupiah(nom){
        return 'Rp ' + (nom||0).toLocaleString('id-ID');
      }
    })();

    // Pop-up login berhasil: tombol & ESC untuk menutup
    (function(){
      const overlay = document.getElementById('welcomeOverlay');
      if(!overlay) return;
      const close = ()=> overlay.remove();
      document.getElementById('btnClose').onclick = close;
      document.getElementById('btnStart').onclick = close;
      overlay.addEventListener('click', (e)=>{ if(e.target === overlay) close(); });
      window.addEventListener('keydown', (e)=>{ if(e.key === 'Escape') close(); });
    })();
  </script>

  <script>
  const btnLogout = document.getElementById('btnLogout');
  const overlay = document.getElementById('logoutOverlay');
  const cancelBtn = document.getElementById('btnCancelLogout');
  const confirmBtn = document.getElementById('btnConfirmLogout');
  const logoutForm = document.getElementById('logoutForm');

  btnLogout.addEventListener('click', () => overlay.classList.add('show'));
  cancelBtn.addEventListener('click', () => overlay.classList.remove('show'));
  overlay.addEventListener('click', e => { if(e.target === overlay) overlay.classList.remove('show'); });
  window.addEventListener('keydown', e => { if(e.key === 'Escape') overlay.classList.remove('show'); });
  confirmBtn.addEventListener('click', () => logoutForm.submit());
</script>

</body>
</html>
