<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('pages.practice.AdminProduk', compact('products'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $products = Product::where('name', 'like', "%{$search}%")
                ->orWhere('product_attributes', 'like', "%{$search}%")
                ->orWhere('minimum_stock', 'like', "%{$search}%")
                ->get();
        } else {
            $products = Product::all();
        }

        return view('pages.practice.AdminProduk', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'barang_masuk' => 'required|integer|min:0',
            'tanggal_masuk' => 'required|date',
            'status' => 'required|in:Pending,Diterima,Ditolak,Dikeluarkan',
        ]);

        $existingProduct = Product::where('category_id', $request->category_id)
            ->where('supplier_id', $request->supplier_id)
            ->where('name', $request->name)
            ->where('description', $request->description)
            ->first();

        if ($existingProduct) {
            $existingProduct->barang_masuk += $request->barang_masuk;
            $existingProduct->tanggal_masuk = $request->tanggal_masuk;
            $existingProduct->save();

            logActivity('update', 'product', $existingProduct->id, 'Menambahkan stok produk: ' . $existingProduct->name);
        } else {
            $newProduct = Product::create($request->except(['barang_keluar', 'tanggal_keluar']));
            logActivity('create', 'product', $newProduct->id, 'Menambahkan produk baru: ' . $newProduct->name);
        }

        return redirect()->route('products.index')->with('success', 'Product created or updated successfully.');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'supplier_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $product->update($request->all());

        logActivity('update', 'product', $product->id, 'Mengubah produk: ' . $product->name);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        try {
            logActivity('delete', 'product', $product->id, 'Menghapus produk: ' . $product->name);
            $product->delete();

            return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('products.index')->with('error', 'Failed to delete product: ' . $e->getMessage());
        }
    }
}
