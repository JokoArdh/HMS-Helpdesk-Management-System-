<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBarangRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
            'kode_barang' => 'required|string|unique:barangs,kode_barang',
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'kondisi'     => 'required|in:baru,second,rusak',
            'merk'        => 'required|string|max:255',
            'satuan'      => 'required|in:pcs,unit,set',
        ];
    }
}
