<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
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
        $product = $this->route('product'); // Lấy id từ route
        return [
            'name' => 'required|max:255|unique:products,name,'.$product->id,
            'description' => 'required',
            'price' => 'required|numeric',
            'sale_price' => 'numeric|lt:price', //lt: giá trị phải nhỏ hơn giá trị của trường 'price'.
            'image' => 'file|mimes:jpg,jpeg,png,gif',
            'category_id' => 'required|exists:categories,id',
        ];
    }
}
