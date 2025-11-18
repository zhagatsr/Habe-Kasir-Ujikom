
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/tsparticles@3/tsparticles.bundle.min.js"></script>


<aside class="sidebar" id="sidebar" data-aos="slide-right" data-aos-duration="800">
  <ul class="sidebar-menu">

      <li data-aos="slide-right" data-aos-delay="100"
          class="{{ request()->is('dashboard') ? 'active' : '' }}"
        onclick="window.location.href='{{ url('/dashboard') }}'">
      <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
      </svg>
      Dashboard
    </li>

    <li data-aos="slide-right" data-aos-delay="200"
        class="{{ request()->is('transaksi*') ? 'active' : '' }}"
        onclick="window.location.href='{{ url('/transaksi') }}'">
      <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
      </svg>
      Transaksi
    </li>

    <li data-aos="slide-right" data-aos-delay="300"
        class="{{ request()->is('barang*') ? 'active' : '' }}"
        onclick="window.location.href='{{ url('/barang') }}'">
      <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 2L3 7v11a1 1 0 001 1h3a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1h3a1 1 0 001-1V7l-7-5z" clip-rule="evenodd"></path>
      </svg>
      Barang
    </li>

    <li data-aos="slide-right" data-aos-delay="400"
        class="{{ request()->is('laporan*') ? 'active' : '' }}"
        onclick="window.location.href='{{ url('/laporan') }}'">
      <svg width="20" height="20" fill="currentColor" viewBox="0 0 20 20">
        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      Laporan
    </li>

  </ul>
</aside>
<script>
  AOS.init({
    once: true, // animasi muncul sekali aja (biar nggak ulang tiap scroll)
    offset: 20  // jarak pemicu animasi
  });
</script>
