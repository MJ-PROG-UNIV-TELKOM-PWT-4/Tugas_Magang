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
        return view('pages.practice.1', compact('categories')); // Mengembalikan tampilan dengan data kategori
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Categories::create($request->all()); // Menyimpan data kategori baru
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
        $category->update($request->all()); // Memperbarui kategori
        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Categories::findOrFail($id);
        $category->delete(); // Menghapus kategori
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}