<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Riwayat extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'handled_by', 'keluhan_id','status', 'action', 'catatan'];

    /**
     * Relasi ke user
     * 1 riwayat dimiliki 1 user
     */
    //user pelapor untuk riwayat
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    /**
     * Relasi ke keluhan
     * 1 riwayat dimiliki 1 keluhan
     */
    public function keluhan(){
        return $this->belongsTo(Keluhan::class, 'keluhan_id');
    }

    //user yg acc riwayat (tim IT)
    public function handler()
    {
        return $this->belongsTo(User::class, 'handled_by');
    }
}
