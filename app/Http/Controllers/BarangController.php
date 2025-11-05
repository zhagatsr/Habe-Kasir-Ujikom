<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    /**
     * Tampilkan daftar barang.
     */
   public function index(Request $request)
{
    $q = trim($request->get('q', ''));

    $barang = Barang::query()
        ->when($q !== '', function ($query) use ($q) {
            $query->where('nama_barang', 'like', "%{$q}%")
                  ->orWhere('id_barang', 'like', "%{$q}%");
        })
        ->orderBy('id_barang', 'asc')
        ->paginate(20)
        ->withQueryString(); // biar pagination tetap menyertakan ?q=
    
    return view('barang.index', compact('barang', 'q'));
}

public function search(Request $r)
{
    $q = trim($r->q ?? '');

    $barang = Barang::query()
        ->when($q !== '', fn($qq) =>
            $qq->where('nama_barang', 'like', "%{$q}%")
               ->orWhere('id_barang', 'like', "%{$q}%")
        )
        ->orderBy('id_barang', 'asc')
        ->limit(50) // biar gak terlalu berat
        ->get();

    return response()->json($barang);
}


    /**
     * Simpan barang baru.
     */
    public function store(Request $r)
    {
        $r->validate([
            'id_barang'   => 'required|string|max:10|unique:barang,id_barang',
            'nama_barang' => 'required|string|max:120',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $barang = new Barang();
        $barang->id_barang   = $r->id_barang;
        $barang->nama_barang = $r->nama_barang;
        $barang->harga       = $r->harga;
        $barang->stok        = $r->stok;

        // Upload foto jika ada
        if ($r->hasFile('foto')) {
            $file = $r->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/barang'), $filename);
            $barang->foto = $filename;
        }

        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    /**
     * Perbarui barang.
     */
    public function update(Request $r, $id)
    {
        $r->validate([
            'nama_barang' => 'required|string|max:120',
            'harga'       => 'required|numeric|min:0',
            'stok'        => 'required|integer|min:0',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $barang = Barang::findOrFail($id);

        $barang->nama_barang = $r->nama_barang;
        $barang->harga       = $r->harga;
        $barang->stok        = $r->stok;

        // Jika user upload foto baru, hapus yang lama (jika ada)
        if ($r->hasFile('foto')) {
            if ($barang->foto && file_exists(public_path('uploads/barang/'.$barang->foto))) {
                unlink(public_path('uploads/barang/'.$barang->foto));
            }

            $file = $r->file('foto');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('uploads/barang'), $filename);
            $barang->foto = $filename;
        }

        $barang->save();

        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    /**
     * Hapus barang.
     */
    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        // Hapus foto dari folder jika ada
        if ($barang->foto && file_exists(public_path('uploads/barang/'.$barang->foto))) {
            unlink(public_path('uploads/barang/'.$barang->foto));
        }

        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
