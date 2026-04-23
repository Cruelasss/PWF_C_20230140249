<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
{
    return true;
}

public function rules(): array
{
    return [
        'name'     => 'sometimes|string|min:5|max:255',
        'qty'      => 'sometimes|integer|min:0',
        'price'    => 'sometimes|numeric|min:10000',
        'user_id'  => 'sometimes|exists:users,id',
    ];
}

}
