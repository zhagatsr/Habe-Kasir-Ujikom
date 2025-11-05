<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HabeKasir - Barang</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">

  <style>
    :root{ --primary:#134686; --ink:#1E293B; --muted:#64748B; }
    *{ box-sizing:border-box; font-family:'Poppins',sans-serif; }

    body{
      margin:0;min-height:100vh;display:flex;flex-direction:column;
      background:linear-gradient(120deg,#f5f5f5,#3b5a9e,#f5f5f5);
      background-size:300% 300%;animation:bgMove 10s ease-in-out infinite alternate;
    }
    @keyframes bgMove{0%{background-position:left top;}100%{background-position:right bottom;}}

    /* NAVBAR */
    .navbar{height:64px;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,.1);
      display:flex;justify-content:space-between;align-items:center;padding:0 24px;
      position:fixed;top:0;width:100%;z-index:1000;}
    .navbar-title{font-size:20px;font-weight:700;color:var(--ink);}
    .logout-btn{background:var(--primary);color:#fff;border:0;padding:8px 16px;border-radius:8px;cursor:pointer;}
    .logout-btn:hover{background:#0F3A5F;}

    /* SIDEBAR (punyamu) */
    .sidebar{width:250px;background:#fff;box-shadow:2px 0 8px rgba(0,0,0,.1);
      position:fixed;top:64px;left:0;height:calc(100vh - 64px);padding:24px 0;overflow-y:auto;}
    .sidebar-menu{list-style:none;margin:0;padding:0;}
    .sidebar-menu li{padding:12px 24px;display:flex;align-items:center;gap:12px;color:var(--ink);cursor:pointer;}
    .sidebar-menu li.active{background:var(--primary);color:#fff;}
    .sidebar-menu li:not(.active):hover{background:#F1F5F9;}

    /* MAIN */
    .main-content{margin-top:64px;margin-left:250px;padding:24px;flex:1;opacity:0;
      transform:translateY(8px);animation:fadeIn .4s ease-out .05s forwards;}
    @keyframes fadeIn{to{opacity:1;transform:none;}}

    /* TABEL */
    .table-wrap{background:#fff;border-radius:12px;box-shadow:0 4px 12px rgba(19,70,134,0.15);
      display:flex;flex-direction:column;height:600px;overflow:hidden;animation:fadeIn .4s ease-out;}
    .table-header{padding:20px;border-bottom:1px solid #E2E8F0;display:flex;
      justify-content:space-between;align-items:center;background:#fff;position:sticky;top:0;z-index:5;}
    .table-container{flex:1;overflow-y:auto;scroll-behavior:smooth;padding:0 20px 20px 20px;}

    .table{width:100%;border-collapse:collapse;}
    .table th{position:sticky;top:0;background:var(--primary);color:#fff;text-align:left;padding:10px;z-index:2;}
    .table td{padding:10px;border-bottom:1px solid #eee;color:#1E293B;}
    .table tr:hover{background:#f9fafb;transition:background .2s ease;}

    /* BUTTONS + SEARCH */
    .btn{border:0;border-radius:8px;padding:8px 14px;cursor:pointer;font-weight:500;}
    .btn-primary{background:var(--primary);color:#fff;}
    .btn-primary:hover{background:#0F3A5F;}
    .btn-danger{background:#ef4444;color:#fff;}
    .btn-danger:hover{background:#dc2626;}
    .btn-secondary{background:#E5E7EB;color:#111827;}
    .search-box{border:1px solid #e0e0e0;padding:10px 12px;border-radius:8px;width:250px;}
    .search-box:focus{outline:none;border-color:var(--primary);}

    /* OVERLAY & MODAL (custom) —> pakai .xmodal agar tidak bentrok Bootstrap */
    .overlay{
      position:fixed;inset:0;background:rgba(15,23,42,.45);
      display:none;place-items:center;z-index:9999;backdrop-filter:saturate(120%) blur(4px);
    }
    .overlay.show{display:grid;animation:fadeOverlay .2s ease-out;}
    @keyframes fadeOverlay{from{opacity:0;}to{opacity:1;}}

    /* biar modal tetap kelihatan setelah tampil */
.overlay.show .xmodal {
  opacity: 1;
  transform: scale(1);
}

  
    .xmodal{ /* <— DULUNYA .modal */
      width:min(500px,92vw);background:#fff;border-radius:12px;
      box-shadow:0 25px 60px rgba(0,0,0,.25);padding:24px;text-align:left;
      transform:scale(.96);opacity:0;animation:pop .25s ease-out forwards;z-index:10000;
    }

    /* Efek animasi getar & style popup hapus barang ala Figma */
.xmodal.delete-modal {
  text-align: center;
  padding: 36px 28px;
  border-radius: 14px;
  box-shadow: 0 20px 50px rgba(0,0,0,0.25);
  transform: scale(0.9);
  opacity: 0;
  animation: popDelete 0.4s ease-out forwards;
  animation-fill-mode: forwards; /* biar tetap visible setelah animasi */
}

@keyframes popDelete {
  0%   { transform: scale(0.9); opacity: 0; }
  50%  { transform: scale(1.03); opacity: 1; }
  70%  { transform: scale(0.97); }
  100% { transform: scale(1); opacity: 1; }
}


/* ikon segitiga peringatan */
.warning-icon {
  width: 48px;
  height: 48px;
  margin: 0 auto 12px;
  color: #facc15; /* kuning */
}

/* judul popup */
.delete-title {
  font-weight: 700;
  color: var(--ink);
  font-size: 20px;
  margin-bottom: 8px;
}

/* teks deskripsi */
.delete-desc {
  font-size: 14px;
  color: var(--muted);
  margin-bottom: 20px;
}

/* tombol */
.delete-actions {
  display: flex;
  justify-content: center;
  gap: 10px;
}

    @keyframes pop{to{transform:none;opacity:1;}}

    .modal-title{text-align:center;font-weight:700;color:#1E293B;margin-bottom:16px;}
    .form-group{margin-bottom:14px;}
    .form-group label{display:block;font-weight:600;color:#1E293B;font-size:14px;margin-bottom:6px;}
    .form-group input{width:100%;padding:10px;border:1px solid #CBD5E1;border-radius:8px;font-size:14px;}
    .form-group input[readonly]{background:#F1F5F9;color:#475569;cursor:not-allowed;}
    .form-note{display:block;margin-top:5px;font-size:12px;color:#94A3B8;}
    .modal-actions{display:flex;justify-content:center;gap:10px;margin-top:16px;}
    .btn-secondary{background:#F1F5F9;color:#1E293B;border:1px solid #E2E8F0;transition:all .2s ease;}
    .btn-secondary:hover{background:#E2E8F0;}


    /* Efek shake saat muncul */
.shake {
  animation: shakeAnim 0.5s ease-in-out;
}
@keyframes shakeAnim {
  0%,100% { transform: translateX(0); }
  20%,60% { transform: translateX(-8px); }
  40%,80% { transform: translateX(8px); }
}


/* Animasi centang sukses */
.success-check {
  width: 70px;
  height: 70px;
  border-radius: 50%;
  border: 3px solid #22c55e;
  position: relative;
  margin: 0 auto 12px;
  animation: popSuccess .4s ease-out forwards;
}
@keyframes popSuccess {
  0% { transform: scale(0); opacity: 0; }
  60% { transform: scale(1.2); opacity: 1; }
  100% { transform: scale(1); opacity: 1; }
}

.success-check::after {
  content: '';
  position: absolute;
  left: 18px;
  top: 32px;
  width: 20px;
  height: 10px;
  border-left: 3px solid #22c55e;
  border-bottom: 3px solid #22c55e;
  transform: rotate(-45deg);
  opacity: 0;
  animation: drawCheck .4s ease .3s forwards;
}

@keyframes drawCheck {
  to { opacity: 1; }
}

@keyframes fadeOut {
  to { opacity: 0; visibility: hidden; }
}

  </style>
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar">
    <h1 class="navbar-title">HabeKasir</h1>
    <div class="navbar-right">
      <form id="logoutForm" method="POST" action="{{ url('/logout') }}">
        @csrf
        <button type="button" class="logout-btn" id="btnLogout">Logout</button>
      </form>
    </div>
  </nav>

  @include('partials.sidebar')

  <!-- MAIN CONTENT -->
  <main class="main-content">
    <div class="table-wrap">
      <div class="table-header">
        <input type="text" id="searchInput" class="search-box" placeholder="Cari nama barang...">
        <button class="btn btn-primary" id="btnAdd">+ Tambah Barang</button>
      </div>

      <div class="table-container">
        @if(session('success'))
          <div style="background:#DCFCE7;color:#166534;padding:10px;border-radius:8px;margin:10px 0;">
            {{ session('success') }}
          </div>
        @endif

        <table class="table" id="barangTable">
          <thead>
            <tr>
              <th>No</th>
              <th>ID Barang</th>
              <th>Nama Barang</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($barang as $index => $b)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ str_pad($b->id_barang, 3, '0', STR_PAD_LEFT) }}</td>
                <td>{{ $b->nama_barang }}</td>
                <td>Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
                <td>{{ $b->stok }}</td>
                <td>
                  <button class="btn btn-secondary"
                          onclick="openEdit('{{ $b->id_barang }}','{{ addslashes($b->nama_barang) }}',{{ $b->harga }},{{ $b->stok }})">
                    Edit
                  </button>
                  <button class="btn btn-danger" onclick="openDelete('{{ $b->id_barang }}')">Hapus</button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div style="margin-top:16px; display:flex; justify-content:center;">
          {{ $barang->links('pagination::bootstrap-5') }}
        </div>
      </div>
    </div>
  </main>

  <!-- MODAL TAMBAH / EDIT -->
  <div class="overlay" id="formOverlay">
    <div class="xmodal edit-modal">
      <h3 id="modalTitle" class="modal-title">Edit Data Barang</h3>
      <form id="barangForm" method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" id="formMethod" value="POST">

        <div class="form-group">
          <label for="id_barang">ID Barang</label>
          <input type="text" id="id_barang" name="id_barang" placeholder="001">
          <small class="form-note"></small>
        </div>

        <div class="form-group">
          <label for="nama_barang">Nama Barang</label>
          <input type="text" name="nama_barang" id="nama_barang" required>
        </div>

        <div class="form-group">
          <label for="harga">Harga</label>
          <input type="number" name="harga" id="harga" required>
        </div>

        <div class="form-group">
          <label for="stok">Stok</label>
          <input type="number" name="stok" id="stok" required>
        </div>

        <div class="form-group">
          <label for="foto">Foto Barang</label>
          <input type="file" name="foto" id="foto" accept="image/*">
        </div>

        <div class="modal-actions">
          <button type="button" class="btn btn-secondary" id="btnCancel">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>

<!-- MODAL HAPUS -->
<div class="overlay" id="deleteOverlay">
  <div class="xmodal delete-modal" id="deleteModal">
    <svg class="warning-icon" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 9v4m0 4h.01M10.29 3.86a1.5 1.5 0 012.42 0l8.48 13.2A1.5 1.5 0 0119.88 19H4.12a1.5 1.5 0 01-1.31-1.94l8.48-13.2z"/>
    </svg>

    <h3 class="delete-title">Hapus Barang?</h3>
    <p class="delete-desc">
      Apakah Anda yakin ingin menghapus barang ini?<br>
      <span style="color:#ef4444;">Tindakan ini tidak dapat dibatalkan.</span>
    </p>

    <form id="deleteForm" method="POST">
      @csrf @method('DELETE')
      <div class="delete-actions">
        <button type="button" class="btn btn-secondary" id="cancelDelete">Batal</button>
        <button type="submit" class="btn btn-danger">Hapus</button>
      </div>
    </form>
  </div>
</div>


<script>
  // --- Modal logic ---
  const addBtn     = document.getElementById('btnAdd');
  const formOv     = document.getElementById('formOverlay');
  const delOv      = document.getElementById('deleteOverlay');
  const cancelForm = document.getElementById('btnCancel');
  const title      = document.getElementById('modalTitle');
  const form       = document.getElementById('barangForm');
  const method     = document.getElementById('formMethod');
  const note       = document.querySelector('.form-note');
  const idInput    = document.getElementById('id_barang');

  // Tambah barang
  addBtn.onclick = () => {
    formOv.classList.add('show');
    title.textContent = 'Tambah Barang';
    form.action = '{{ route("barang.store") }}';
    method.value = 'POST';
    form.reset();
    idInput.readOnly = false;
    note.textContent = '';
  };

  cancelForm.onclick = () => formOv.classList.remove('show');

  // Edit barang
  function openEdit(id, nama, harga, stok) {
    formOv.classList.add('show');
    title.textContent = 'Edit Barang';
    form.action = '/barang/' + id;
    method.value = 'PUT';
    idInput.value = String(id).padStart(3, '0');
    idInput.readOnly = true;
    note.textContent = 'ID Barang tidak dapat diubah saat edit.';
    document.getElementById('nama_barang').value = nama;
    document.getElementById('harga').value = harga;
    document.getElementById('stok').value = stok;
  }

  // Hapus barang (tanpa animasi ribet)
  function openDelete(id) {
    const form = document.getElementById('deleteForm');
    form.action = '/barang/' + id;
    delOv.classList.add('show');
  }

  // Saat klik batal di popup hapus
  document.getElementById('cancelDelete').onclick = () => delOv.classList.remove('show');

  // Saat submit form hapus → langsung kirim & tutup overlay
  document.getElementById('deleteForm').addEventListener('submit', function (e) {
    e.preventDefault();
    this.submit(); // langsung kirim ke Laravel
    delOv.classList.remove('show');
  });

  // Tutup overlay kalau klik luar modal
  formOv.addEventListener('click', e => { if (e.target === formOv) formOv.classList.remove('show'); });
  delOv.addEventListener('click', e => { if (e.target === delOv) delOv.classList.remove('show'); });

  // Live search AJAX
  const searchInput = document.getElementById('searchInput');
  const tbody = document.querySelector('#barangTable tbody');
  let searchTimeout = null;

  searchInput.addEventListener('keyup', function () {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(() => {
      const q = this.value.trim();

      fetch(`{{ route('barang.search') }}?q=${encodeURIComponent(q)}`)
        .then(res => res.json())
        .then(data => {
          tbody.innerHTML = '';
          if (!data || data.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" style="text-align:center;color:#64748B;">Tidak ada hasil</td></tr>`;
            return;
          }
          data.forEach((b, idx) => {
            const row = document.createElement('tr');
            row.innerHTML = `
              <td>${idx + 1}</td>
              <td>${String(b.id_barang).padStart(3, '0')}</td>
              <td>${b.nama_barang}</td>
              <td>Rp ${Number(b.harga).toLocaleString('id-ID')}</td>
              <td>${b.stok}</td>
              <td>
                <button class="btn btn-secondary"
                        onclick="openEdit('${b.id_barang}','${(b.nama_barang ?? '').replace(/'/g, "\\'")}',${b.harga},${b.stok})">
                  Edit
                </button>
                <button class="btn btn-danger" onclick="openDelete('${b.id_barang}')">Hapus</button>
              </td>`;
            tbody.appendChild(row);
          });
        })
        .catch(err => console.error('Search error:', err));
    }, 250);
  });
</script>


</body>
</html>
