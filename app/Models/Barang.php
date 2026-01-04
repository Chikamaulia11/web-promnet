<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $guarded = []; 

    public function variants()
    {
        return $this->hasMany(BarangVariant::class, 'barang_id');
    }

    public function kategori()
    {
        return $this->belongsTo(DataKategori::class, 'kategori_id');
    }
}