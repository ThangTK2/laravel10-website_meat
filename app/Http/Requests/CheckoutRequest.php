<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'name' => 'required|max:200',
            'email' => 'required|email|max:200',
            'phone' => 'required|numeric',
            'address' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Bạn chưa nhập email.',
            'email.email' => 'Email phải đúng định dạng.',
            'email.max' => 'Độ dài email tối đa là 255 ký tự.',
            'name.max' => 'Độ dài email tối đa là 255 ký tự.',
            'name.required' => 'Bạn chưa nhập họ tên.',
            'phone.required' => 'Bạn chưa nhập số điện thoại.',
            'phone.numeric' => 'Số điện thoại là kiểu số.',
            'address.required' => 'Bạn chưa nhập đại chỉ.',
        ];
    }
}
