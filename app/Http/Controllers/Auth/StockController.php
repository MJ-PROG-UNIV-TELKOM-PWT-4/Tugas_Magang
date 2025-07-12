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
        
        // Hanya update barang_keluar dan tanggal_keluar jika status "Dikeluarkan"
        if ($request->status === 'Dikeluarkan') {
            $product->barang_keluar = $request->input('quantity', 0); // Menyimpan data keluar jika dikeluarkan
            $product->tanggal_keluar = $request->input('date'); // Menyimpan tanggal keluar
        } else {
            // Jika status bukan "Dikeluarkan", reset keluar dan tanggal_keluar
            $product->barang_keluar = 0;
            $product->tanggal_keluar = null;
        }

        // Simpan perubahan
        $product->save();

        return redirect()->back()->with('success', 'Data berhasil diupdate.');  // Pastikan untuk mengalihkan dan memberi umpan balik
    }

    public function updateMinimumStock(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'minimum_stock' => 'required|integer|min:0',
        ]);

        // Update minimum stock
        $product = Product::findOrFail($id);
        $product->minimum_stock = $request->minimum_stock;
        $product->save();

        return redirect()->back()->with('success', 'Stok minimum berhasil diperbarui.');
    }
}