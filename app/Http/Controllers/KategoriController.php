<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategories = Kategori::all();
        return view('umum.kategori.index', [
            'title' => 'Kategori'
        ], compact('kategories'));
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
    public function store(StoreKategoriRequest $request)
    {
        $validate = $request->validated();

        $kategori = Kategori::create([
            'nama_kategori' => $validate['nama_kategori'],
            'icon' => $validate['icon'] ? $validate['icon']->store('assets/images', 'public') : null,
        ]);

        Alert::success('Success', 'Category created Successfully');
        // return redirect()->route(auth()->user()->hasRole('admin') ? 'admin.kategori.index' : 'it.kategori.index');
        return redirect()->back();
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
    public function update(UpdateKategoriRequest $request, string $id)
    {
        $validate = $request->validated();

        $kategori = Kategori::findOrFail($id);

        if($request->hasFile('icon')){
            Storage::disk('public')->delete($kategori->icon);
            $validate['icon'] = $request->file('icon')->store('assets/images', 'public');
        }
        $kategori->update($validate);

        Alert::success('Success', 'Category update Successfully');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kategori = Kategori::findOrFail($id);

        if($kategori->icon && Storage::disk('public')->exists($kategori->icon)){
            Storage::disk('public')->delete($kategori->icon);
        }
        $kategori->delete();

        Alert::success('Success', 'Category delete Successfully');
        return redirect()->back();
    }
    
}
