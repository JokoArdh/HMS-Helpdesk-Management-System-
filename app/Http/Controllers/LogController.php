<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLogRequest;
use App\Http\Requests\UpdateLogRequest;
use App\Models\LogTrobel;
use Illuminate\Http\Request;
use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Can;
use RealRashid\SweetAlert\Facades\Alert;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trobels = LogTrobel::latest()->get();
        return view('umum.riwayatlog.index', [
            'title' => 'Riwayat Log Trobel'
        ], compact('trobels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //cek permission spatie it dan admin 
        return view('umum.riwayatlog.create', [
            'title' => 'Buat Log Trobel Baru'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLogRequest $request)
    {
        $validate = $request->validated();

        // Handle upload file jika ada
        $gambarPath = null;
        if ($request->hasFile('gambar') && $request->file('gambar')->isValid()) {
            $gambarPath = $request->file('gambar')->store('assets/images', 'public');
        }


        $log = LogTrobel::create([
            'problem' => $validate['problem'],
            'gambar' => $gambarPath,
            'penyebab' => $validate['penyebab']
        ]);
        
        Alert::success('Success', 'Log created successfully.');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $trobel = LogTrobel::findOrFail($id);
        return view('umum.riwayatlog.edit', [
            'title' => 'Edit Log'
        ], compact('trobel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLogRequest $request, string $id)
    {
        $validate = $request->validated();

        $trobel = LogTrobel::findOrFail($id);

        //jika ada gambar dan hapus gambar lama
        if($request->hasFile('gambar')){
            Storage::disk('public')->delete($trobel->gambar);

            //update gambar baru
            $validate['gambar'] = $request->file('gambar')->store('assets/images', 'public');
        }
        $trobel->update($validate);

        Alert::success('Success', 'Log update Successfully');
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $trobel = LogTrobel::findOrFail($id);

        if($trobel->gambar && Storage::disk('public')->exists($trobel->gambar)){
            Storage::disk('public')->delete($trobel->gambar);
        }
        $trobel->delete();

        Alert::success('Success', 'Log delete successfully.');
        return redirect()->back();
        
    }
}
