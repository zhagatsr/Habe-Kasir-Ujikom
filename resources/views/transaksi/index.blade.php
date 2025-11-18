<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transaksi - HabeKasir</title>
  
  <meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
  @include('partials.navbar_styles')

  <style>
    :root{
      --primary:#134686; --ink:#1E293B; --muted:#64748B; --card:#FFFFFF; --line:#E2E8F0;
      --success:#16a34a; --success-2:#15803d; --danger:#dc2626; --danger-2:#b91c1c;
    }
    *{box-sizing:border-box;font-family:'Poppins',sans-serif}
    body{
      margin:0; min-height:100vh;
      background:linear-gradient(120deg,#f5f5f5,#3b5a9e,#f5f5f5);
      background-size:300% 300%; animation:bgMove 10s ease-in-out infinite alternate;
    }
    @keyframes bgMove{0%{background-position:left top}100%{background-position:right bottom}}

    .sidebar{width:250px;background:#fff;box-shadow:2px 0 8px rgba(0,0,0,.1);
      position:fixed;top:64px;left:0;height:calc(100vh - 64px);padding:24px 0;overflow-y:auto}
    .sidebar-menu{list-style:none;margin:0;padding:0}
    .sidebar-menu li{padding:16px 24px;display:flex;align-items:center;gap:12px;color:var(--ink);cursor:pointer}
    .sidebar-menu li.active{background:var(--primary);color:#fff}
    .sidebar-menu li:not(.active):hover{background:#F1F5F9}

    .main-content{
      margin-top:64px;margin-left:250px;padding:24px;
      display:grid;grid-template-columns:minmax(420px,1fr) 550px;gap:24px;
      opacity:0;transform:translateY(-50px);animation:slideDown 0.6s ease-out forwards;
    }
 @keyframes slideDown {
  from {
    opacity: 0;
    transform: translateY(-50px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
    @media(max-width:1100px){.main-content{grid-template-columns:1fr}}

    .card-box{
  background:#fff;
  border-radius:16px;
  box-shadow:0 4px 16px rgba(0,0,0,.1);
  padding:24px;

}

    .card-box {
  background:#fff;
  border-radius:12px;
  box-shadow:0 4px 12px rgba(0,0,0,.10);
  padding:15px;
  max-height:calc(100vh - 150px);
  overflow-y:auto;
}

   .produk-card{
  display:flex;
  align-items:center;
  gap:24px;
  border:1px solid var(--line);
  border-radius:16px;
  padding:20px;
  background:#f8fafc;
  transition:all .25s ease;
  box-shadow:0 2px 8px rgba(0,0,0,.05);
}
.produk-card:hover{
  background:#fff;
  box-shadow:0 4px 12px rgba(0,0,0,.12);
}

.produk-img{
  width:160px;
  height:160px;
  border-radius:14px;
  object-fit:cover;
  border:1px solid #e2e8f0;
  background:#fff;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
}

.produk-nama{
  font-weight:700;
  color:#0f254b;
  font-size:1.1rem;
}
.produk-stok{
  font-size:.9rem;
  color:var(--muted);
  margin-top:4px;
}
.produk-harga{
  font-weight:700;
  color:var(--primary);
  margin-top:8px;
  font-size:1.05rem;
}

.btn-add{
  border:0;
  background:var(--success);
  color:#fff;
  width:44px;
  height:44px;
  border-radius:12px;
  font-size:20px;
  display:flex;
  align-items:center;
  justify-content:center;
  transition:.2s;
  margin-left:auto;
}
.btn-add:hover{ background:var(--success-2); }


.cart-box{
  background:#fff;
  border-radius:12px;
  box-shadow:0 4px 12px rgba(0,0,0,.10);
  padding:12px;
  position:sticky;
  top:84px;
  max-height:calc(100vh - 120px);
  overflow-y:auto;
  overflow-x:auto;   
}


    .cart-header{font-weight:700;color:#0f254b;margin-bottom:6px}
    .cart-table{width:100%;border-collapse:separate;border-spacing:0}
    .cart-table th{background:var(--primary);color:#fff;font-weight:600;text-align:center;padding:10px}
    .cart-table td{background:#fff;padding:10px;border-bottom:1px solid #EEF2F7;vertical-align:middle;text-align:center}
    .qty-wrap{display:flex;align-items:center;gap:8px;justify-content:center}
    .btn-qty{background:#E5E7EB;border:0;padding:4px 10px;border-radius:8px;font-weight:700;cursor:pointer}
    .btn-qty:hover{background:#cbd5e1}
    .btn-danger-fig{background:var(--danger);color:#fff;border:0;border-radius:8px;padding:6px 10px;font-weight:600}
    .btn-danger-fig:hover{background:var(--danger-2)}
    .total-line{display:flex;justify-content:space-between;align-items:center;margin-top:10px;padding-top:10px;border-top:1px dashed #E2E8F0}
    .total-label{font-weight:600;color:#0f254b}
    .total-value{font-weight:800;color:var(--primary)}
    .btn-primary-fig{background:var(--primary);color:#fff;border:0;border-radius:10px;padding:12px 14px;font-weight:700;width:100%}
    .btn-primary-fig:hover{filter:brightness(.95)}

    .modal-backdrop{position:fixed;inset:0;background:rgba(28, 28, 83, 0.651);display:none;align-items:center;z-index:50}
    .modal-backdrop.show{display:flex}
    .drawer{width:100%;background:#ffffff;border-top-left-radius:16px;border-top-right-radius:16px;padding:16px 16px 24px;box-shadow:0 -8px 24px rgb(253, 251, 251);max-width:600px;margin-inline:auto}
    .method-grid{display:grid;grid-template-columns:1fr 1fr 1fr;gap:10px}
    .method-btn{border:1px solid var(--line);border-radius:12px;padding:12px 10px;font-weight:700;cursor:pointer;text-align:center}
    .method-btn.active{background:var(--primary);color:#fff;border-color:var(--primary)}
    .choose-trigger{display:flex;justify-content:space-between;align-items:center;border:1px solid var(--line);border-radius:10px;padding:10px 12px;margin:12px 0;font-weight:600}


@keyframes bgMove {
  0% { background-position: left top; }
  100% { background-position: right bottom; } 
}


.produk-card {
  opacity: 0;
  transform: translateY(10px);
  animation: produkFade .5s ease forwards;
}
.produk-card:nth-child(odd) { animation-delay: .05s; }
.produk-card:nth-child(even) { animation-delay: .1s; }
@keyframes produkFade { to { opacity: 1; transform: none; } }


.produk-card:hover {
  transform: translateY(-4px) scale(1.02);
  box-shadow: 0 6px 14px rgba(0,0,0,.12);
}


.btn-add {
  transition: transform .15s ease, box-shadow .15s ease, background .15s ease;
}
.btn-add:hover {
  background: var(--success-2);
  transform: scale(1.05);
}
.btn-add:active {
  transform: scale(0.95);
}


/* Efek total harga berubah */
.total-value {
  transition: color .25s ease, transform .25s ease;
}
.total-value.flash {
  color: #16a34a;
  transform: scale(1.07);
}


/* Drawer animasi smooth */
.modal-backdrop.show .drawer {
  animation: drawerUp .3s ease;
}
@keyframes drawerUp {
  from { transform: translateY(20px); opacity: 0; }
  to { transform: none; opacity: 1; }
}


.produk-card {
  transition: transform .25s cubic-bezier(.2, .8, .4, 1), box-shadow .25s ease;
  transform-origin: center;
  will-change: transform;
}

.produk-card:hover {
  transform: translateY(-14px) scale(1.07);
  box-shadow: 0 18px 32px rgba(0, 0, 0, 0.25);
  z-index: 3;
}


.produk-card:hover .produk-img {
  transform: scale(1.06);
  transition: transform .25s ease;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
}

.card-box > div:first-child {
  position: sticky;
  top: 0;
  background: #fff;
  z-index: 10;
  margin-top: 0px;
  padding-top: 24px;
  padding-bottom: 12px;
  border-bottom: 1px solid #E2E8F0;
}

/* FIX: Drawer muncul di tengah + backdrop lebih jelas */
.modal-backdrop {
  background: rgba(0, 0, 0, 0.55) !important;
  display: none;
  align-items: center !important; /* Tengah vertikal */
  justify-content: center !important; /* Tengah horizontal */
}

.drawer {
  border-radius: 16px;
  box-shadow: 0 0 35px rgba(0, 0, 0, 0.25) !important;
  width: 90%;
  max-width: 450px !important;
  padding: 20px;
  animation: drawerCenter .3s ease;
}

/* Animasi dari kecil → normal */
@keyframes drawerCenter {
  from {
    opacity: 0;
    transform: scale(0.92);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

  </style>
</head>
<body>

@include('partials.navbar')
@include('partials.sidebar')

<main class="main-content">
  <section>
    <div class="card-box">
      <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
        <h6 class="fw-semibold mb-0">Daftar Barang</h6>
        <form method="GET" action="{{ route('transaksi.index') }}" style="display:flex;gap:8px;align-items:center;">
          <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari barang..."
            style="padding:8px 12px;border:1px solid #E2E8F0;border-radius:8px;min-width:220px">
          <button type="submit" style="background:var(--primary);color:#fff;border:0;padding:8px 14px;border-radius:8px;font-weight:600">Cari</button>
        </form>
      </div>

      <hr style="margin:12px 0;border:0;border-top:1px solid #E2E8F0">

    <div class="row g-4">
  @foreach($produk as $p)
    <div class="col-12">

            <div class="produk-card">
              <img src="{{ $p->foto ? asset('uploads/barang/'.$p->foto) : asset('images/placeholder.png') }}" alt="{{ $p->nama_barang }}" class="produk-img">
              <div style="flex:1">
                <div class="produk-nama">{{ $p->nama_barang }}</div>
                <div class="produk-stok">Stok: {{ $p->stok }}</div>
                <div class="produk-harga">Rp{{ number_format($p->harga,0,',','.') }}</div>
              </div>
              <button type="button" class="btn-add" data-id="{{ $p->id_barang }}">+</button>
            </div>
          </div>
        @endforeach
      </div>
      <div class="mt-3">{{ $produk->links('pagination::bootstrap-5') }}</div>
    </div>
  </section>

  <aside>
    <div class="cart-box" id="cartBox">
      <div class="cart-header">Keranjang</div>
      <table class="cart-table">
        <thead><tr><th>Nama</th><th>Harga</th><th>Qty</th><th>Subtotal</th><th>Aksi</th></tr></thead>
        <tbody>
          @forelse($cart as $c)
            <tr data-id="{{ $c['id_barang'] }}">
              <td>{{ $c['nama_barang'] }}</td>
              <td>Rp{{ number_format($c['harga'],0,',','.') }}</td>
              <td>
                <div class="qty-wrap">
                  <button type="button" class="btn-qty js-inc">+</button>
                  <span>{{ $c['qty'] }}</span>
                  <button type="button" class="btn-qty js-dec">-</button>
                </div>
              </td>
              <td>Rp{{ number_format($c['harga']*$c['qty'],0,',','.') }}</td>
              <td><button type="button" class="btn-danger-fig js-remove">Hapus</button></td>
            </tr>
          @empty
            <tr><td colspan="5" class="text-center muted py-3">Keranjang kosong</td></tr>
          @endforelse
        </tbody>
      </table>

      <div class="total-line">
        <span class="total-label">Total Harga</span>
        <span class="total-value">Rp{{ number_format($total,0,',','.') }}</span>
      </div>

      <!-- INPUT UANG MASUK -->
<div class="total-line mt-2">
  <span class="total-label">Uang Masuk</span>
  <input type="number" id="uangMasuk" class="form-control" 
         placeholder="Masukkan uang..." 
         style="max-width:150px; text-align:right;">
</div>

<div class="total-line">
  <span class="total-label">Kembalian</span>
  <span id="kembalianValue" class="total-value">Rp0</span>
</div>



      <div class="choose-trigger" id="openDrawer">
        <span>Metode Bayar</span>
        <span id="chosenLabel">{{ old('metode_bayar','Pilih Metode') }}</span>
      </div>

      <form action="{{ route('transaksi.checkout') }}" method="POST" id="checkoutForm">
        @csrf
        <input type="hidden" name="metode_bayar" id="metodeBayarHidden">
        <button type="button" id="btnCheckout" class="btn-primary-fig">Selesai / Simpan Transaksi</button>

      </form>
      <button type="button" id="btnPrintStruk" class="btn btn-outline-primary mt-2 w-100 fw-semibold" style="border-radius:10px;padding:10px 14px;">Cetak Struk</button>

    </div>
  </aside>
</main>

<div class="modal-backdrop" id="drawerBackdrop">
  <div class="drawer">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px">
      <strong>Pilih Metode Pembayaran</strong>
      <button type="button" class="btn-qty" id="closeDrawer">✕</button>
    </div>

    <!-- AREA STRUK PRINT -->
<div id="printArea" style="display:none;">
  <div style="max-width:400px;margin:auto;padding:20px;font-family:'Poppins',sans-serif;font-size:14px;">
    <div style="text-align:center;">
      <strong style="font-size:18px;">HabeKasir</strong><br>
      <span>Jl. Kopo, Bandung</span>
      <hr style="margin:8px 0;border-top:1px dashed #ccc;">
    </div>

    <div style="margin-bottom:8px;">
      <div>Tanggal: <span id="printTanggal"></span></div>
      <div>No. Transaksi: <span id="printNoTrx"></span></div>
    </div>

    <table style="width:100%;border-collapse:collapse;">
      <thead>
        <tr>
          <th style="text-align:left;">Nama Barang</th>
          <th>Qty</th>
          <th>Harga</th>
          <th>Subtotal</th>
        </tr>
      </thead>
      <tbody id="printItems"></tbody>
    </table>

    <hr style="border-top:1px dashed #ccc;">
    <div style="text-align:right;">
      <strong>Total: <span id="printTotal"></span></strong><br>
      <span>Metode: <span id="printMetode"></span></span>
    </div>

    

    <hr style="border-top:1px dashed #ccc;margin-top:10px;">
    <div style="text-align:center;margin-top:6px;">
      <p>Terima kasih telah berbelanja!</p>
      <small>HabeKasir © 2025</small>
    </div>
  </div>
</div>


    <div class="method-grid">
      <button class="method-btn" data-value="CASH">Cash</button>
      <button class="method-btn" data-value="QRIS">QRIS</button>
      <button class="method-btn" data-value="TRANSFER">Transfer</button>
    </div>
  </div>
</div>

<div id="toast" 
     style="position:fixed; top:-80px; left:50%; transform:translateX(-50%);
     background:#ff4d4f; color:#fff; padding:14px 22px; 
     border-radius:12px; font-weight:600; 
     box-shadow:0 6px 20px rgba(0,0,0,.2);
     transition:all .45s cubic-bezier(.4,0,.2,1); 
     z-index:9999;">
  Keranjang masih kosong! Silakan pilih barang dulu.
</div>



<script>
const csrf = document.querySelector('meta[name="csrf-token"]').content;
const routes = {
  add: "{{ route('transaksi.cart.add') }}",
  inc: "{{ route('transaksi.cart.inc') }}",
  dec: "{{ route('transaksi.cart.dec') }}",
  remove: "{{ route('transaksi.cart.remove') }}"
};

// ====== fungsi utama fetch data ke server ======
async function updateCart(url, payload = {}) {
  const form = new FormData();
  for (const k in payload) form.append(k, payload[k]);
  const res = await fetch(url, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': csrf,
      'X-Requested-With': 'XMLHttpRequest',
      'Accept': 'application/json'
    },
    body: form
  });
  const data = await res.json();
  if (data.success) renderCart(data.cart, data.total);
}

// ====== render ulang keranjang secara langsung ======
function renderCart(cart, total) {
  const tbody = document.querySelector('.cart-table tbody');
  tbody.innerHTML = '';

  if (Object.keys(cart).length === 0) {
    tbody.innerHTML = `<tr><td colspan="5" class="text-center muted py-3">Keranjang kosong</td></tr>`;
  } else {
    for (const id in cart) {
      const c = cart[id];
      tbody.innerHTML += `
        <tr data-id="${c.id_barang}">
          <td>${c.nama_barang}</td>
          <td>Rp${formatRupiah(c.harga)}</td>
          <td>
            <div class="qty-wrap">
              <button type="button" class="btn-qty js-inc">+</button>
              <input type="number" min="1" value="${c.qty}" class="qty-input" style="width:50px;text-align:center;border:1px solid #ccc;border-radius:6px;padding:3px;">
              <button type="button" class="btn-qty js-dec">-</button>
            </div>
          </td>
          <td>Rp${formatRupiah(c.harga * c.qty)}</td>
          <td><button type="button" class="btn-danger-fig js-remove">Hapus</button></td>
        </tr>`;
    }
  }

  document.querySelector('.total-value').textContent = `Rp${formatRupiah(total)}`;

  // re-bind tombol dan input setelah render ulang
  bindCartButtons();
}

// ====== format angka ke Rupiah ======
function formatRupiah(num) {
  return new Intl.NumberFormat('id-ID').format(num);
}

// ====== event handler semua tombol qty / hapus ======
function bindCartButtons() {
  document.querySelectorAll('.js-inc').forEach(btn => {
    btn.onclick = () => updateCart(routes.inc, { id_barang: btn.closest('tr').dataset.id });
  });
  document.querySelectorAll('.js-dec').forEach(btn => {
    btn.onclick = () => updateCart(routes.dec, { id_barang: btn.closest('tr').dataset.id });
  });
  document.querySelectorAll('.js-remove').forEach(btn => {
    btn.onclick = () => updateCart(routes.remove, { id_barang: btn.closest('tr').dataset.id });
  });
  document.querySelectorAll('.qty-input').forEach(input => {
    input.onchange = () => {
      const val = Math.max(1, parseInt(input.value) || 1);
      updateCart("{{ route('transaksi.cart.updateQty') }}", { id_barang: input.closest('tr').dataset.id, qty: val });

    };
  });
}

// Saat halaman selesai dimuat, aktifkan semua tombol keranjang
document.addEventListener('DOMContentLoaded', () => {
  bindCartButtons();
});


// ====== tombol tambah produk (+ hijau) ======
document.querySelectorAll('.btn-add').forEach(btn => {
  btn.onclick = () => updateCart(routes.add, { id_barang: btn.dataset.id });
});

// ====== drawer metode bayar ======
const drawer = document.getElementById('drawerBackdrop');
document.getElementById('openDrawer').onclick = () => drawer.classList.add('show');
document.getElementById('closeDrawer').onclick = () => drawer.classList.remove('show');
document.querySelectorAll('.method-btn').forEach(btn => {
  btn.onclick = () => {
    document.querySelectorAll('.method-btn').forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('metodeBayarHidden').value = btn.dataset.value;
    document.getElementById('chosenLabel').textContent = btn.textContent;
    drawer.classList.remove('show');
  };
});

function showToast(msg) {
  const t = document.getElementById('toast');
  t.innerText = msg;
  t.style.top = '20px';

  setTimeout(() => {
    t.style.top = '-80px';
  }, 2500);
}

document.getElementById('btnCheckout').addEventListener('click', () => {
  const rows = document.querySelectorAll('.cart-table tbody tr');
  const isEmpty = rows.length === 1 && rows[0].innerText.includes('Keranjang kosong');

  if (isEmpty) {
    showToast("Keranjang masih kosong! Silakan pilih barang dulu.");
    return;
  }

  document.getElementById('checkoutForm').submit();
});

</script>

<script>
// ========== CETAK STRUK ==========
document.getElementById('btnPrintStruk').onclick = function() {
  const cartRows = document.querySelectorAll('.cart-table tbody tr');
  if (cartRows.length === 0 || cartRows[0].textContent.includes('Keranjang kosong')) {
    alert('Keranjang kosong, tidak bisa mencetak struk!');
    return;
  }

  const tbody = document.getElementById('printItems');
  tbody.innerHTML = '';
  cartRows.forEach(tr => {
    const cols = tr.querySelectorAll('td');
    if (cols.length > 1) {
      const nama = cols[0].innerText.trim();
      const harga = cols[1].innerText.trim();
      const qty = tr.querySelector('.qty-input')?.value || tr.querySelector('span')?.innerText || '1';
      const subtotal = cols[3].innerText.trim();
      tbody.innerHTML += `
        <tr>
          <td>${nama}</td>
          <td style="text-align:center;">${qty}</td>
          <td style="text-align:right;">${harga}</td>
          <td style="text-align:right;">${subtotal}</td>
        </tr>`;
    }
  });

  // isi bagian atas
  document.getElementById('printTanggal').textContent = new Date().toLocaleDateString('id-ID', {year:'numeric', month:'long', day:'numeric'});
  document.getElementById('printNoTrx').textContent = 'TRX' + Date.now().toString().slice(-5);
  document.getElementById('printTotal').textContent = document.querySelector('.total-value').innerText;
  document.getElementById('printMetode').textContent = document.getElementById('chosenLabel').textContent || '-';

  // buka popup print
  const strukContent = document.getElementById('printArea').innerHTML;
  const win = window.open('', '', 'width=480,height=600');
  win.document.write('<html><head><title>Cetak Struk - HabeKasir</title>');
  win.document.write('<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">');
  win.document.write('</head><body>');
  win.document.write(strukContent);
  win.document.write('</body></html>');
  win.document.close();
  win.focus();
  win.print();
  win.close();
};
</script>

<script>
document.getElementById("btnCheckout").addEventListener("click", function () {
    const metode = document.getElementById("metodeBayarHidden").value;

    // CEK: kalau belum dipilih
    if (!metode) {
        showToast("Pilih metode pembayaran atau isi keranjang terlebih dahulu!");
        return;
    }

    // Kalau ada, langsung submit
    document.getElementById("checkoutForm").submit();
});


// ==== FUNGSI TOAST (Gunakan toast yang udah ada) ====
function showToast(msg) {
    const toast = document.getElementById("toast");
    toast.innerText = msg;
    toast.style.top = "20px";

    setTimeout(() => {
        toast.style.top = "-80px";
    }, 2000);
}
</script>

<script>
  function formatRupiah(angka) {
    return "Rp" + angka.toLocaleString("id-ID");
  }

  const total = {{ $total }};
  const uangInput = document.getElementById("uangMasuk");
  const kembalianText = document.getElementById("kembalianDisplay");

  uangInput.addEventListener("input", function () {
    let uang = parseInt(uangInput.value || 0);
    let kembali = uang - total;

    if (kembali < 0) kembalianText.style.color = "#dc2626"; 
    else kembalianText.style.color = "#16a34a";

    kembalianText.textContent = formatRupiah(kembali);
  });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const uangMasukInput = document.getElementById("uangMasuk");
    const kembalianValue = document.getElementById("kembalianValue");

    // Ambil total harga dari tampilan
    const totalHargaText = document.querySelector(".total-value").innerText;
    const totalHarga = parseInt(totalHargaText.replace(/[^0-9]/g, ""));

    uangMasukInput.addEventListener("input", function () {
        let uangMasuk = parseInt(this.value || 0);
        let kembalian = uangMasuk - totalHarga;

        if (kembalian < 0) {
            kembalianValue.innerText = "Uang kurang!";
            kembalianValue.style.color = "red";
        } else {
            kembalianValue.innerText = "Rp" + kembalian.toLocaleString("id-ID");
            kembalianValue.style.color = "#134686";
        }
    });

});
</script>

</body>
</html>
