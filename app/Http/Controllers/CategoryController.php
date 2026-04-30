<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        // Ini yang bikin layarmu putih tadi, sekarang sudah mengarah ke file view!
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // Validasi: nama wajib diisi dan tidak boleh sama dengan yang sudah ada di tabel category
            'name' => 'required|string|max:255|unique:category,name',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show(Category $category)
    {
        // Biasanya kategori tidak butuh halaman show terpisah
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:category,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus.');
    }
}