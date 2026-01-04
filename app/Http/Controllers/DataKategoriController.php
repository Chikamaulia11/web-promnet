<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKategori;

class DataKategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = DataKategori::query();

        // Search
        if ($request->filled('search')) {
            $query->where('nama_kategori', 'like', '%' . $request->search . '%');
        }

        $kategori = $query->paginate(10)->withQueryString();

        return view("pages.kategori.index", compact('kategori'));
    }

    public function create()
    {
        return view('pages.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaKategori' => 'required|min:3|unique:data_kategoris,nama_kategori',
        ], [
            'namaKategori.required' => 'Nama kategori wajib diisi!',
            'namaKategori.unique' => 'Nama kategori sudah ada.',
        ]);

        DataKategori::create([
            'nama_kategori' => $request->namaKategori
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function edit(string $id)
    {
        $kategori = DataKategori::findOrFail($id);
        return view('pages.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'namaKategori' => 'required|min:3|unique:data_kategoris,nama_kategori,' . $id,
        ], [
            'namaKategori.required' => 'Nama kategori tidak boleh kosong!',
            'namaKategori.unique' => 'Nama kategori sudah ada!',
        ]);

        $kategori = DataKategori::findOrFail($id);

        $kategori->update([
            'nama_kategori' => $request->namaKategori
        ]);

        return redirect()->route('kategori.index')
            ->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        DataKategori::destroy($id);
        return redirect()->route('kategori.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
