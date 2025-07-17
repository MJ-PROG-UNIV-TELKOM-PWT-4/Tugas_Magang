<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; 
use App\Models\Product;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Menggunakan model Product langsung
        return view('stock.index', compact('products'));
    }

    public function updateStock(Request $request, $id)
    {
    // Validasi input
    $request->validate([
        'quantity' => 'nullable|integer|min:0', // Modifier 'nullable' karena tidak semua status butuh quantity
        'status' => 'required|in:Pending,Diterima,Ditolak,Dikeluarkan',
        'date' => 'nullable|date', // Modifier 'nullable' karena tidak semua status butuh tanggal
    ]);

    // Temukan produk berdasarkan ID
    $product = Product::findOrFail($id);

    // Update status berdasarkan input
    $product->status = $request->status; // Perbarui status

    // Logika untuk barang_masuk
    if ($request->status === 'Ditolak') {
        $product->barang_masuk = 0; // Set barang_masuk menjadi 0 jika status "Ditolak"
    } elseif ($request->status === 'Dikeluarkan') {
        $product->barang_keluar = $request->input('quantity', 0); // Menyimpan data keluar jika dikeluarkan
        $product->tanggal_keluar = $request->input('date'); // Menyimpan tanggal keluar
    }

    // Simpan perubahan
    $product->save();

    return redirect()->back()->with('success', 'Data berhasil diupdate.');  // Pastikan untuk mengalihkan dan memberi umpan balik
    }

public function updateMinimumStock(Request $request, $id)
{
    $request->validate([
        'minimum_stock' => 'required|integer|min:0',
    ]);

    $product = Product::findOrFail($id);
    $old = $product->minimum_stock;
    $product->minimum_stock = $request->minimum_stock;
    $product->save();

    // ✅ Catat ke log activity di sini
    logActivity('update', 'minimum_stock', $product->id, 'Mengubah stok minimum produk: ' . $product->name . ' dari ' . $old . ' ke ' . $request->minimum_stock);

    return redirect()->back()->with('success', 'Stok minimum berhasil diperbarui.');
}
}