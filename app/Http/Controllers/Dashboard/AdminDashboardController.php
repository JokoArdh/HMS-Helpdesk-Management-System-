<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Keluhan;
use App\Models\Riwayat;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        //total user active
        $totalUserActive = User::where('status', 'active')->count();
        //total barang item
        $totalBarang = Barang::count();
        //totel keluhan status done
        $totalKeluhan = Keluhan::where('status', 'done')->count();
        //status keluhan masuk pending
        $totalStatus = Riwayat::where('status', 'pending')->count();

        //char lingkaran
        $kategori = Kategori::with('barangs')->get();
        $chartData = $kategori->map( function ($k) {
            //jumlah transaksi keluar dari semua barang di kategori
            $totalKeluar = $k->barangs->sum(function($barang){
                return  $barang->transaksis()
                                ->where('jenis_transaksi', 'keluar')
                                ->sum('jumlah');
            });
            return [
                'value' => $totalKeluar,
                'name'  => $k->nama_kategori //sesuai nama kategori di tabel kategori
            ];

        });

        //untuk chart keluhan Ketegori
        // Data chart keluhan
        $keluhanChartData = Keluhan::selectRaw('kategori, COUNT(*) as total')
            ->groupBy('kategori')
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->total,
                    'name'  => $item->kategori
                ];
            });
        
        //barang stok kurang < 5 dengan , 7 terakhir.
        $barangMenipis = Barang::where('stok', '<', 5)
                                ->orderBy('stok', 'asc')
                                ->limit(7)
                                ->get();

        //top 7 barang dengan permintaan jenis transaksi keluat terbanyak dan mendapat acc
        $topItem = DB::table('transaksis')
        ->join('barangs', 'transaksis.barang_id', '=', 'barangs.id')
        ->select('barangs.nama_barang', DB::raw('SUM(transaksis.jumlah) as total_keluar'))
        ->where('transaksis.jenis_transaksi', 'keluar')
        ->where('status', 'approved')
        ->groupBy('barangs.id', 'barangs.nama_barang')
        ->orderByDesc('total_keluar')
        ->limit(7)
        ->get();
         //show data untuk bar chart
         $product = $topItem->pluck('nama_barang');
         $productTotal = $topItem->pluck('total_keluar');

        return view('dashboard.admin.index', [
            'title' => 'Admin Dashboard'
        ], compact(
            'totalUserActive', 
            'totalBarang', 
            'totalKeluhan', 
            'totalStatus',
            'chartData', 
            'keluhanChartData', 
            'barangMenipis',
            'product', 'productTotal'
        ));
         
    }
}
