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
    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tên sản phẩm.',
            'name.max' => 'Tên sản phẩm không vượt quá 250 ký tự.',
            'name.unique' => 'Tên sản phẩm đã tồn tại.',
            'description.required' => 'Bạn chưa nhập mô tả sản phẩm.',
            'price.required' => 'Bạn chưa nhập giá sản phẩm.',
            'price.numeric' => 'Giá sản phẩm là kiểu số.',
            'sale_price.numeric' => 'Giá sản phẩm khuyến mãi là kiểu số.',
            'sale_price.lt' => 'Giá sản phẩm khuyến mãi phải nhỏ hơn giá sản phẩm ban đầu.',
            'image.file' => 'Hình ảnh sản phẩm là 1 tập tin.',
            'image.mimes' => 'Hình ảnh sản phẩm phải đúng định dạng.',
            'category_id.required' => 'Bạn chưa chọn danh mục.',
            'category_id.exists' => 'Danh mục đã tồn tại.',
        ];
    }
}
