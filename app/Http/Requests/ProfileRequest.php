<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class ProfileRequest extends FormRequest
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
        $auth = auth('cus')->user();
        return [
            'name' => 'required|max:200',
            'email' => 'required|email|max:200|unique:customers,email,'.$auth->id.'', //nó sẽ bỏ qua email hiện tại
            'phone' => 'required|numeric|unique:customers,phone,'.$auth->id.'',
            'address' => 'required',
            'gender' => 'required',
            'password' => ['required', function($attr, $value, $fail) use($auth) { //closure
                if (!Hash::check($value, $auth->password)){
                   return $fail('Mật khẩu của bạn không đúng');
                }
            }],
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
        ];
    }
}
