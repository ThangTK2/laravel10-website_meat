<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
            'email' => 'required|email|exists:customers',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Bạn chưa nhập email.',
            'email.email' => 'Email phải đúng định dạng.',
            'email.exists' => 'Email không đúng.',
        ];
    }
}
