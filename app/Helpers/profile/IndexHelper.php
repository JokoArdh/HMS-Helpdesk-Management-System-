<?php 

namespace App\Helpers\profile;

use Illuminate\Support\Facades\Auth;

class IndexHelper
{
    public static function indexRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.setting.index';
        }
        if ($user->hasRole('it')) {
            return 'it.setting.index';
        }
        if($user->hasRole('manager')){
            return 'manager.setting.index';
        }
        if($user->hasRole('user')){
            return 'user.setting.index';
        }

        return null;
    }
} 