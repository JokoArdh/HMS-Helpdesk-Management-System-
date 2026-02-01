<?php 

namespace App\Helpers\transaksi;

use Illuminate\Support\Facades\Auth;

class OutHelper
{
    public static function linkoutRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.transaksi-out.index';
        }

        if ($user->hasRole('it')) {
            return 'it.transaksi-out.index';
        }
        if($user->hasRole('manager')){
            return 'manager.transaksi-out.index';
        }

        return null;
    }
} 