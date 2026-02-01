<?php 

namespace App\Helpers\kategori;

use Illuminate\Support\Facades\Auth;

class UpdateKategoriHelper
{
    public static function updatekatRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.kategori.update';
        }

        if ($user->hasRole('it')) {
            return 'it.kategori.update';
        }

        return null;
    }
} 