<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keluhan extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'acc_by', 'kategori', 'keterangan', 'tgl_keluhan', 'bukti', 'status', 'tgl_selesai'];

    /**
     * Relasi ke user
     * 1 keluhan dimiliki 1 user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //mengetahui Manager IT menutup kasus tiket
    public function mengetahui(){
        return $this->belongsTo(User::class, 'acc_by');
    }
    /**
     * Relasi ke riwayat
     * 1 keluhan bisa punya banyak riwayat
     */
    public function riwayats(){
        return $this->hasMany(Riwayat::class);  
    }
}
