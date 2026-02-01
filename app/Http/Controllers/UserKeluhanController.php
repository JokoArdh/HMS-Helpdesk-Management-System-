<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use App\Models\Riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserKeluhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Riwayat::with('keluhan', 'user', 'handler')
                            ->where('user_id', Auth::id())
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('umum.ticketing.mydata', [
            'title' => 'Riwayat Ticketing'
        ], compact('tickets'));
    }

    public function datakeluhan()
    {
        $keluhans = Keluhan::where('user_id', Auth::id())
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('umum.ticketing.datakeluhan', [
            'title' => 'Data Keluhan'
        ], compact('keluhans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('umum.ticketing.create', [
            'title' => 'Form Keluhan'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:hardware,software,pengadaan aset',
            'keterangan' => 'required|string',
            'tgl_keluhan' => 'required|date',
            'bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        DB::transaction(function () use ($request) {
            
            //insert keluhan
            $keluhan = Keluhan::create([
                'user_id' => auth()->id(),
                'kategori' => $request->kategori,
                'keterangan' => $request->keterangan,
                'tgl_keluhan' => $request->tgl_keluhan,
                'bukti' => $request->bukti ?? null,
            ]);
            //insert otomatis table tickting
            Riwayat::create([
                'keluhan_id' => $keluhan->id,
                'user_id' => auth()->id(),
                'status' => 'pending',
                'action' => 'create',
                'catatan' => null,
            ]);
        });
        Alert::success('Success', 'Form created Successfully');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
