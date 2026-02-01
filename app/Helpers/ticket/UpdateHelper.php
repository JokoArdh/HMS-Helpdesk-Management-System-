<?php 

namespace App\Helpers\ticket;

use Illuminate\Support\Facades\Auth;

class UpdateHelper
{
    public static function updateRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.ticket.update';
        }

        if ($user->hasRole('it')) {
            return 'it.ticket.update';
        }
        if($user->hasRole('manager')){
            return 'manager.ticket.update';
        }

        return null;
    }
} 