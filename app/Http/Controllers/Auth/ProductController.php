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

    public function store(Request $request) // Menyimpan produk baru
    {
        $request->validate([
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'minimum_stock' => 'required|integer|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product) // Menampilkan detail produk
    {
        return view('pages.practice.show', compact('product')); // Update path view sesuai
    }

    public function update(Request $request, Product $product) // Memperbarui produk
    {
        $request->validate([
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'minimum_stock' => 'required|integer|min:0',
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