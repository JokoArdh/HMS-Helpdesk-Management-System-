<?php 

namespace App\Helpers\profile;

use Illuminate\Support\Facades\Auth;

class AboutHelper
{
    public static function aboutRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.setting.about';
        }

        if ($user->hasRole('it')) {
            return 'it.setting.about';
        }
        if($user->hasRole('manager')){
            return 'manager.setting.about';
        }
        if($user->hasRole('user')){
            return 'user.setting.about';
        }

        return null;
    }
} 