<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        
        // Total barang masuk (QTY)
        $totalMasuk = DB::table('transaksi_details')
            ->join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->where('transaksis.jenis', 'masuk')
            ->sum('qty') ?? 0;

        // TOTAL barang keluar (QTY)
        $totalKeluar = DB::table('transaksi_details')
            ->join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->where('transaksis.jenis', 'keluar')
            ->sum('qty') ?? 0;

        // Biaya keluar (pinjam) -> Diambil dari transaksi 'masuk'
        $biayaKeluar = DB::table('transaksi_details')
            ->join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->where('transaksis.jenis', 'keluar')
            ->sum(DB::raw('qty * harga_satuan')) ?? 0;

        // Biaya diterima (kembali) -> Diambil dari transaksi 'keluar'
        $biayaDiterima = DB::table('transaksi_details')
            ->join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->where('transaksis.jenis', 'masuk')
            ->sum(DB::raw('qty * harga_satuan')) ?? 0;

        return view('user', compact(
            'totalMasuk', 
            'totalKeluar', 
            'biayaKeluar', 
            'biayaDiterima', 
        ));
    }
}