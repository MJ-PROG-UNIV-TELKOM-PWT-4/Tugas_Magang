<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller; 

class StockController extends Controller
{
    public function index()
    {
        $products = DB::table('products')->get();
        return view('stock.index', compact('products'));
    }

    public function updateStockOut(Request $request, $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'date' => 'required|date',
        ]);

        DB::table('stock_transactions')->insert([
            'product_id' => $productId,
            'user_id' => auth()->id() ?? 1,
            'type' => 'keluar',
            'quantity' => $request->quantity,
            'date' => $request->date,
            'status' => $request->status ?? 'Pending',
            'notes' => 'nullable|string'
        ]);

        return redirect()->back()->with('success', 'Barang keluar berhasil ditambahkan.');
    }

    public function updateMinimumStock(Request $request, $productId)
    {
        $request->validate([
            'minimum_stock' => 'required|integer|min:0',
        ]);

        DB::table('products')->where('id', $productId)->update([
            'minimum_stock' => $request->minimum_stock,
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Stok minimum berhasil diperbarui.');
    }
}
