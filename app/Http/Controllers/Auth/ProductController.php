<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini
use Dompdf\Dompdf; // Tambahkan ini juga
use Dompdf\Options; // Dan ini

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

    public function exportPdf()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name as category_name')
            ->get();

        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('isHtml5ParserEnabled', true);
        
        $dompdf = new Dompdf($options);
        
        // HTML langsung di dalam controller
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <title>Data Produk</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    font-size: 12px;
                    margin: 20px;
                }
                .header {
                    text-align: center;
                    margin-bottom: 30px;
                }
                .header h1 {
                    margin: 0;
                    color: #333;
                }
                .header p {
                    margin: 5px 0;
                    color: #666;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                th, td {
                    border: 1px solid #ddd;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f8f9fa;
                    font-weight: bold;
                }
                tr:nth-child(even) {
                    background-color: #f9f9f9;
                }
                .footer {
                    margin-top: 30px;
                    text-align: right;
                    font-size: 10px;
                    color: #666;
                }
            </style>
        </head>
        <body>
            <div class="header">
                <h1>DATA PRODUK</h1>
                <p>Sistem Manajemen Stok Barang</p>
                <p>Tanggal Export: ' . date('d F Y, H:i:s') . '</p>
            </div>

            <table>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="15%">Nama Produk</th>
                        <th width="15%">Kategori</th>
                        <th width="10%">ID Supplier</th>
                        <th width="40%">Attribut Produk</th>
                        <th width="15%">Stok Minimum</th>
                    </tr>
                </thead>
                <tbody>';
        
        // Generate table rows
        foreach($products as $index => $product) {
            $html .= '
                    <tr>
                        <td>' . ($index + 1) . '</td>
                        <td>' . htmlspecialchars($product->name) . '</td>
                        <td>' . htmlspecialchars($product->category_name) . '</td>
                        <td>' . htmlspecialchars($product->supplier_id) . '</td>
                        <td>' . htmlspecialchars($product->description) . '</td>
                        <td>' . htmlspecialchars($product->minimum_stock) . '</td>
                    </tr>';
        }
        
        $html .= '
                </tbody>
            </table>

            <div class="footer">
                <p>Total Produk: ' . count($products) . '</p>
                <p>Dicetak pada: ' . date('d F Y, H:i:s') . '</p>
            </div>
        </body>
        </html>';
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        
        return $dompdf->stream('Data_Produk_' . date('Y-m-d_H-i-s') . '.pdf');
    }
}