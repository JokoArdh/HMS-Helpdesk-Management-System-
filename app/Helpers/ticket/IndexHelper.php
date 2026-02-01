<?php 

namespace App\Helpers\ticket;

use Illuminate\Support\Facades\Auth;

class IndexHelper
{
    public static function indexRoute()
    {
       $user = Auth::user();

        if (!$user) return null;

        if ($user->hasRole('admin')) {
            return 'admin.ticket.index';
        }

        if ($user->hasRole('it')) {
            return 'it.ticket.index';
        }
        if($user->hasRole('manager')){
            return 'manager.ticket.index';
        }

        return null;
    }
} 