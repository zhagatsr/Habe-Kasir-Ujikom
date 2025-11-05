<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>HabeKasir - Barang</title>
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
    @keyframes bgMove{0%{background-position:left top;}100%{background-position:right bottom;}}

    .navbar{height:64px;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,.1);
      display:flex;justify-content:space-between;align-items:center;padding:0 24px;
      position:fixed;top:0;width:100%;z-index:1000;}
    .navbar-title{font-size:20px;font-weight:700;color:var(--ink);}
    .navbar-right{display:flex;align-items:center;gap:16px;}
    .logout-btn{background:var(--primary);color:#fff;border:0;padding:8px 16px;border-radius:8px;cursor:pointer;}
    .logout-btn:hover{background:#0F3A5F;}
    .hamburger{display:none;cursor:pointer;}

    .sidebar{width:250px;background:#fff;box-shadow:2px 0 8px rgba(0,0,0,.1);
      position:fixed;top:64px;left:0;height:calc(100vh - 64px);padding:24px 0;overflow-y:auto;}
    .sidebar-menu{list-style:none;margin:0;padding:0;}
    .sidebar-menu li{padding:12px 24px;display:flex;align-items:center;gap:12px;color:var(--ink);cursor:pointer;}
    .sidebar-menu li svg{flex-shrink:0;}
    .sidebar-menu li.active{background:var(--primary);color:#fff;}
    .sidebar-menu li:not(.active):hover{background:#F1F5F9;}

    .main-content{margin-top:64px;margin-left:250px;padding:24px;flex:1;opacity:0;transform:translateY(8px);animation:fadeIn .4s ease-out .05s forwards;}
    @keyframes fadeIn{to{opacity:1;transform:none;}}

    .table-wrap{background:#fff;border-radius:12px;box-shadow:0 6px 16px rgba(0,0,0,0.1);padding:20px;animation:fadeIn .4s ease-out;}
    .table{width:100%;border-collapse:collapse;}
    .table th{background:var(--primary);color:#fff;text-align:left;padding:10px;}
    .table td{padding:10px;border-bottom:1px solid #eee;color:#1E293B;}
    .table tr:hover{background:#f9fafb;transition:background .2s ease;}
    .table-wrap {
  position: relative; /* penting supaya pseudo-element bisa posisi absolut */
  overflow: hidden;
}

.table-wrap::before {
  content: "";
  position: absolute;
  top: 0;
  left: -30%;
  width: 60%;
  height: 3px;
  background: linear-gradient(90deg, transparent, rgba(19,70,134,.4), transparent);
  transform: translateX(-100%);
  animation: shimmer 2.2s ease-in-out infinite;
}

@keyframes shimmer {
  0% { transform: translateX(-100%); }
  100% { transform: translateX(400%); }
}

.table-wrap {
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(19,70,134,0.15); /* biru halus */
  padding: 20px;
  position: relative;
  overflow: hidden;
  animation: fadeIn .4s ease-out;
}


    .btn{border:0;border-radius:8px;padding:8px 14px;cursor:pointer;font-weight:500;}
    .btn-primary{background:var(--primary);color:#fff;}
    .btn-primary:hover{background:#0F3A5F;}
    .btn-danger{background:#ef4444;color:#fff;}
    .btn-danger:hover{background:#dc2626;}
    .btn-secondary{background:#E5E7EB;color:#111827;}

    .search-box{border:1px solid #e0e0e0;padding:10px 12px;border-radius:8px;width:250px;}
    .search-box:focus{outline:none;border-color:var(--primary);}

    .overlay{position:fixed;inset:0;background:rgba(15,23,42,.45);display:none;place-items:center;z-index:1200;backdrop-filter:saturate(120%) blur(4px);}
    .overlay.show{display:grid;animation:fadeOverlay .2s ease-out;}
    @keyframes fadeOverlay{from{opacity:0;}to{opacity:1;}}

    .modal{width:min(440px,92vw);background:#fff;border-radius:12px;box-shadow:0 20px 60px rgba(0,0,0,.25);padding:22px;text-align:left;transform:scale(.96);opacity:0;animation:pop .25s ease-out forwards;}
    @keyframes pop{to{transform:none;opacity:1;}}
    .modal h3{margin:8px 0 6px;color:var(--ink);font-size:18px;}
    .modal label{font-weight:600;font-size:14px;color:var(--ink);}
    .modal input{width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;margin:6px 0;}
    .modal-actions{display:flex;justify-content:flex-end;gap:8px;margin-top:10px;}

    .edit-modal {
  width: min(500px, 92vw);
  padding: 32px;
  border-radius: 12px;
  box-shadow: 0 25px 60px rgba(0,0,0,0.25);
  background: #fff;
  text-align: left;
}

.modal-title {
  text-align: center;
  font-weight: 700;
  color: #1E293B;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 14px;
}

.form-group label {
  display: block;
  font-weight: 600;
  color: #1E293B;
  font-size: 14px;
  margin-bottom: 5px;
}

.form-group input {
  width: 100%;
  padding: 10px;
  border: 1px solid #CBD5E1;
  border-radius: 8px;
  font-size: 14px;
}

.form-group input[readonly] {
  background: #F1F5F9;
  color: #475569;
  cursor: not-allowed;
}

.form-note {
  display: block;
  margin-top: 5px;
  font-size: 12px;
  color: #94A3B8;
}

.modal-actions {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-top: 20px;
}

.btn-secondary {
  background: #F1F5F9;
  color: #1E293B;
  border: 1px solid #E2E8F0;
  transition: all .2s ease;
}
.btn-secondary:hover {
  background: #E2E8F0;
}

.btn-primary {
  background: #134686;
  color: #fff;
  border: none;
  transition: all .2s ease;
}
.btn-primary:hover {
  background: #0F3A5F;
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



  <!-- MAIN CONTENT -->
  <main class="main-content">
    <div class="table-wrap">
      <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
        <input type="text" id="searchInput" class="search-box" placeholder="Cari nama barang...">
        <button class="btn btn-primary" id="btnAdd">+ Tambah Barang</button>
      </div>

      @if(session('success'))
        <div style="background:#DCFCE7;color:#166534;padding:10px;border-radius:8px;margin-bottom:10px;">
          {{ session('success') }}
        </div>
      @endif

      <table class="table" id="barangTable">
        <thead>
          <tr>
            <th>No</th><th>ID Barang</th><th>Nama Barang</th><th>Harga</th><th>Stok</th><th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($barang as $index => $b)
          <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ str_pad($b->id_barang, 3, '0', STR_PAD_LEFT) }}</td>
            <td>{{ $b->nama_barang }}</td>
            <td>Rp {{ number_format($b->harga, 0, ',', '.') }}</td>
            <td>{{ $b->stok }}</td>
            <td>
              <button class="btn btn-secondary" onclick="openEdit({{ $b->id_barang }}, '{{ $b->nama_barang }}', {{ $b->harga }}, {{ $b->stok }})">Edit</button>
              <button class="btn btn-danger" onclick="openDelete({{ $b->id_barang }})">Hapus</button>
            </td>
          </tr>
          @empty
          <tr><td colspan="6" style="text-align:center;color:#64748B;">Belum ada data</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </main>

 <!-- Modal Tambah/Edit -->
<div class="overlay" id="formOverlay">
  <div class="modal edit-modal">
    <h3 id="modalTitle" class="modal-title">Edit Data Barang</h3>
    <form id="barangForm" method="POST" action="{{ route('barang.store') }}">
      @csrf
      <input type="hidden" name="_method" id="formMethod" value="POST">

      <div class="form-group">
        <label for="id_barang">ID Barang</label>
        <input type="text" id="id_barang" name="id_barang" readonly placeholder="001">
        <small class="form-note">ID Barang tidak dapat diubah.</small>
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

      <div class="modal-actions">
        <button type="button" class="btn btn-secondary" id="btnCancel">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
      </div>
    </form>
  </div>
</div>


  <!-- Modal Hapus -->
  <div class="overlay" id="deleteOverlay">
    <div class="modal">
      <h3>Hapus Barang</h3>
      <p>Apakah Anda yakin ingin menghapus barang ini?</p>
      <form id="deleteForm" method="POST">
        @csrf @method('DELETE')
        <div class="modal-actions">
          <button type="button" class="btn btn-secondary" id="cancelDelete">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Logout -->
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

    const addBtn = document.getElementById('btnAdd');
    const formOv = document.getElementById('formOverlay');
    const delOv = document.getElementById('deleteOverlay');
    const cancelForm = document.getElementById('btnCancel');
    const cancelDel = document.getElementById('cancelDelete');
    const title = document.getElementById('modalTitle');
    const form = document.getElementById('barangForm');
    const method = document.getElementById('formMethod');

    addBtn.onclick = () => { formOv.classList.add('show'); title.textContent = 'Tambah Barang'; form.action = '{{ route("barang.store") }}'; method.value = 'POST'; form.reset(); };
    cancelForm.onclick = () => formOv.classList.remove('show');
    cancelDel.onclick = () => delOv.classList.remove('show');

   function openEdit(id,nama,harga,stok){
  formOv.classList.add('show');
  title.textContent='Edit Barang';
  form.action='/barang/'+id;
  method.value='PUT';

  // tampilkan ID Barang dengan format 3 digit tanpa prefix
  document.getElementById('kode_barang').value = String(id).padStart(3, '0');

  // isi input lain
  nama_barang.value = nama;
  harga.value = harga;
  stok.value = stok;
}


    function openDelete(id){ delOv.classList.add('show'); document.getElementById('deleteForm').action='/barang/'+id; }
    formOv.addEventListener('click',e=>{if(e.target===formOv)formOv.classList.remove('show');});
    delOv.addEventListener('click',e=>{if(e.target===delOv)delOv.classList.remove('show');});

    const searchInput=document.getElementById('searchInput');
    searchInput.addEventListener('keyup',()=>{const filter=searchInput.value.toLowerCase();document.querySelectorAll('#barangTable tbody tr').forEach(row=>{const name=row.cells[2].textContent.toLowerCase();row.style.display=name.includes(filter)?'':'';});});

    const btnLogout=document.getElementById('btnLogout'),overlayLogout=document.getElementById('logoutOverlay'),cancelBtn=document.getElementById('btnCancelLogout'),confirmBtn=document.getElementById('btnConfirmLogout'),logoutForm=document.getElementById('logoutForm');
    btnLogout.addEventListener('click',()=>overlayLogout.classList.add('show'));
    cancelBtn.addEventListener('click',()=>overlayLogout.classList.remove('show'));
    overlayLogout.addEventListener('click',e=>{if(e.target===overlayLogout)overlayLogout.classList.remove('show');});
    window.addEventListener('keydown',e=>{if(e.key==='Escape')overlayLogout.classList.remove('show');});
    confirmBtn.addEventListener('click',()=>logoutForm.submit());
  </script>
</body>
</html>
