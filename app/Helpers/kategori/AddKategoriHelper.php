<?php 

namespace App\Helpers\kategori;

use Illuminate\Support\Facades\Auth;

class AddKategoriHelper
{
    public static function createkatRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.kategori.store';
        }

        if ($user->hasRole('it')) {
            return 'it.kategori.store';
        }

        return null;
    }
} 