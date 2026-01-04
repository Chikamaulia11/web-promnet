<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\DataKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $kategoriId = DataKategori::where('nama_kategori', 'Lampu')->first()->id;

        Barang::create([
            "nama_barang" => "Lampu LED Hannochs Premier",
            "kategori_id" => $kategoriId,
            "deskripsi"   => "Lampu LED kualitas premium, hemat energi.",
        ]);

    }
}
