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
        'name'     => 'required|string|min:5|max:255',
        'qty'      => 'required|integer|min:1',
        'price'    => 'required|numeric|min:10000',
        'user_id'  => 'required|exists:users,id',
    ];
}

public function messages(): array
{
    return [
        'name.required' => 'Nama produk jangan dikosongin ya bolo!',
        'name.min' => 'Nama produk kependekan, minimal 5 huruf.',
        'qty.required' => 'Jumlah stok wajib diisi.',
        'price.numeric' => 'Harga harus berupa angka.',
    ];
}

}
