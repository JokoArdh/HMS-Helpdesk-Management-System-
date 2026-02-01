<?php 

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class CreateLogHelper
{
    public static function createLogRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.logtrobel.create';
        }

        if ($user->hasRole('it')) {
            return 'it.logtrobel.create';
        }

        return null;
    }
} 