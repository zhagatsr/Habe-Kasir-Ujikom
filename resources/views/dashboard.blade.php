{{-- resources/views/dashboard.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HabeKasir - Dashboard</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  @include('partials.navbar_styles')

  <style>
    :root{ --primary:#134686; --ink:#1E293B; --muted:#64748B; --card:#FFFFFF; --line:#F1F5F9; }
    *{ box-sizing:border-box; font-family:'Poppins',sans-serif }
    body{
      margin:0; min-height:100vh; display:flex; flex-direction:column;
      background: linear-gradient(120deg, #f5f5f5, #3b5a9e, #f5f5f5);
      background-size:300% 300%; animation: bgMove 10s ease-in-out infinite alternate;
    }
    @keyframes bgMove{0%{background-position:left top}100%{background-position:right bottom}}

    .sidebar{ width:250px; background:#fff; box-shadow:2px 0 8px rgba(0,0,0,.1);
      position:fixed; top:64px; left:0; height:calc(100vh - 64px); padding:24px 0; overflow-y:auto; }
    .sidebar-menu{ list-style:none; margin:0; padding:0 }
    .sidebar-menu li{ padding:16px 24px; display:flex; align-items:center; gap:12px; color:var(--ink); cursor:pointer }
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
      content:""; position:absolute; left:-30%; top:0; width:60%; height:3px;
      background:linear-gradient(90deg, transparent, rgba(19,70,134,.4), transparent);
      transform:translateX(-100%); animation:shimmer 2.2s ease-in-out infinite;
    }
    @keyframes shimmer{ 0%{transform:translateX(-100%)} 100%{transform:translateX(400%)} }

    .card-icon{ width:48px; height:48px; color:var(--primary); margin-bottom:12px }
    .card-title{ font-size:14px; color:var(--muted); margin-bottom:6px }
    .card-value{ font-size:24px; font-weight:700; color:var(--ink); margin-bottom:6px }
    .card-label{ font-size:12px; color:#16A34A }

    @media (max-width: 1024px){ .cards-grid{ grid-template-columns:repeat(2,1fr) } }
    @media (max-width: 768px){
      .sidebar{ transform:translateX(-100%); transition:transform .3s }
      .sidebar.show{ transform:translateX(0) }
      .main-content{ margin-left:0 }
      .cards-grid{ grid-template-columns:1fr }
    }
    /* ====== Efek shimmer untuk grafik ====== */
.chart-shimmer {
  position: relative;
  overflow: hidden;
  border-radius: 12px;
}

.chart-shimmer::before {
  content: "";
  position: absolute;
  top: 0; left: -40%;
  width: 40%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(19,70,134,0.15), transparent);
  animation: shimmerMove 2.8s ease-in-out infinite;
}

@keyframes shimmerMove {
  0% { left: -40%; }
  100% { left: 140%; }
}

  </style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

  @include('partials.navbar')
  @include('partials.sidebar')

  <main class="main-content">
    <div class="cards-grid">
      <div data-aos="fade-up">
      <div class="card">
        <svg class="card-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
          <path d="M6 10h6l4 18h22l4-12H14" /><circle cx="20" cy="38" r="3" /><circle cx="34" cy="38" r="3" />
        </svg>
        <div class="card-title">Total Transaksi Hari Ini</div>
        <div class="card-value" data-count="{{ $totalTransaksiHariIni }}">0</div>
        <div class="card-label">&nbsp;</div>
      </div>
 </div>

  <div data-aos="fade-up">
      <div class="card">
        <svg class="card-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
          <rect x="6" y="12" width="36" height="24" rx="4" /><circle cx="24" cy="24" r="6" /><path d="M12 18h0M36 30h0" />
        </svg>
        <div class="card-title">Total Penjualan Hari Ini</div>
        <div class="card-value" data-currency="IDR" data-count="{{ $totalPenjualanHariIni }}">0</div>
        <div class="card-label">&nbsp;</div>
      </div>
      </div>
      
     <div data-aos="fade-up">
      <div class="card">
        <svg class="card-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
          <path d="M8 16l16-8 16 8-16 8-16-8z" /><path d="M24 24v16" /><path d="M40 16v16l-16 8-16-8V16" />
        </svg>
        <div class="card-title">Jumlah Barang</div>
        <div class="card-value" data-count="{{ $jumlahBarang }}">0</div>
        <div class="card-label">&nbsp;</div>
      </div>
      </div>

       <div data-aos="fade-up">
      <div class="card">
        <svg class="card-icon" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
          <path d="M8 40h32" /><rect x="12" y="24" width="6" height="12" rx="2" /><rect x="22" y="18" width="6" height="18" rx="2" /><rect x="32" y="12" width="6" height="24" rx="2" />
        </svg>
        <div class="card-title">Penjualan Bulan Ini</div>
        <div class="card-value" data-currency="IDR" data-count="{{ $penjualanBulanIni }}">0</div>
        <div class="card-label">&nbsp;</div>
      </div>
    </div>


  <div class="card" style="grid-column: span 4; padding: 20px 30px;">
  <h6 class="fw-semibold mb-3">Grafik Penjualan 7 Hari Terakhir</h6>
  <div class="chart-shimmer">
    <canvas id="chartPenjualan" height="110"></canvas>
  </div>
</div>


<script>
const ctx = document.getElementById('chartPenjualan');
new Chart(ctx, {
  type: 'line',
  data: {
    labels: {!! json_encode($labels) !!},
    datasets: [{
      label: 'Total Penjualan (Rp)',
      data: {!! json_encode($totals) !!},
      borderWidth: 3,
      borderColor: '#134686',
      backgroundColor: 'rgba(19,70,134,0.15)',
      tension: 0.35,
      fill: true,
      pointRadius: 4,
      pointHoverRadius: 6,
      pointBackgroundColor: '#134686'
    }]
  },
  options: {
    responsive: true,
    plugins: { legend: { display: false } },
    scales: {
      y: { beginAtZero: true, ticks: { callback: v => 'Rp' + v.toLocaleString('id-ID') } },
      x: { ticks: { color: '#1E293B' } }
    }
  }
});
</script>

  </main>

  <script>
    // animasi angka
    (function(){
      const els = document.querySelectorAll('.card-value[data-count]');
      const ease = t => 1 - Math.pow(1 - t, 3);
      const dur = 900;
      els.forEach(el=>{
        const target = parseFloat(el.getAttribute('data-count') || '0') || 0;
        const isIDR = el.getAttribute('data-currency') === 'IDR';
        const start = performance.now();
        function tick(now){
          const p = Math.min(1, (now - start)/dur);
          const val = Math.round(ease(p) * target);
          el.textContent = isIDR ? ('Rp ' + (val||0).toLocaleString('id-ID')) : val.toLocaleString('id-ID');
          if(p<1) requestAnimationFrame(tick);
        }
        requestAnimationFrame(tick);
      });
    })();
  </script>
</body>
</html>
