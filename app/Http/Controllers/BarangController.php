<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;
use App\Models\Barang;
use App\Models\Kategori;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //eager loading
        $barangs = Barang::with('category')->get(); //u menampilkan table
        $kategoris = Kategori::all(); //untuk dropdown menu kategori di form input

        //generate kode barang
        $kodeb = Barang::orderBy('id', 'desc')->first();
        if($kodeb){
            $lastNum = intval(substr($kodeb->kode_barang, 6));
            $nextNum = $lastNum + 1;
        }else{
            $nextNum = 1;
        }
        $kode_barang = 'ITAST-' . str_pad($nextNum, 3, '0', STR_PAD_LEFT);

        return view('umum.barang.index', [
            'title' => 'Barang'
        ], compact('barangs', 'kategoris', 'kode_barang'));
    }

    public function export()
    {
        $barangs = Barang::with('category')->get();

        $pdf = Pdf::loadView('umum.barang.export-pdf', [
            'barang' => $barangs
        ])->setPaper('a4', 'landscape');
        
        return $pdf->download('data-barang.pdf');

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
    public function store(StoreBarangRequest $request)
    {
        $validate = $request->validated();

        //untuk menghindari race conditional / multiuser tulis ulang kode
        $kodeb = Barang::orderBy('id', 'desc')->first();
        if($kodeb){
            $lastNum = intval(substr($kodeb->kode_barang, 6));
            $nextNum = $lastNum + 1;
        }else{
            $nextNum = 1;
        }
        $kode_barang = 'ITAST-' . str_pad($nextNum, 3, '0', STR_PAD_LEFT);

        Barang::create([
            'kode_barang' => $kode_barang,
            'nama_barang' => $validate['nama_barang'],
            'kategori_id' => $validate['kategori_id'],
            'merk'        => $validate['merk'],
            'satuan'      => $validate['satuan'],
            'kondisi'     => $validate['kondisi']
        ]);

        Alert::success('Success', 'Barang created Successfully');
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
    public function update(UpdateBarangRequest $request, string $id)
    {
        $validate = $request->validated();

        $barang = Barang::findOrFail($id);
        $barang->update([
            'nama_barang' => $validate['nama_barang'],
            'kategori_id' => $validate['kategori_id'],
            'merk'        => $validate['merk'],
            'satuan'      => $validate['satuan'],
            'kondisi'     => $validate['kondisi']
        ]);

        Alert::success('Success', 'Barang updated Successfully');
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
