<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRequest extends FormRequest
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
            'old_password' => ['required', function($attr, $value, $fail){ //closure
                $auth = auth('cus')->user();
                if (!Hash::check($value, $auth->password)){
                   return $fail('Mật khẩu của bạn không đúng');
                }
            }],
            'password' => 'required|min:4',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => 'Bạn chưa nhập mật khẩu.',
            'password.required' => 'Bạn chưa nhập mật khẩu mới.',
            'password.min' => 'Độ dài password tối thiểu là 4 ký tự.',
            'confirm_password.required' => 'Bạn chưa nhập lại mật khẩu.',
            'confirm_password.same' => 'Mật khẩu nhập lại không khớp.',
        ];
    }
}
