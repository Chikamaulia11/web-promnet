<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\DataKategori;
use App\Models\Kategori; 
use App\Models\BarangVariant;
use Illuminate\Database\Seeder;

class BarangVariantSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = DataKategori::firstOrCreate(['nama_kategori' => 'Elektronik']);
        $barang = Barang::firstOrCreate(
            ['nama_barang' => 'Lampu LED Hannochs Premier'],
            [
                'kategori_id' => $kategori->id,
                'deskripsi' => 'Lampu LED kualitas premium'
            ]
        );

        $barangId = $barang->id;
        // Varian 1
        BarangVariant::create([
            'barang_id'    => $barangId,
            'nama_variant' => 'Lampu tidur',
            'sku'          => 'HNC-05W',
            'harga'        => 25000,
            'stok'         => 100,
            'foto'         => null,
        ]);

        // Varian 2
        BarangVariant::create([
            'barang_id'    => $barangId,
            'nama_variant' => 'lampu disko',
            'sku'          => 'HNC-10W',
            'harga'        => 45000,
            'stok'         => 50,
            'foto'         => null,
        ]);

        // Varian 3
        BarangVariant::create([
            'barang_id'    => $barangId,
            'nama_variant' => 'lampu merah',
            'sku'          => 'HNC-15W',
            'harga'        => 65000,
            'stok'         => 30,
            'foto'         => null,
        ]);
    }
}