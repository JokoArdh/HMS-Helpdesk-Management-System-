<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKategoriRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
            'nama_kategori' => 'required|string',
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
