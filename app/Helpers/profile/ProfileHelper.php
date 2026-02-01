<?php 

namespace App\Helpers\profile;

use Illuminate\Support\Facades\Auth;

class ProfileHelper
{
    public static function profileRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('it')) {
            return 'it.setting.update';
        }
        if($user->hasRole('manager')){
            return 'manager.setting.update';
        }
        if($user->hasRole('user')){
            return 'user.setting.update';
        }

        return null;
    }
} 