<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class BarangHelper
{
    public static function barangRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.barang.index';
        }

        if ($user->hasRole('it')) {
            return 'it.barang.index';
        }
        if ($user->hasRole('manager')) {
            return 'manager.barang.index';
        }
        if($user->hasRole('user')){
            return 'user.barang.index';
        }

        return null;
    }
}