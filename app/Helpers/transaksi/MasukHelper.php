<?php 

namespace App\Helpers\transaksi;

use Illuminate\Support\Facades\Auth;

class MasukHelper
{
    public static function masukRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.transaksi-masuk.store';
        }

        if ($user->hasRole('it')) {
            return 'it.transaksi-masuk.store';
        }
        

        return null;
    }
} 