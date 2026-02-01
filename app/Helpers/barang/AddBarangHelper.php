<?php 

namespace App\Helpers\barang;

use Illuminate\Support\Facades\Auth;

class AddBarangHelper
{
    public static function createbarRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.barang.store';
        }

        if ($user->hasRole('it')) {
            return 'it.barang.store';
        }

        return null;
    }
} 