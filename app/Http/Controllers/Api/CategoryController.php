<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index() {
        return response()->json(['data' => Category::all()], 200);
    }

    public function store(Request $request) {
        $validated = $request->validate(['name' => 'required|unique:categories,name']);
        $category = Category::create($validated);
        return response()->json(['message' => 'Kategori dibuat!', 'data' => $category], 201);
    }

    public function show($id) {
        $category = Category::find($id);
        return $category ? response()->json(['data' => $category]) : response()->json(['message' => 'Not Found'], 404);
    }

    public function update(Request $request, $id) {
        $category = Category::find($id);
        if(!$category) return response()->json(['message' => 'Not Found'], 404);
        
        $validated = $request->validate(['name' => 'required|unique:categories,name,'.$id]);
        $category->update($validated);
        return response()->json(['message' => 'Kategori diupdate!', 'data' => $category], 200);
    }

    public function destroy($id) {
        $category = Category::find($id);
        if($category) $category->delete();
        return response()->json(['message' => 'Kategori dihapus'], 200);
    }
}