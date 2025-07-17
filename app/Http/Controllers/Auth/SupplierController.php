<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index() // Menampilkan semua supplier
    {
        $suppliers = Supplier::all();
        return view('pages.practice.AdminSupplier', compact('suppliers'));
    }

    public function search(Request $request) // Menampilkan semua supplier
    {
        // Ambil query pencarian dari input
        $search = $request->input('search');

        // Jika ada pencarian, gunakan untuk memfilter supplier
        if ($search) {
            $suppliers = Supplier::where('name', 'like', "%{$search}%")
                ->orWhere('id', 'like', "%{$search}%")
                ->get();
        } else {
            $suppliers = Supplier::all();
        }

        return view('pages.practice.AdminSupplier', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:100',
            'phone' => 'nullable|string',
            'email' => 'required|email|min:0',
        ]);

        $supplier = Supplier::create($request->all());

        logActivity('create', 'supplier', $supplier->id, 'Menambahkan supplier: ' . $supplier->name);

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:100',
            'phone' => 'nullable|string',
            'email' => 'required|email|min:0',
        ]);

        $supplier->update($request->all());

        logActivity('update', 'supplier', $supplier->id, 'Memperbarui supplier: ' . $supplier->name);


        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }


    public function show(Supplier $supplier) // Show Supplier
    {
        return view('pages.practice.AdminSupplier', compact('suppliers')); // Update path view
    }

    public function destroy(Supplier $supplier)
    {
        try {
            $supplierName = $supplier->name;
            $supplierId = $supplier->id;
            $supplier->delete();

            logActivity('delete', 'supplier', $supplier->id, 'Menghapus supplier: ' . $supplier->name);


            return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('suppliers.index')->with('error', 'Failed to delete Supplier: ' . $e->getMessage());
        }
    }
}