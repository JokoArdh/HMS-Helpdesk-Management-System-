<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('auth.register', [
            'title' => 'Registrasi'
        ]);
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        
       $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $user->assignRole('user');

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan tunggu aktivasi akun Anda oleh Admin.');
    }
}
