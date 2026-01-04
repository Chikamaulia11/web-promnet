<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiDetailSeeder extends Seeder
{
    public function run(): void
    {
        $transaksi = Transaksi::where('kode_transaksi', 'TRX-2024-001')->first();

        if ($transaksi) {
            
            $listPercobaan = [
                ['variant_id' => 1, 'qty' => 10, 'harga' => 5000],
                ['variant_id' => 2, 'qty' => 2, 'harga' => 15000],
            ];

            foreach ($listPercobaan as $data) {
                TransaksiDetail::create([
                    'transaksi_id' => $transaksi->id,
                    'variant_id'   => $data['variant_id'],
                    'qty'          => $data['qty'],
                    'harga_satuan' => $data['harga'],
                    'sub_total'    => $data['qty'] * $data['harga'],
                ]);
            }
            
            $this->command->info("Percobaan detail transaksi berhasil masuk!");
        } else {
            $this->command->error("Transaksi tidak ditemukan! Jalankan TransaksiSeeder dulu.");
        }
    
    }
}
