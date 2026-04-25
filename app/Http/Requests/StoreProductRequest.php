<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   public function authorize(): bool
{
    return true; // Ubah jadi true agar diizinkan
}

public function rules(): array
{
    return [
        'name' => 'required|min:5',
        'qty' => 'required|numeric',
        'price' => 'required|numeric',
        'user_id' => 'required|exists:users,id',
        'category_id' => 'required|exists:categories,id', // Validasi untuk category_id
    ];
}
public function messages(): array
{
    return [
        'name.required' => 'Nama produk jangan dikosongin ya bolo!',
        'name.min' => 'Nama produk kependekan, minimal 5 huruf.',
        'qty.required' => 'Jumlah stok wajib diisi.',
        'price.numeric' => 'Harga harus berupa angka.',
        'category_id.exists' => 'Kategori yang dipilih tidak valid.',
    ];
}

}
