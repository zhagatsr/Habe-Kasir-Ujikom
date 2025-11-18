<script src="https://cdn.jsdelivr.net/npm/tsparticles@3/tsparticles.bundle.min.js"></script>

<style>
  /* ==== APP NAVBAR (prefiks hk- agar tidak bentrok Bootstrap) ==== */
  .hk-navbar{
    height:64px;background:#fff;box-shadow:0 2px 8px rgba(0,0,0,.1);
    display:flex;justify-content:space-between;align-items:center;padding:0 24px;
    position:fixed;top:0;width:100%;z-index:1000;
  }
  .hk-navbar-title{font-size:20px;font-weight:700;color:var(--ink);}
  .hk-navbar-right{display:flex;align-items:center;gap:16px;}
  .hk-hamburger{display:none;cursor:pointer;}
  .hk-logout-btn{background:var(--primary);color:#fff;border:0;padding:8px 16px;border-radius:8px;cursor:pointer;}
  .hk-logout-btn:hover{background:#0F3A5F;}
  @media (max-width:768px){ .hk-hamburger{display:block} .hk-navbar-right{display:none} }

  /* ==== Popup Logout (kelas unik) ==== */
  .hk-overlay-logout{
    position:fixed;inset:0;background:rgba(15,23,42,.45);
    display:none;place-items:center;z-index:1300;backdrop-filter:saturate(120%) blur(4px);
  }
  .hk-overlay-logout.show{display:grid;animation:hkFadeOverlay .2s ease-out;}
  @keyframes hkFadeOverlay{from{opacity:0}to{opacity:1}}
  .hk-modal-logout{
    width:min(440px,92vw);background:#fff;border-radius:12px;
    box-shadow:0 20px 60px rgba(0,0,0,.25);
    padding:22px;text-align:center;transform:scale(.96);opacity:0;animation:hkPop .25s ease-out forwards;
  }
  @keyframes hkPop{to{transform:none;opacity:1}}
  .hk-modal-logout h3{margin:8px 0 6px;color:var(--ink);font-size:18px;}
  .hk-modal-logout p{margin:0 0 16px;color:var(--muted);font-size:14px;}
  .hk-modal-logout .modal-actions{display:flex;gap:10px;justify-content:center;}

  /* Tombol umum (aman bareng Bootstrap) */
  .hk-btn{border:0;border-radius:8px;padding:10px 14px;cursor:pointer;}
  .hk-btn-secondary{background:#EFF4FA;color:#0f172a;}
  .hk-btn-primary{background:var(--primary);color:#fff;}
  .hk-btn-primary:hover{background:#0F3A5F;}
  /* === Efek Interaktif Sidebar Item === */
.sidebar-menu li {
  transition: transform 0.2s ease, background 0.25s ease, box-shadow 0.25s ease;
  position: relative;
}

/* ==== HOVER MEGA-POPPY ==== */
.sidebar-menu li:hover {
  transform: translateX(10px) scale(1.07);
  background: rgba(19, 70, 134, 0.18);
  box-shadow: 0 6px 16px rgba(19,70,134,0.28);
  border-left: 4px solid var(--primary);
  backdrop-filter: blur(2px);
}

/* Aktif tetap beda warna tapi lembut */
.sidebar-menu li.active {
  background: var(--primary);
  color: #fff;
  transform: scale(1.03);
  box-shadow: 0 4px 14px rgba(19,70,134,0.4);
}

/* Tambah sedikit efek cahaya gerak saat hover */
.sidebar-menu li::after {
  content: "";
  position: absolute;
  top: 0;
  left: -30%;
  width: 30%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(77, 85, 197, 0.15), transparent);
  transform: translateX(-100%);
  transition: opacity 0.2s ease;
  opacity: 0;
}
.sidebar-menu li:hover::after {
   animation: rowShimmerLoop 1s linear infinite;
  opacity: 1;
}
@keyframes rowShimmerLoop {
  0% { left: -60%; }
  100% { left: 100%; }
}

</style>
