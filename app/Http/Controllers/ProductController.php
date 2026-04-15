<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
// Import Gate untuk otorisasi
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        // Menggunakan paginate agar tidak error "hasPages" di view
        $products = Product::paginate(10);

        return view('product.index', compact('products'));
    }

    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('product.create', compact('users'));
    }

   
    public function show(Product $product)
    {
        return view('product.view', compact('product'));
    }

    public function edit(Product $product)
    {
        // 🔒 Pakai Gate::authorize karena $this->authorize tidak ada di Controller abstract
        Gate::authorize('update', $product);

        $users = User::orderBy('name')->get();
        return view('product.edit', compact('product', 'users'));
    }

  

    public function destroy(Product $product)
    {
        // 🔒 Cek izin hapus (Owner atau Admin)
        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }

    public function store(StoreProductRequest $request) // Pakai StoreProductRequest
{
    // Data otomatis tervalidasi sebelum masuk ke sini
    Product::create($request->validated());

    return redirect()->route('product.index')->with('success', 'Produk berhasil ditambah!');
}

public function update(UpdateProductRequest $request, Product $product) // Pakai UpdateProductRequest
{
    Gate::authorize('update', $product);

    $product->update($request->validated());

    return redirect()->route('product.index')->with('success', 'Produk berhasil diupdate!');
}
}