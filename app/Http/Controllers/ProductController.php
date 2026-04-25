<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Category; // 1. Pastikan ini ter-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        // Gunakan with('category') agar query lebih ringan (Eager Loading)
        $products = Product::with(['category', 'user'])->paginate(10);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        $categories = Category::orderBy('name')->get(); // 2. Ambil data kategori
        
        // 3. Kirim $categories ke view
        return view('product.create', compact('users', 'categories'));
    }

    public function show(Product $product)
    {
        return view('product.view', compact('product'));
    }

    public function edit(Product $product)
    {
        Gate::authorize('update', $product);

        $users = User::orderBy('name')->get();
        $categories = Category::orderBy('name')->get(); // 4. Tambahkan juga di sini
        
        return view('product.edit', compact('product', 'users', 'categories'));
    }

    public function store(StoreProductRequest $request)
    {
        // Pastikan 'category_id' ada di rules StoreProductRequest
        Product::create($request->validated());
        return redirect()->route('product.index')->with('success', 'Produk berhasil ditambah!');
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        Gate::authorize('update', $product);

        // Pastikan 'category_id' ada di rules UpdateProductRequest
        $product->update($request->validated());
        return redirect()->route('product.index')->with('success', 'Produk berhasil diupdate!');
    }

    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }
}