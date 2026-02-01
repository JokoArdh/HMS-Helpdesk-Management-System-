<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBarangRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'kondisi'     => 'required|in:baru,second,rusak',
            'merk'        => 'required|string',
            'satuan'      => 'required|in:pcs,unit,set',
        ];
    }
}
