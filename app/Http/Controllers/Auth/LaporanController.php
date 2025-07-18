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

        // Generate minggu per bulan untuk dropdown filter
        $stokWeeks = $this->generateWeeks($stokBulan);
        $transWeeks = $this->generateWeeks($transBulan);
        $logWeeks = $this->generateWeeks($logBulan);

        // Determine view based on user role or request parameter
        $viewType = $request->input('view', 'admin'); // default to admin
        
        $viewName = match($viewType) {
            'manager' => 'pages.practice.ManagerGudangLaporan',
            'admin' => 'pages.practice.AdminLaporan',
            default => 'pages.practice.AdminLaporan'
        };

        return view($viewName, compact(
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
            'logBulan',
            'stokWeeks',
            'transWeeks',
            'logWeeks'
        ));
    }

    // Method khusus untuk Admin
    public function adminLaporan(Request $request)
    {
        $request->merge(['view' => 'admin']);
        return $this->index($request);
    }

    // Method khusus untuk Manager Gudang
    public function managerGudangLaporan(Request $request)
    {
        $request->merge(['view' => 'manager']);
        return $this->index($request);
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

        // Aktivitas User (khusus 'user')
        $aktivitasUser = ActivityLog::with(['user', 'targetUser'])
            ->where('target_type', 'user')
            ->latest()
            ->take(10)
            ->get();

        return view('pages.practice.AdminDashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalSuppliers',
            'stockData',
            'chartLabels',
            'chartData',
            'aktivitasHariIni',
            'aktivitasUser'
        ));
    }

    // Fungsi generate daftar minggu berdasarkan bulan
    private function generateWeeks($bulan, $tahun = null)
    {
        $tahun = $tahun ?? now()->year;
        $weeks = [];

        // Konversi $bulan ke integer kalau string
        $bulan = (int) $bulan;

        $startOfMonth = Carbon::create($tahun, $bulan, 1)->startOfMonth();
        $endOfMonth = Carbon::create($tahun, $bulan, 1)->endOfMonth();
        $current = $startOfMonth->copy()->startOfWeek(Carbon::MONDAY);

        while ($current <= $endOfMonth) {
            $start = $current->copy();
            $end = $current->copy()->endOfWeek();

            $weeks[] = [
                'label' => 'Minggu ' . $start->format('d M') . ' - ' . $end->format('d M'),
                'start' => $start->toDateString(),
                'end' => $end->toDateString(),
            ];

            $current->addWeek();
        }

        return $weeks;
    }
}