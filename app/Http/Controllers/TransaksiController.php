<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransaksiMasukRequest;
use App\Models\Barang;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index(){

        $barangs = Barang::all(); //ambil data barang untuk form input

        //amnil semua data transaksi termasuk user dan barangnya
        $transaksis = Transaksi::with('barang.category', 'user', 'approver')
                        ->where('jenis_transaksi', 'masuk')
                        ->orderBy('tgl_transaksi', 'desc')
                        ->get();

        return view('umum.transaksi.masuk.index', [
            'title' => 'Transaksi Masuk'
        ], compact('barangs', 'transaksis'));
    }

    public function exportPdf(Request $request)
    {
        $filter = $request->filter; // filter per minggu | bulan
        $tanggl = $request->tanggal ?? Carbon::now()->toDateString();

        $query = Transaksi::with('barang.category', 'user', 'approver')
                            ->where('jenis_transaksi', 'masuk');
                            
        
        //filter per minggu
        if($filter == 'minggu')
        {
            $start = Carbon::parse($tanggl)->startOfWeek();
            $end   = Carbon::parse($tanggl)->endOfWeek();

            $query->whereBetween('tgl_transaksi', [$start, $end]);
        }

        if($filter == 'bulan')
        {
            $bulan = Carbon::parse($request->bulan);

            $query->whereMonth('tgl_transaksi', $bulan->month)
                    ->whereYear('tgl_transaksi', $bulan->year);
        }

        $transaksis = $query->orderBy('tgl_transaksi', 'desc')->get();

        $pdf = Pdf::loadView('umum.transaksi.masuk.export-pdf', [
            'transaksis' => $transaksis,
            'filter'    => $filter,
            'tanggal'   => $tanggl,
        ])->setPaper('a4', 'landscape');
        return $pdf->download('transaksi-masuk.pdf');
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'jenis_transaksi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'tgl_transaksi' => 'required|date',
        ]);

    
        DB::transaction(function () use ($request) {
            
            $barang = Barang::findOrFail($request->barang_id);
            //default
            $status = 'pending';
            $approveBy = null;
            $tglApprove = null;
        
        //JIKA BARANG MASUK - AUTO APPROVED
        if($request->jenis_transaksi === 'masuk'){
            $status = 'approved';
            $approveBy = auth()->id();
            $tglApprove = now();

            //TMBAH STOK
            $barang->increment('stok', $request->jumlah);
        }

        Transaksi::create([
            'barang_id' => $request->barang_id,
            'user_id'   => auth()->id(),
            'approve_by' => $approveBy,
            'jenis_transaksi' => $request->jenis_transaksi,
            'jumlah' => $request->jumlah,
            'tgl_transaksi' => $request->tgl_transaksi,
            'status' => $status,
            'tgl_approve' => $tglApprove,
        ]);

        });

        Alert::success('Success', 'Barang Masuk Successfully');
        return redirect()->back();

   }
}
