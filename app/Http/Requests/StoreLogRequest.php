<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLogRequest extends FormRequest
{
   
    public function rules(): array
    {
        return [
            'problem' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'penyebab' => 'required|string'
        ];
    }
}
