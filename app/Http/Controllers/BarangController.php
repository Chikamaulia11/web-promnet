<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\DataKategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    
    public function index()
    {
        
        $barangs = Barang::with('kategori')->get();
        return view('pages.barang.index', compact('barangs'));
    }

    public function create()
    {
        $kategori = DataKategori::all(); 
        return view('pages.barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|min:3',
            'kategori_id' => 'required',
        ]);

        Barang::create([
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'deskripsi'   => $request->deskripsi,
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil disimpan!');
    }

    public function show(Barang $barang)
    {
        
        $barang->load('variants'); 
        
        return view('pages.variant.index', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        $kategori = DataKategori::all();
        return view('pages.barang.edit', compact('barang', 'kategori'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|min:3',
            'kategori_id' => 'required',
        ]);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'deskripsi'   => $request->deskripsi,
        ]);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diubah!');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}