<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaksi;

class TransaksiSeeder extends Seeder
{
    public function run(): void
    {
        Transaksi::create([
            'kode_transaksi' => 'TRX-2024-001',
            'jenis'          => 'masuk',
            'nama_orang'     => 'Andi Supplier',
            'kontak'         => '08123456789',
            'keterangan'     => 'Stok masuk dari vendor pusat',
            'tanggal'        => '2024-05-20',
        ]);

        Transaksi::create([
            'kode_transaksi' => 'TRX-2024-002',
            'jenis'          => 'keluar',
            'nama_orang'     => 'Budi Peminjam',
            'kontak'         => '08998877665',
            'keterangan'     => 'Pinjam untuk operasional lapangan',
            'tanggal'        => '2024-05-21',
        ]);
    }
}
