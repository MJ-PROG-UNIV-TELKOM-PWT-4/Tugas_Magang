<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() // Menampilkan semua produk
    {
        $products = Product::all();
        return view('pages.practice.1', compact('products'));
    }

    public function search(Request $request) // Menampilkan semua produk
    {
    // Ambil query pencarian dari input
    $search = $request->input('search');

    // Jika ada pencarian, gunakan untuk memfilter produk
    if ($search) {
        $products = Product::where('name', 'like', "%{$search}%")
            ->orWhere('product_attributes', 'like', "%{$search}%")
            ->orWhere('minimum_stock', 'like', "%{$search}%")
            ->get();
    } else {
        $products = Product::all();
    }

    return view('pages.practice.1', compact('products'));
    }   

    public function store(Request $request)
    {
    // Validasi input
    $request->validate([
        'category_id' => 'required|integer',
        'supplier_id' => 'required|integer',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'barang_masuk' => 'required|integer|min:0',
        'tanggal_masuk' => 'required|date',
        'status' => 'required|in:Pending,Diterima,Ditolak,Dikeluarkan',
    ]);

    // Menentukan apakah produk sudah ada
    $existingProduct = Product::where('category_id', $request->category_id)
        ->where('supplier_id', $request->supplier_id)
        ->where('name', $request->name)
        ->where('description', $request->description)
        ->first();

    if ($existingProduct) {
        // Jika produk ada, tambahkan barang_masuk dan update tanggal_masuk
        $existingProduct->barang_masuk += $request->barang_masuk; // Tambahkan jumlah barang masuk yang baru
        $existingProduct->tanggal_masuk = $request->tanggal_masuk; // Update tanggal masuk
        $existingProduct->save(); // Simpan perubahan
    } else {
        // Jika produk belum ada, buat produk baru
        Product::create($request->except(['barang_keluar', 'tanggal_keluar'])); // Sesuaikan dengan input HTML
    }

    return redirect()->route('products.index')->with('success', 'Product created or updated successfully.');
    }

    public function update(Request $request, Product $product) // Memperbarui produk
    {
        $request->validate([
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product) // Menghapus produk
    {
        try {
            $product->delete();
            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }
}
