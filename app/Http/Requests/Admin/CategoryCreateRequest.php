<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
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
        return [
            'name' => 'required|max:250|unique:categories',
            'status' => 'required'
        ];

    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập tên danh mục.',
            'name.max' => 'Tên danh mục không vượt quá 250 ký tự.',
            'name.unique' => 'Tên danh mục đã tồn tại.',
            'status.required' => 'Bạn chưa chọn trạng thái.',
        ];
    }
}
