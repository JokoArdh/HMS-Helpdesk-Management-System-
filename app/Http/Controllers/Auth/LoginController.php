<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'Login'
        ]);
    }

    public function store(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            //cek akun aktif tidak
             if ($user->status !== 'active') {
                Auth::logout();
                return back()->with('error', 'Akun Anda belum aktif, Hubungi Admin .');
            }

            if($user->hasRole('admin')){
                return redirect()->route('admin.dashboard');
            }
            elseif($user->hasRole('it')){
                return redirect()->route('it.dashboard');
            }
            elseif($user->hasRole('manager')){  
                return redirect()->route('manager.dashboard');
            }
            elseif($user->hasRole('user')){
                return redirect()->route('user.dashboard'); 
            }else{
                Auth::logout();
                return back()->with('error', 'Role Anda belum diatur. Hubungi admin.');
            } 
        }
        return back()->with('error', 'Email atau Password salah');

    }

    public function logout(Request $request){
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('login')->with('success', 'Anda telah logout.');
        }

}
