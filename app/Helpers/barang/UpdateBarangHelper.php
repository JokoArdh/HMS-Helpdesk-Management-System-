<?php 

namespace App\Helpers\barang;

use Illuminate\Support\Facades\Auth;

class UpdateBarangHelper
{
    public static function updatebarRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.barang.update';
        }

        if ($user->hasRole('it')) {
            return 'it.barang.update';
        }

        return null;
    }
} 