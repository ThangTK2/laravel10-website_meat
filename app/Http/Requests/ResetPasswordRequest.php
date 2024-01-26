<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
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
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'password.required' => 'Bạn chưa nhập mật khẩu.',
            'password.min' => 'Độ dài password tối thiểu là 4 ký tự.',
            'confirm_password.required' => 'Bạn chưa nhập lại mật khẩu.',
            'confirm_password.same' => 'Mật khẩu không khớp.'
        ];
    }
}
