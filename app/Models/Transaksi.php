<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id', 
        'user_id', 
        'approve_by', 
        'jenis_transaksi', 
        'jumlah', 
        'tgl_transaksi',
        'keterangan', 
        'status', 
        'tgl_approve'
    ];

    // Relasi ke barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }
    // Relasi ke user yang membuat transaksi
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Relasi ke user yang mengapprove transaksi
    public function approver()
    {
        return $this->belongsTo(User::class, 'approve_by'); 
    }

}
