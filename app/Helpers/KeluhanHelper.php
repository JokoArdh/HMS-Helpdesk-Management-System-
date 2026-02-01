<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class KeluhanHelper
{
    public static function keluhanRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.keluhan.index';
        }

        if ($user->hasRole('user')) {
            return 'user.datakeluhan.index';
        }

        return null;
    }
}