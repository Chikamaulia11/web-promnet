<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BarangVariantController extends Controller
{
    public function index()
    {
        $variants = BarangVariant::with('barang')->get();
        return view('pages.variant.index', compact('variants'));
    }

    public function create(Request $request)
    {
        $barangId = $request->get('barang_id');
        $barang = Barang::findOrFail($barangId);
        return view('pages.variant.create', compact('barang'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id'    => 'required|exists:barangs,id',
            'nama_variant' => 'required|string',
            'harga'        => 'required|numeric',
            'stok'         => 'required|numeric',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        // --- LOGIKA SKU OTOMATIS ---
        $cleanVariant = strtoupper(preg_replace('/[^A-Za-z0-9]/', '-', $request->nama_variant)); 
        $data['sku'] = $cleanVariant . '-' . rand(100, 999);
        
        // --- LOGIKA UPLOAD FOTO ---
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('assets/img'), $nama_file);
            $data['foto'] = $nama_file;
        }

        BarangVariant::create($data);

        return redirect()->route('barang.show', $request->barang_id)
                         ->with('success', 'Varian baru berhasil ditambahkan!');
    }

    public function edit(BarangVariant $variant)
    {
        $barang = Barang::findOrFail($variant->barang_id);
        return view('pages.variant.edit', compact('variant', 'barang'));
    }

    public function update(Request $request, BarangVariant $variant)
    {
        $request->validate([
            'nama_variant' => 'required|string',
            'harga'        => 'required|numeric',
            'stok'         => 'required|numeric',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->except(['_token', '_method']);

        // --- LOGIKA UPDATE FOTO ---
        if ($request->hasFile('foto')) {
            if ($variant->foto && File::exists(public_path('assets/img/' . $variant->foto))) {
                File::delete(public_path('assets/img/' . $variant->foto));
            }

            $file = $request->file('foto');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('assets/img'), $nama_file);
            $data['foto'] = $nama_file;
        }

        $variant->update($data);

        return redirect()->route('barang.show', $variant->barang_id)
                         ->with('success', 'Data varian berhasil diperbarui!');
    }

    public function destroy(BarangVariant $variant)
    {
        $barang_id = $variant->barang_id;

        if ($variant->foto && File::exists(public_path('assets/img/' . $variant->foto))) {
            File::delete(public_path('assets/img/' . $variant->foto));
        }

        $variant->delete();
        
        return redirect()->route('barang.show', $barang_id)
                         ->with('success', 'Varian berhasil dihapus!');
    }
}