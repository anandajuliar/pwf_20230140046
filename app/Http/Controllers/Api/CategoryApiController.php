<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryApiController extends Controller
{
    // GET: Mengambil semua data kategori
    public function index()
    {
        try {
            $categories = Category::all();
            
            return response()->json([
                'message' => 'Berhasil mengambil data kategori',
                'data' => $categories
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error GET kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    // POST: Menambah kategori baru
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $category = Category::create($validated);

            return response()->json([
                'message' => 'Kategori berhasil ditambahkan!',
                'data' => $category
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error POST kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    // GET: Menampilkan data kategori berdasarkan ID (Ini yang tadi bikin Scramble blank!)
    public function show($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json([
                    'message' => 'Kategori tidak ditemukan',
                ], 404);
            }

            return response()->json([
                'message' => 'Berhasil mengambil data kategori',
                'data' => $category
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    // PUT/PATCH: Mengupdate kategori
    public function update(Request $request, $id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $category->update($validated);

            return response()->json([
                'message' => 'Kategori berhasil diupdate!',
                'data' => $category
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error PUT kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    // DELETE: Menghapus kategori
    public function destroy($id)
    {
        try {
            $category = Category::find($id);

            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            $category->delete();

            return response()->json([
                'message' => 'Kategori berhasil dihapus!'
            ], 200); 
        } catch (\Throwable $e) {
            Log::error('Error DELETE kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }
}