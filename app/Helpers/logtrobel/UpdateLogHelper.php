<?php 

namespace App\Helpers\logtrobel;

use Illuminate\Support\Facades\Auth;

class UpdateLogHelper
{
    public static function UpdateLogRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.logtrobel.update';
        }

        if ($user->hasRole('it')) {
            return 'it.logtrobel.update';
        }

        return null;
    }
} 