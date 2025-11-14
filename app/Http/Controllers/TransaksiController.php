<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    private function hitungTotal($cart)
    {
        return collect($cart)->sum(fn($c) => $c['harga'] * $c['qty']);
    }

    // ======================
    // HALAMAN UTAMA TRANSAKSI
    // ======================
    public function index(Request $r)
    {
        $q = trim((string)$r->q);
        $produk = Barang::when($q !== '', fn($qq) => $qq->where('nama_barang', 'like', "%{$q}%"))
            ->orderBy('nama_barang')
            ->paginate(20)
            ->withQueryString();

        $cart = session('cart', []);
        $total = $this->hitungTotal($cart);

        return view('transaksi.index', compact('produk', 'cart', 'total'));
    }

    // ======================
    // TAMBAH BARANG KE KERANJANG
    // ======================
    public function cartAdd(Request $r)
    {
        $barang = Barang::find($r->id_barang);
        if (!$barang) {
            return response()->json(['success' => false]);
        }

        // kalau stok 0, jangan bisa ditambahkan
        if ($barang->stok <= 0) {
            return response()->json([
                'success' => true,
                'cart'    => session('cart', []),
                'total'   => $this->hitungTotal(session('cart', []))
            ]);
        }

        $cart = session('cart', []);

        if (isset($cart[$barang->id_barang])) {
            $currentQty = $cart[$barang->id_barang]['qty'];

            // jika sudah mencapai stok maksimum, jangan tambah lagi
            if ($currentQty >= $barang->stok) {
                return response()->json([
                    'success' => true,
                    'cart'    => $cart,
                    'total'   => $this->hitungTotal($cart)
                ]);
            }

            $cart[$barang->id_barang]['qty']++;
        } else {
            // masukkan barang baru
            $cart[$barang->id_barang] = [
                'id_barang'   => $barang->id_barang,
                'nama_barang' => $barang->nama_barang,
                'harga'       => $barang->harga,
                'qty'         => 1
            ];
        }

        session(['cart' => $cart]);
        return response()->json([
            'success' => true,
            'cart'    => $cart,
            'total'   => $this->hitungTotal($cart)
        ]);
    }

    // ======================
    // TAMBAH JUMLAH (BTN +)
    // ======================
    public function cartInc(Request $r)
    {
        $cart = session('cart', []);
        $id = $r->id_barang;
        $barang = Barang::find($id);

        if (isset($cart[$id]) && $barang) {
            $currentQty = $cart[$id]['qty'];

            // jangan tambah kalau sudah mencapai stok maksimal
            if ($currentQty >= $barang->stok) {
                return response()->json([
                    'success' => true,
                    'cart'    => $cart,
                    'total'   => $this->hitungTotal($cart)
                ]);
            }

            $cart[$id]['qty']++;
        }

        session(['cart' => $cart]);
        return response()->json([
            'success' => true,
            'cart'    => $cart,
            'total'   => $this->hitungTotal($cart)
        ]);
    }

    // ======================
    // KURANGI JUMLAH (BTN -)
    // ======================
    public function cartDec(Request $r)
    {
        $cart = session('cart', []);
        $id = $r->id_barang;

        if (isset($cart[$id])) {
            $cart[$id]['qty']--;
            if ($cart[$id]['qty'] <= 0) unset($cart[$id]);
        }

        session(['cart' => $cart]);
        return response()->json([
            'success' => true,
            'cart'    => $cart,
            'total'   => $this->hitungTotal($cart)
        ]);
    }

    // ======================
    // HAPUS ITEM DARI KERANJANG
    // ======================
    public function cartRemove(Request $r)
    {
        $cart = session('cart', []);
        unset($cart[$r->id_barang]);
        session(['cart' => $cart]);

        return response()->json([
            'success' => true,
            'cart'    => $cart,
            'total'   => $this->hitungTotal($cart)
        ]);
    }

    // ======================
    // UPDATE JUMLAH MANUAL (input)
    // ======================
    public function cartSetQty(Request $r)
    {
        $cart = session('cart', []);
        $id = $r->id_barang;
        $qty = max(1, (int)$r->qty);
        $barang = Barang::find($id);

        if (isset($cart[$id]) && $barang) {
            // batasi supaya tidak bisa melebihi stok
            if ($qty > $barang->stok) {
                $qty = $barang->stok;
            }

            $cart[$id]['qty'] = $qty;
        }

        session(['cart' => $cart]);
        return response()->json([
            'success' => true,
            'cart'    => $cart,
            'total'   => $this->hitungTotal($cart)
        ]);
    }

    // ======================
    // CHECKOUT (SIMPAN TRANSAKSI)
    // ======================
   public function checkout(Request $r)
{
    $cart = session('cart', []);
    if (empty($cart)) {
        return back()->with('error', 'Keranjang masih kosong!');
    }

    if (!$r->metode_bayar) {
        return back()->with('error', 'Pilih metode pembayaran terlebih dahulu!');
    }

    DB::beginTransaction();
    try {
        // ====== 1️⃣ Simpan ke tabel transaksi ======
        $trx = Transaksi::create([
            'no_transaksi' => 'TRX' . time(),
            'tanggal'      => Carbon::now(),
            'metode_bayar' => $r->metode_bayar,
            'total_harga'  => collect($cart)->sum(fn($c) => $c['harga'] * $c['qty']),
        ]);

        // ====== 2️⃣ Simpan ke tabel detail_transaksi ======
        foreach ($cart as $item) {
            DetailTransaksi::create([
                'id_transaksi' => $trx->id_transaksi,
    'id_barang'      => $item['id_barang'], // tetap simpan
    'nama_barang'    => $item['nama_barang'], // fix disimpan
    'harga_barang'   => $item['harga'],       // fix disimpan
    'jumlah'         => $item['qty'],
    'subtotal'       => $item['harga'] * $item['qty'],
]);

            // ====== 3️⃣ Kurangi stok barang ======
            $barang = Barang::find($item['id_barang']);
            if ($barang) {
                $barang->decrement('stok', $item['qty']);
            }
        }

        DB::commit();

        // ====== 4️⃣ Hapus isi keranjang ======
        session()->forget('cart');

        return redirect()->route('laporan.index')->with('success', 'Transaksi berhasil disimpan!');
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
    }
}

    // ======================
    // UPDATE JUMLAH MELALUI INPUT LANGSUNG
    // ======================
    public function cartUpdateQty(Request $r)
    {
        $id = $r->id_barang;
        $qty = max(1, (int)$r->qty);
        $cart = session()->get('cart', []);
        $barang = Barang::find($id);

        if (isset($cart[$id]) && $barang) {
            // batasi supaya tidak bisa melebihi stok
            if ($qty > $barang->stok) {
                $qty = $barang->stok;
            }

            $cart[$id]['qty'] = $qty;
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'cart' => $cart,
            'total' => $this->hitungTotal($cart),
        ]);
    }
}
