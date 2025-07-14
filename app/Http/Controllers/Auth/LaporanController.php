<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ActivityLog;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter minggu
        $stokWeek = $request->input('stok_week');
        $transWeek = $request->input('trans_week');
        $logWeek = $request->input('log_week');

        // Ambil filter bulan (default: bulan sekarang)
        $stokBulan = $request->input('stok_bulan', Carbon::now()->month);
        $transBulan = $request->input('trans_bulan', Carbon::now()->month);
        $logBulan = $request->input('log_bulan', Carbon::now()->month);

        $tahun = Carbon::now()->year;

        // Parse tanggal awal & akhir dari minggu
        [$stokStart, $stokEnd] = $stokWeek ? explode('|', $stokWeek) : [null, null];
        [$transStart, $transEnd] = $transWeek ? explode('|', $transWeek) : [null, null];
        [$logStart, $logEnd] = $logWeek ? explode('|', $logWeek) : [null, null];

        // Fallback: kalau minggu nggak dipilih, pakai full bulan
        if (!$stokStart || !$stokEnd) {
            $stokStart = Carbon::create($tahun, $stokBulan, 1)->startOfMonth()->toDateString();
            $stokEnd = Carbon::create($tahun, $stokBulan, 1)->endOfMonth()->toDateString();
        }

        if (!$transStart || !$transEnd) {
            $transStart = Carbon::create($tahun, $transBulan, 1)->startOfMonth()->toDateString();
            $transEnd = Carbon::create($tahun, $transBulan, 1)->endOfMonth()->toDateString();
        }

        if (!$logStart || !$logEnd) {
            $logStart = Carbon::create($tahun, $logBulan, 1)->startOfMonth()->toDateString();
            $logEnd = Carbon::create($tahun, $logBulan, 1)->endOfMonth()->toDateString();
        }

        // === LAPORAN STOK BARANG ===
        $laporan = DB::table('products')
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as kategori')
            ->where(function ($q) use ($stokStart, $stokEnd) {
                $q->whereBetween('products.tanggal_masuk', [$stokStart, $stokEnd])
                  ->orWhereBetween('products.tanggal_keluar', [$stokStart, $stokEnd]);
            })
            ->get();

        // === TRANSAKSI BARANG ===
        $masuk = DB::table('products')
            ->select('name', DB::raw("'masuk' as tipe"), 'tanggal_masuk as tanggal', 'barang_masuk as jumlah')
            ->whereNotNull('tanggal_masuk')
            ->whereBetween('tanggal_masuk', [$transStart, $transEnd]);

        $keluar = DB::table('products')
            ->select('name', DB::raw("'keluar' as tipe"), 'tanggal_keluar as tanggal', 'barang_keluar as jumlah')
            ->whereNotNull('tanggal_keluar')
            ->where('barang_keluar', '>', 0)
            ->whereBetween('tanggal_keluar', [$transStart, $transEnd]);

        $riwayatTransaksi = $masuk->unionAll($keluar)->orderBy('tanggal', 'desc')->get();

        // === RIWAYAT AKTIVITAS ===
        $riwayatUser = ActivityLog::with('user')
            ->whereBetween('created_at', [$logStart, $logEnd])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pages.practice.5', compact(
            'laporan',
            'riwayatTransaksi',
            'riwayatUser',
            'stokStart',
            'stokEnd',
            'transStart',
            'transEnd',
            'logStart',
            'logEnd',
            'stokBulan',
            'transBulan',
            'logBulan'
        ));
    }

    public function dashboard()
    {
        // Data Ringkasan
        $totalProducts = DB::table('products')->count();
        $totalCategories = DB::table('categories')->count();
        $totalSuppliers = DB::table('suppliers')->count();

        // Data Grafik Stok Produk
        $products = DB::table('products')->get();
        $stockData = [];

        foreach ($products as $product) {
            $sisaStok = $product->barang_masuk - $product->barang_keluar;
            $stockData[$product->name] = $sisaStok;
        }

        $chartLabels = array_keys($stockData);
        $chartData = array_values($stockData);

        // Aktivitas Hari Ini
        $aktivitasHariIni = ActivityLog::with('user')
            ->whereDate('created_at', Carbon::today())
            ->latest()
            ->get();

        return view('pages.practice.index', compact(
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'stockData',
            'chartLabels',
            'chartData',
            'aktivitasHariIni'
        ));
    }
}
