<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HabeKasir - Laporan Penjualan</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  @include('partials.navbar_styles')

  <style>
    :root{ --primary:#134686; --ink:#1E293B; --muted:#64748B; }
    *{ box-sizing:border-box; font-family:'Poppins',sans-serif; }
    body{
      margin:0;min-height:100vh;display:flex;flex-direction:column;
      background:linear-gradient(120deg,#f5f5f5,#3b5a9e,#f5f5f5);
      background-size:300% 300%;animation:bgMove 10s ease-in-out infinite alternate;
    }
    @keyframes bgMove{0%{background-position:left top;}100%{background-position:right bottom;}}

    .sidebar{width:250px;background:#fff;box-shadow:2px 0 8px rgba(0,0,0,.1);
      position:fixed;top:64px;left:0;height:calc(100vh - 64px);padding:24px 0;overflow-y:auto;}
    .sidebar-menu{list-style:none;margin:0;padding:0;}
    .sidebar-menu li{padding:16px 24px;display:flex;align-items:center;gap:12px;color:var(--ink);cursor:pointer;}
    .sidebar-menu li.active{background:var(--primary);color:#fff;}
    .sidebar-menu li:not(.active):hover{background:#F1F5F9;}

    .main-content{margin-top:64px;margin-left:250px;padding:24px;flex:1;opacity:0;transform:translateY(8px);animation:fadeIn .5s ease-out .05s forwards;}
    @keyframes fadeIn{to{opacity:1;transform:none;}}

    .table-wrap{background:#fff;border-radius:12px;box-shadow:0 4px 12px rgba(19,70,134,0.15);
      display:flex;flex-direction:column;overflow:hidden;animation:fadeIn .4s ease-out;}
    .table-header{padding:20px;border-bottom:1px solid #E2E8F0;display:flex;
      justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px;background:#fff;}
    .table-container{flex:1;overflow-y:auto;padding:20px;}

    .table th{background:var(--primary);color:#fff;text-align:left;padding:10px;}
    .table td{padding:10px;border-bottom:1px solid #eee;color:#1E293B;}
    .table tr:hover{background:#f9fafb;transition:background .2s ease;}
    .btn{border:0;border-radius:8px;padding:8px 14px;cursor:pointer;font-weight:500;}
    .btn-primary{background:var(--primary);color:#fff;}
    .btn-outline{border:1px solid var(--primary);color:var(--primary);background:#fff;}
    .btn-outline:hover{background:var(--primary);color:#fff;}
    .btn-secondary{background:#E5E7EB;color:#111827;}
    .search-box{border:1px solid #e0e0e0;padding:10px 12px;border-radius:8px;}
    .search-box:focus{outline:none;border-color:var(--primary);}

    /* overlay modal */
    .overlay{position:fixed;inset:0;background:rgba(15,23,42,.45);
      display:none;place-items:center;z-index:9999;backdrop-filter:saturate(120%) blur(4px);}
    .overlay.show{display:grid;animation:fadeOverlay .2s ease-out;}
    @keyframes fadeOverlay{from{opacity:0;}to{opacity:1;}}

    .xmodal{
      width:min(500px,90vw);background:#fff;border-radius:12px;
      box-shadow:0 25px 60px rgba(0,0,0,.25);padding:24px;text-align:left;
      transform:scale(.96);opacity:0;animation:pop .25s ease-out forwards;z-index:10000;
    }
    @keyframes pop{to{transform:none;opacity:1;}}

    .modal-title{text-align:center;font-weight:700;color:#1E293B;margin-bottom:16px;}
    .delete-actions{display:flex;justify-content:center;gap:10px;margin-top:16px;}

    /* toast */
    .toast-notif {
      position: fixed;top:24px;right:24px;background:#16a34a;color:#fff;
      font-weight:500;padding:14px 18px;border-radius:10px;box-shadow:0 6px 20px rgba(0,0,0,.25);
      opacity:0;transform:translateY(-15px);z-index:999999;display:flex;align-items:center;gap:10px;
      animation: toastFadeIn .4s ease-out forwards;
    }
    .toast-notif.hide{animation:toastFadeOut .4s ease-in forwards;}
    @keyframes toastFadeIn{from{opacity:0;transform:translateY(-15px);}to{opacity:1;transform:translateY(0);}}
    @keyframes toastFadeOut{from{opacity:1;transform:translateY(0);}to{opacity:0;transform:translateY(-15px);}}
    .toast-notif svg{width:22px;height:22px;}
    /* === shimmer tipis di modal === */
.xmodal {
  position: relative;
  overflow: hidden;
}
.xmodal::before {
  content: "";
  position: absolute;
  top: 0; left: -40%;
  width: 40%; height: 100%;
  background: linear-gradient(90deg, transparent, rgba(19,70,134,0.15), transparent);
  animation: shimmerModal 3s ease-in-out infinite;
  z-index: 1;
  pointer-events: none;
  border-radius: 12px;
}
@keyframes shimmerModal {
  0% { left: -40%; }
  100% { left: 140%; }
}
.xmodal * {
  position: relative;
  z-index: 2;
}
/* === Efek Pop Halus Saat Hover Baris di Laporan === */
.table tbody tr {
  transition: transform 0.2s ease, background 0.25s ease, box-shadow 0.25s ease;
  border-radius: 6px;
}
.table tbody tr:hover {
  background: linear-gradient(90deg, rgba(19,70,134,0.06), rgba(19,70,134,0.12));
  transform: scale(1.01);
  box-shadow: 0 4px 10px rgba(19,70,134,0.15);
  cursor: pointer;
}

/* Sedikit animasi muncul pas tabel dimuat */
.table-wrap {
  animation: tablePop .4s ease-out;
}
@keyframes tablePop {
  from { opacity: 0; transform: translateY(10px) scale(0.98); }
  to   { opacity: 1; transform: translateY(0) scale(1); }
}
/* === Efek Pop + Shimmer Looping di Baris Laporan === */
.table tbody tr {
  position: relative;
  overflow: hidden;
  transition: transform 0.25s ease, background 0.3s ease, box-shadow 0.3s ease;
  border-radius: 6px;
}

.table tbody tr:hover {
  background: linear-gradient(90deg, rgba(19,70,134,0.05), rgba(19,70,134,0.12));
  transform: scale(1.015);
  box-shadow: 0 4px 10px rgba(19,70,134,0.18);
  cursor: pointer;
}

/* shimmer looping lembut */
.table tbody tr::after {
  content: "";
  position: absolute;
  top: 0;
  left: -60%;
  width: 40%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(86, 68, 248, 0.253), transparent);
  filter: blur(4px) brightness(1.3);
  opacity: 0;
  pointer-events: none;
}

.table tbody tr:hover::after {
  animation: shimmerLoop 2.2s linear infinite;
  opacity: 1;
}

/* animasi shimmer looping terus */
@keyframes shimmerLoop {
  0% { left: -60%; }
  100% { left: 60%; }
}

  </style>
</head>
<body>
@include('partials.navbar')
@include('partials.sidebar')

<main class="main-content">
  <div class="table-wrap">
   <div class="table-header">
  <form action="{{ route('laporan.index') }}" method="GET" class="d-flex gap-2 flex-wrap align-items-center">
    <input type="date" name="tanggal" value="{{ $tanggal }}" class="search-box">
    <button type="submit" class="btn btn-primary px-4">Tampilkan</button>
    <button type="button" id="btnCetak" class="btn btn-outline">Cetak Laporan</button>
  </form>
</div>


    <div class="table-container">
      <h5 class="fw-semibold mb-3">Rekap Transaksi Penjualan</h5>
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>No</th><th>ID Transaksi</th><th>Tanggal</th><th>Metode Pembayaran</th><th>Total Harga</th><th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($transaksi as $i=>$t)
          <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $t->no_transaksi }}</td>
            <td>{{ $t->tanggal->format('Y-m-d') }}</td>
            <td>{{ ucfirst($t->metode_bayar) }}</td>
            <td>Rp{{ number_format($t->total_harga,0,',','.') }}</td>
            <td><button class="btn btn-primary btn-sm" onclick="openDetail('{{ $t->id_transaksi }}')">Detail</button></td>
          </tr>
          @empty
          <tr><td colspan="6" class="text-center text-muted py-3">Tidak ada transaksi</td></tr>
          @endforelse
        </tbody>
      </table>

      <div class="mt-3">
        <p><strong>Total Transaksi:</strong> {{ $totalTransaksi }}</p>
        <p><strong>Total Penjualan:</strong> Rp{{ number_format($totalPenjualan,0,',','.') }}</p>
      </div>
    </div>
  </div>
</main>

<!-- MODAL DETAIL -->
<div class="overlay" id="detailOverlay">
  <div class="xmodal">
    <h3 class="modal-title">Detail Transaksi</h3>
    <div id="detailBody" class="mb-3" style="max-height:60vh;overflow:auto;">
      <p class="text-center text-muted">Memuat data...</p>
    </div>
    <div class="delete-actions">
      <button class="btn btn-secondary" id="closeDetail">Tutup</button>
      <button class="btn btn-outline" id="cetakStruk">Cetak Struk</button>
    </div>
  </div>
</div>

<div class="overlay" id="cetakOverlay">
  <div class="xmodal text-center">
    <h3 class="modal-title">Konfirmasi Cetak Laporan</h3>
    <div class="p-3 border rounded bg-light mb-3">
      <p>Periode: <strong>{{ $tanggal ? $tanggal : 'Semua Tanggal' }}</strong></p>
      <p>Total Transaksi: <strong>{{ $totalTransaksi }}</strong></p>
      <p>Total Pendapatan: <strong>Rp{{ number_format($totalPenjualan,0,',','.') }}</strong></p>
    </div>
    <p class="text-muted small">Laporan akan dicetak dalam format A4 dengan semua transaksi pada tanggal tersebut.</p>
    <div class="delete-actions">
      <button class="btn btn-secondary" id="closeCetak">Batal</button>
      <a target="_blank" href="{{ route('laporan.cetak', ['tanggal'=>$tanggal]) }}" class="btn btn-primary">Cetak Sekarang</a>
    </div>
  </div>
</div>


<!-- TOAST -->
<div id="toastNotif" class="toast-notif" style="display:none;">
  <svg fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
  <span id="toastText">Berhasil!</span>
</div>

<script>
const detailOv = document.getElementById('detailOverlay');
const cetakOv = document.getElementById('cetakOverlay');
const detailBody = document.getElementById('detailBody');
const toast = document.getElementById('toastNotif');
const toastText = document.getElementById('toastText');

document.getElementById('closeDetail').onclick = ()=>detailOv.classList.remove('show');
document.getElementById('closeCetak').onclick = ()=>cetakOv.classList.remove('show');
document.getElementById('btnCetak').onclick = ()=>cetakOv.classList.add('show');

window.openDetail = async function(id){
  const res = await fetch(`/laporan/detail/${id}`);
  const data = await res.json();
  if(!data.success) return;
  const trx = data.transaksi;
  let html = `
    <p><strong>ID Transaksi:</strong> ${trx.no_transaksi}</p>
    <p><strong>Tanggal:</strong> ${new Date(trx.tanggal).toLocaleDateString('id-ID')}</p>
    <p><strong>Metode Pembayaran:</strong> ${trx.metode_bayar}</p>
    <hr>
    <table class="table table-sm">
      <thead><tr><th>Nama Barang</th><th>Jumlah</th><th>Subtotal</th></tr></thead>
      <tbody>`;
  trx.details.forEach(d=>{
    html += `<tr><td>${d.barang.nama_barang
}</td><td>${d.jumlah}</td><td>Rp${new Intl.NumberFormat('id-ID').format(d.subtotal)}</td></tr>`;
  });
  html += `</tbody></table><p class="text-end fw-semibold">Total: Rp${new Intl.NumberFormat('id-ID').format(trx.total_harga)}</p>`;
  detailBody.innerHTML = html;
  detailOv.classList.add('show');

  document.getElementById('cetakStruk').onclick = ()=>{
    const w=window.open('','_blank','width=500,height=600');
    w.document.write(`
      <html><head><title>Cetak Struk</title><style>
      body{font-family:Poppins,sans-serif;padding:20px;}
      table{width:100%;border-collapse:collapse;margin-top:10px;}
      td,th{border:1px solid #ccc;padding:6px;text-align:center;}
      </style></head><body>
      <h3 style='text-align:center'>HabeKasir</h3>
      <p>No Transaksi: ${trx.no_transaksi}<br>Tanggal: ${new Date(trx.tanggal).toLocaleDateString('id-ID')}</p>
      <table><thead><tr><th>Nama Barang</th><th>Qty</th><th>Subtotal</th></tr></thead><tbody>`);
    trx.details.forEach(d=>{
      w.document.write(`<tr><td>${d.barang.nama_barang}</td><td>${d.jumlah}</td><td>Rp${new Intl.NumberFormat('id-ID').format(d.subtotal)}</td></tr>`);
    });
    w.document.write(`</tbody></table><p style='text-align:right;margin-top:10px'><b>Total: Rp${new Intl.NumberFormat('id-ID').format(trx.total_harga)}</b></p>
    <p style='text-align:center;margin-top:20px'>Metode: ${trx.metode_bayar}<br>Terima kasih!</p>
    <script>window.print();<\/script></body></html>`);
    w.document.close();
  };
};

function showToast(msg){
  toastText.textContent=msg;
  toast.style.display='flex';
  toast.classList.remove('hide');
  setTimeout(()=>{toast.classList.add('hide');setTimeout(()=>toast.style.display='none',400);},2000);
}
</script>
</body>
</html>
