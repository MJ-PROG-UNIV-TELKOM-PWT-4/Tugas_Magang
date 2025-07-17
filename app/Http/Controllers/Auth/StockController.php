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
        
        // Simpan nama produk untuk logging sebelum dihapus
        $productName = $product->name;
        
        // Jika status "Ditolak", hapus produk dari database
        if ($request->status === 'Ditolak') {
            try {
                // Log aktivitas sebelum menghapus
                logActivity('delete', 'product', $product->id, 'Menghapus produk karena status ditolak: ' . $productName);
                
                // Hapus produk dari database
                $product->delete();
                
                return redirect()->back()->with('success', 'Produk berhasil dihapus karena status ditolak.');
                
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Gagal menghapus produk: ' . $e->getMessage());
            }
        }
        
        // Update status berdasarkan input untuk status lainnya
        $product->status = $request->status;
        
        // Logika untuk status "Dikeluarkan"
        if ($request->status === 'Dikeluarkan') {
            $product->barang_keluar = $request->input('quantity', 0); // Menyimpan data keluar jika dikeluarkan
            $product->tanggal_keluar = $request->input('date'); // Menyimpan tanggal keluar
            
            // Log aktivitas untuk barang keluar
            logActivity('update', 'product', $product->id, 'Mengeluarkan barang: ' . $productName . ' sebanyak ' . $request->input('quantity', 0));
        }
        
        // Simpan perubahan untuk status selain "Ditolak"
        $product->save();
        
        // Log aktivitas untuk update status
        logActivity('update', 'product', $product->id, 'Mengubah status produk: ' . $productName . ' menjadi ' . $request->status);
        
        return redirect()->back()->with('success', 'Data berhasil diupdate.');
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