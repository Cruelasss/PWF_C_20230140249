<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index()
    {
        // Menampilkan total produk per kategori menggunakan withCount
        $categories = Category::withCount('products')->get();
        return view('category.index', compact('categories'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name|max:255',
        ]);

        Category::create($validated);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    // Biasanya kategori tidak butuh halaman show detail, tapi ini kodenya jika perlu
    public function show(Category $category)
    {
        return view('category.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            // ignore($category->id) agar saat update nama yang sama tidak dianggap error "unique"
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($validated);

        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui!');
    }

    public function destroy(Category $category)
    {
        // 🔒 Opsional: Hanya Admin yang boleh hapus kategori
        Gate::authorize('manage-product');

        $category->delete();

        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus!');
    }
}