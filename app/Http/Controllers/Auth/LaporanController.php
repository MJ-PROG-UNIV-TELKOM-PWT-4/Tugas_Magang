<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ActivityLog;

class LaporanController extends Controller
{
    public function index()
    {
        // Laporan Stok Barang
        $laporan = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select(
                'products.*',
                'categories.name as kategori'
            )
            ->get();

        // Riwayat Transaksi
        $masuk = DB::table('products')
            ->select('name', DB::raw("'masuk' as tipe"), 'tanggal_masuk as tanggal', 'barang_masuk as jumlah')
            ->whereNotNull('tanggal_masuk');

        $keluar = DB::table('products')
            ->select('name', DB::raw("'keluar' as tipe"), 'tanggal_keluar as tanggal', 'barang_keluar as jumlah')
            ->whereNotNull('tanggal_keluar')
            ->where('barang_keluar', '>', 0);

        $riwayatTransaksi = $masuk->unionAll($keluar)->orderBy('tanggal', 'desc')->get();

        // Riwayat Aktivitas User dari activity_logs
        $riwayatUser = ActivityLog::with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        // Kirim ke view
        return view('pages.practice.5', compact('laporan', 'riwayatTransaksi', 'riwayatUser'));
    }
}
