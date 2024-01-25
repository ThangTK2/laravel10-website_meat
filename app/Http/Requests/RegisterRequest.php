<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'email' => 'required|email|max:200|unique:customers',
            'phone' => 'required|numeric|unique:customers',
            'address' => 'required',
            'gender' => 'required',
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Bạn chưa nhập email.',
            'email.email' => 'Email phải đúng định dạng.',
            'email.unique' => 'Email này đã tồn tại. Hãy nhập email khác.',
            'email.max' => 'Độ dài email tối đa là 255 ký tự.',
            'name.required' => 'Bạn chưa nhập họ tên.',
            'phone.required' => 'Bạn chưa nhập số điện thoại.',
            'phone.numeric' => 'Số điện thoại là kiểu số.',
            'phone.unique' => 'Số điện thoại này đã tồn tại. Hãy nhập số khác.',
            'address.required' => 'Bạn chưa nhập đại chỉ.',
            'gender.required' => 'Bạn chưa chọn giới tính.',
            'password.required' => 'Bạn chưa nhập mật khẩu.',
            'password.min' => 'Độ dài password tối thiểu là 4 ký tự.',
            'confirm_password.required' => 'Bạn chưa nhập lại mật khẩu.',
            'confirm_password.same' => 'Mật khẩu không khớp.'
        ];
    }
}
