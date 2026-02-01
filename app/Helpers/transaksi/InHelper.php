<?php 

namespace App\Helpers\transaksi;

use Illuminate\Support\Facades\Auth;

class InHelper
{
    public static function linkinRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.transaksi-masuk.index';
        }

        if ($user->hasRole('it')) {
            return 'it.transaksi-masuk.index';
        }
        if($user->hasRole('manager')){
            return 'manager.transaksi-masuk.index';
        }

        return null;
    }
} 