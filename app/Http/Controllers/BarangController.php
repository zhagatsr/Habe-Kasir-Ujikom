<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    /**
     * Tampilkan daftar barang.
     */
    public function index()
    {
        $barang = Barang::orderBy('id_barang')->get();
        return view('barang.index', compact('barang'));
    }

    /**
     * Simpan barang baru.
     */
    public function store(Request $r)
    {
        $r->validate([
            'nama_barang' => 'required|string|max:120',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        Barang::create([
            'nama_barang' => $r->nama_barang,
            'harga' => $r->harga,
            'stok' => $r->stok,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Perbarui barang.
     */
    public function update(Request $r, $id)
    {
        $r->validate([
            'nama_barang' => 'required|string|max:120',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
        ]);

        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama_barang' => $r->nama_barang,
            'harga' => $r->harga,
            'stok' => $r->stok,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Hapus barang.
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
