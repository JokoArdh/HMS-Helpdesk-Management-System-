<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransaksiMasukRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'barang_id' => 'required|exists:barangs,id',
            'jenis_transaksi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'tgl_transaksi' => 'required|date',
        ];
    }
}
