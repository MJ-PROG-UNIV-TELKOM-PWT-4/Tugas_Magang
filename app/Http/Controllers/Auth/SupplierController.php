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
        return view('pages.practice.3', compact('suppliers'));
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

    return view('pages.practice.3', compact('suppliers'));
    }   

    public function store(Request $request) // Add Supplier
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:100',
            'phone' => 'nullable|string',
            'email' => 'required|email|min:0',
        ]);

        Supplier::create($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier created successfully.');
    }

    public function show(Supplier $supplier) // Show Supplier
    {
        return view('pages.practice.3', compact('suppliers')); // Update path view
    }

    public function update(Request $request, Supplier $supplier) // Update Supplier
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'address' => 'required|string|max:100',
            'phone' => 'nullable|string',
            'email' => 'required|email|min:0',
        ]);

        $supplier->update($request->all());

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy(Supplier $supplier) // Delete Supplier
    {
        try {
            $supplier->delete();
            return redirect()->route('suppliers.index')->with('success', 'Supplier deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('suppliers.index')->with('error', 'Failed to delete Supplier: ' . $e->getMessage());
        }
    }
}
