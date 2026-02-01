<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class LogHelper
{
    public static function logRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.logtrobel.index';
        }

        if ($user->hasRole('it')) {
            return 'it.logtrobel.index';
        }

        return null;
    }
}