<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Controllers\TransaksiDetailController;
use App\Models\BarangVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaksi::query();
        $judul = $request->is('transaksi-masuk*') ? "Daftar Transaksi Masuk" : "Daftar Transaksi Keluar";
        $jenis = $request->is('transaksi-masuk*') ? "masuk" : "keluar";

        $list_data = $query->where('jenis', $jenis)->latest()->get();
        return view('pages.transaksi.index', compact('list_data', 'judul'));
    }

    public function create(Request $request)
    {
        $judul = $request->is('transaksi-masuk*') ? "Tambah Transaksi Masuk" : "Tambah Transaksi Keluar";
        $jenis = $request->is('transaksi-masuk*') ? "masuk" : "keluar";
        $barangs = BarangVariant::with('barang')->get();
        return view('pages.transaksi.create', compact('judul', 'jenis', 'barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_orang' => 'required',
            'jenis'      => 'required|in:masuk,keluar',
            'tanggal'    => 'required|date',
            'data'       => 'required|array', 
        ]);

        // --- 1. CEK STOK  ---
        if ($request->jenis == 'keluar') {
            foreach ($request->data as $item) {
                $v = BarangVariant::with('barang')->find($item['variant_id']);
                if ($v->stok < $item['qty']) {
                    return back()->with('error', "Stok Gagal! {$v->barang->nama_barang} ({$v->nama_variant}) sisa {$v->stok}.")->withInput();
                }
            }
        }

        try {
            DB::beginTransaction();

            $transaksi = Transaksi::create([
                'kode_transaksi' => 'TRX-' . date('Ymd') . '-' . rand(100, 999),
                'jenis'          => $request->jenis,
                'nama_orang'     => $request->nama_orang,
                'kontak'         => $request->kontak,
                'keterangan'     => $request->keterangan,
                'tanggal'        => $request->tanggal,
            ]);

            $detailCtrl = new TransaksiDetailController();
            $detailCtrl->storeDetail($transaksi->id, $request->jenis, $request->data);

            DB::commit();
            return redirect($request->jenis == 'masuk' ? '/transaksi-masuk' : '/transaksi-keluar')->with('success', 'Transaksi Berhasil!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal: ' . $e->getMessage())->withInput();
        }
    }

    public function show($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $list_detail = $transaksi->details()->with('variant.barang')->get();
        return view('pages.transaksi.show', compact('transaksi', 'list_detail'));
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $detailCtrl = new TransaksiDetailController();
            $detailCtrl->rollbackStok($id);
            Transaksi::destroy($id);
            DB::commit();
            return redirect()->back()->with('success', 'Transaksi dihapus & stok diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage());
        }
    }
}