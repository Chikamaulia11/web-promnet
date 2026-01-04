<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id', 
        'nama_variant', 
        'sku', 
        'harga', 
        'stok', 
        'foto'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    

    public function transaksi_details()
    {
        return $this->hasMany(TransaksiDetail::class, 'variant_id');
    }

}