<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use App\Models\BarangVariant;
use App\Models\Transaksi;

class TransaksiDetailController extends Controller
{
    public function storeDetail($transaksi_id, $jenis, $dataArray)
    {
        foreach ($dataArray as $data) {
            $variant = BarangVariant::findOrFail($data['variant_id']);
            
            TransaksiDetail::create([
                'transaksi_id' => $transaksi_id,
                'variant_id'   => $data['variant_id'],
                'qty'          => $data['qty'],
                'harga_satuan' => $data['harga_satuan'] ?? 0,
                'sub_total'    => ($data['qty'] * ($data['harga_satuan'] ?? 0)),
            ]);

            if ($jenis == 'masuk') {
                $variant->increment('stok', $data['qty']);
            } else {
                $variant->decrement('stok', $data['qty']);
            }
        }
    }

    public function rollbackStok($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $details = TransaksiDetail::where('transaksi_id', $id)->get();

        foreach ($details as $data) {
            $variant = BarangVariant::find($data->variant_id);
            if ($variant) {
                if ($transaksi->jenis == 'masuk') {
                    $variant->decrement('stok', $data->qty);
                } else {
                    $variant->increment('stok', $data->qty);
                }
            }
        }
        TransaksiDetail::where('transaksi_id', $id)->delete();
    }
}