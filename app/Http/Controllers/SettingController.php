<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view('umum.profile.index', [
            'title' => 'Profile'
        ], compact('user'));
    }
    public function about(){
        return view('umum.profile.about', [
            'title' => 'About'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $data = [
            'name' => $request->name,
        ];
        if($request->hasFile('gambar')){
            // Hapus file lama jika ada -> karena parameter gambar nullable 
            if ($user->gambar && Storage::disk('public')->exists($user->gambar)) {
                Storage::disk('public')->delete($user->gambar);
            }

            $path = $request->file('gambar')->store('assets/images', 'public');
            $data['gambar'] = $path;
        }

        $user->update($data);

        Alert::success('Success', 'DUpdate profile Successfully');
        return redirect()->back();
    }

    public function updatePass(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|min:8|confirmed'
        ]);
        //cek passwd lama
        if(!Hash::check($request->current_password, auth()->user()->password))
        {
            Alert::error('Error', 'Password Lama Salah silahklan Ulangi');
            return redirect()->back();
        }
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->password)
        ]);
        Alert::success('Success', 'Password updated Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
