<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<nav class="hk-navbar" data-aos="slide-down" data-aos-duration="700">
  <div class="hk-hamburger" onclick="toggleSidebar()">
    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
  </div>
  <h1 class="hk-navbar-title">HabeKasir</h1>
  <div class="hk-navbar-right">
    <form id="logoutForm" method="POST" action="{{ url('/logout') }}">
      @csrf
      <button type="button" class="hk-logout-btn" id="btnLogout">Logout</button>
    </form>
  </div>
</nav>

<!-- Overlay Logout (kelas unik) -->
<div class="hk-overlay-logout" id="logoutOverlay">
  <div class="hk-modal-logout">
    <h3>Konfirmasi Log Out</h3>
    <p>Apakah Anda yakin ingin keluar dari sistem?</p>
    <div class="modal-actions">
      <button class="hk-btn hk-btn-secondary" id="btnCancelLogout">Batal</button>
      <button class="hk-btn hk-btn-primary" id="btnConfirmLogout" style="background:#ef4444;">Ya, Logout</button>
    </div>
  </div>
</div>

<script>
  // Guard: toggleSidebar ada untuk mobile
  window.toggleSidebar = window.toggleSidebar || function(){
    const s = document.getElementById('sidebar'); if (s) s.classList.toggle('show');
  };

  // Script logout – shared untuk semua page
  (function(){
    const btnLogout  = document.getElementById('btnLogout');
    const overlay    = document.getElementById('logoutOverlay');
    const cancelBtn  = document.getElementById('btnCancelLogout');
    const confirmBtn = document.getElementById('btnConfirmLogout');
    const logoutForm = document.getElementById('logoutForm');
    if (!btnLogout || !overlay) return;

    btnLogout.addEventListener('click', ()=> overlay.classList.add('show'));
    cancelBtn.addEventListener('click', ()=> overlay.classList.remove('show'));
    overlay.addEventListener('click', e => { if(e.target === overlay) overlay.classList.remove('show'); });
    window.addEventListener('keydown', e => { if(e.key === 'Escape') overlay.classList.remove('show'); });
    confirmBtn.addEventListener('click', ()=> logoutForm.submit());
  })();
</script>
<script>
  AOS.init({
    once: true, // animasi muncul sekali aja (biar nggak ulang tiap scroll)
    offset: 20  // jarak pemicu animasi
  });
</script>