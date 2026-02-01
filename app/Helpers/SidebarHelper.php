<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class SidebarHelper
{
    public static function kategoriRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.kategori.index';
        }

        if ($user->hasRole('it')) {
            return 'it.kategori.index';
        }

        if ($user->hasRole('manager')) {
            return 'manager.kategori.index';
        }

        return null;
    }
}