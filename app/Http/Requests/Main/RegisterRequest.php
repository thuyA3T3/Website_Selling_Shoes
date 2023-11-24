<?php

namespace App\Http\Requests\Main;

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
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required|same:password',

            //
        ];
    }
    public function messages()
    {
        return [
            'firstName.required' => 'Vui lòng nhập họ.',
            'lastName.required' => 'Vui lòng nhập tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Vui lòng nhập email hợp lệ.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'confirmPassword.required' => 'Vui lòng xác nhận mật khẩu.',
            'confirmPassword.same' => 'Mật khẩu và Xác nhận mật khẩu không khớp.',
        ];
    }
}
