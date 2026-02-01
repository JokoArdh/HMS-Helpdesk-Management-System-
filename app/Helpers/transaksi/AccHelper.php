<?php 

namespace App\Helpers\transaksi;

use Illuminate\Support\Facades\Auth;

class AccHelper
{
    public static function accRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.transaksi-out.update';
        }

        if ($user->hasRole('it')) {
            return 'it.transaksi-out.update';
        }

        return null;
    }
} 