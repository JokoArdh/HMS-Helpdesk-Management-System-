<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outdata = Transaksi::with('barang', 'user', 'approver')
                                ->where('jenis_transaksi', 'keluar')
                                ->orderBy('tgl_transaksi', 'desc')
                                ->get();

        return view('umum.transaksi.keluar.index', [
            'title' => 'Permintaan Barang'
        ], compact('outdata'));
    }

    public function permintaan()
    {
        $mydata = Transaksi::with('barang', 'user', 'approver')
                            ->where('user_id', Auth::id())
                            ->orderBy('tgl_transaksi', 'desc')
                            ->get();

        return view('umum.transaksi.keluar.mydata', [
            'title' => 'Status Riwayat Permintaan'
        ], compact('mydata'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('umum.transaksi.keluar.create', [
            'title' => 'Form Permintaan'
        ]);
    }

    //SELECT OPTION NAMA BARANG OTOMATIS
    // BarangController.php
public function auto(Request $request)
{
    $term = $request->get('term'); // jQuery UI Autocomplete mengirim 'term'

    $barangs = Barang::where('nama_barang', 'like', "%{$term}%")
        ->limit(10)
        ->get();

    $results = [];

    foreach ($barangs as $barang) {
        $results[] = [
            'id' => $barang->id,
            'nama_barang' => $barang->nama_barang, // yang ditampilkan di input
            'kode_barang' => $barang->kode_barang,  // kode otomatis
        ];
    }

    return response()->json($results);
    
}


    public function byNama($nama)
    {
        // ini ambil data baragnya apa dari model barang
        return Barang::where('nama_barang', 'LIKE', "%$nama%")
        ->get(['id', 'kode_barang', 'nama_barang']);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jenis_transaksi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'tgl_transaksi' => 'required|date',
            'keterangan' => 'required|string',
        ]);
        try {
        DB::transaction(function () use ($request) {

            $barang = Barang::findOrFail($request->barang_id);

            //  CEK STOK
            if ($request->jumlah > $barang->stok) {
                throw new \Exception('Stok barang habis atau tidak mencukupi');
            }

            Transaksi::create([
                'barang_id' => $barang->id,
                'user_id' => auth()->id(),
                'jenis_transaksi' => $request->jenis_transaksi, // "keluar"
                'jumlah' => $request->jumlah,
                'tgl_transaksi' => $request->tgl_transaksi,
                'keterangan' => $request->keterangan,
            ]);
        });

        Alert::success('Success', 'Permintaan created Successfully');
        return redirect()->back();

    } catch(\Exception $e) {
        Alert::error('Gagal', $e->getMessage());
        return redirect()->back()->withInput();
    }
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
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        try {
        DB::transaction(function () use ($request, $id) {

            $outdata = Transaksi::lockForUpdate()->findOrFail($id);
            $barang = Barang::lockForUpdate()->findOrFail($outdata->barang_id);

             // 🔒 Lock: jika sudah approved, stop langsung
                if ($outdata->status === 'approved') {
                    throw new \Exception('Perubahan Gagal, Sudah di ACC');
                }

            if($request->status === "approved" && $outdata->status !== "approved"){
                //cek stok
                if($barang->stok < $outdata->jumlah){
                    Alert::error('Gagal', 'Stok barang tidak mencukupi.');
                    return redirect()->back(); // langsung redirect
                }
                //kurangi sesui permintaan
                $barang->decrement('stok', $outdata->jumlah);
            }

            $outdata->update([
                'status' => $request->status,
                'tgl_approve' => $request->status === 'approved' ? now() : null,
                'approve_by' => auth()->id(),
            ]);
        });
        Alert::success('Success', 'Acc Successfully');
        return redirect()->back();

        } catch(\Exception $e) {
        Alert::error('Gagal', $e->getMessage());
        return redirect()->back()->withInput();
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
