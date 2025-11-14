<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Laporan Penjualan - HabeKasir</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      padding: 40px;
      background: #fff;
      color: #1e293b;
    }
    h2 {
      text-align: center;
      margin-bottom: 10px;
      color: #134686;
    }
    p { text-align: center; margin: 0; color: #555; }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
      font-size: 14px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
    }
    th {
      background: #134686;
      color: #fff;
    }
    tr:nth-child(even) {
      background: #f8fafc;
    }
    .summary {
      margin-top: 30px;
      font-size: 15px;
    }
    .summary p {
      margin: 5px 0;
    }
    @media print {
      body { padding: 0; }
      button { display: none; }
    }
  </style>
</head>
<body>
  <h2>Laporan Penjualan HabeKasir</h2>
  <p>Periode: <strong>{{ $tanggal ? $tanggal : 'Semua Tanggal' }}</strong></p>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>ID Transaksi</th>
        <th>Tanggal</th>
        <th>Metode Pembayaran</th>
        <th>Total Harga</th>
      </tr>
    </thead>
    <tbody>
      @forelse($transaksi as $i => $t)
      <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $t->no_transaksi }}</td>
        <td>{{ \Carbon\Carbon::parse($t->tanggal)->format('Y-m-d') }}</td>
        <td>{{ strtoupper($t->metode_bayar) }}</td>
        <td>Rp{{ number_format($t->total_harga, 0, ',', '.') }}</td>
      </tr>
      @empty
      <tr><td colspan="5" class="text-center text-muted">Tidak ada data transaksi</td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="summary">
    <p><strong>Total Transaksi:</strong> {{ $totalTransaksi }}</p>
    <p><strong>Total Penjualan:</strong> Rp{{ number_format($totalPenjualan, 0, ',', '.') }}</p>
  </div>

  <div style="text-align:center; margin-top:40px;">
    <button onclick="window.print()" style="padding:10px 25px;background:#134686;color:#fff;border:none;border-radius:6px;cursor:pointer;">
      🖨️ Cetak Sekarang
    </button>
  </div>
</body>
</html>
