<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all(); // Mengambil semua data kategori
        return view('pages.practice.AdminProduk', compact('categories')); // (Kalau view-nya memang di AdminProduk)
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Categories::create($request->all());

        // Logging aktivitas
        logActivity('create', 'category', $category->id, 'Menambahkan kategori: ' . $category->name);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show($id)
    {
        $category = Categories::findOrFail($id); // Menampilkan detail kategori tertentu
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = Categories::findOrFail($id);
        $category->update($request->all());

        // Logging aktivitas
        logActivity('update', 'category', $category->id, 'Memperbarui kategori: ' . $category->name);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);

        // Logging sebelum dihapus
        logActivity('delete', 'category', $category->id, 'Menghapus kategori: ' . $category->name);

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
