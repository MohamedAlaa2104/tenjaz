<?php

namespace App\Http\Requests\Api\V1\Product;

use App\Traits\HasApiFailedValidation;
use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    use HasApiFailedValidation;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Access the product ID from the route
        $productId = $this->route('product');

        return [
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'slug' => "nullable|string|unique:products,slug,{$productId}",
            'is_active' => 'boolean',
        ];
    }

}
