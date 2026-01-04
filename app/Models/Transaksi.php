<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'jenis',
        'nama_orang',
        'kontak',
        'keterangan',
        'tanggal'
    ];

    public function details()
    {
        return $this->hasMany(TransaksiDetail::class, 'transaksi_id');

    }
}