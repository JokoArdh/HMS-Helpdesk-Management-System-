<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['kategori_id','kode_barang', 'nama_barang', 'merk', 'satuan', 'kondisi', 'stok'];

    // 1 barang memiliki 1 kategory
    public function category(){
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
    // 1 barang bisa punya banyak transaksi
    public function transaksis(){
        return $this->hasMany(Transaksi::class);
    }


}
