<?php 

namespace App\Helpers\logtrobel;

use Illuminate\Support\Facades\Auth;

class StoreLogHelper
{
    public static function storeLogRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.logtrobel.store';
        }

        if ($user->hasRole('it')) {
            return 'it.logtrobel.store';
        }

        return null;
    }
} 