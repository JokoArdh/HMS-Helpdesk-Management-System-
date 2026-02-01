<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kategori', 'icon'];

    // return darirelasi FK barang = 1 kategori dimiliki bnyak barang
    public function barangs(){
       return $this->hasMany(Barang::class);
    }
}
