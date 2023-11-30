<?php

namespace App\Http\Requests\Main;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            //
            'email' => 'required|email',
            'password' => 'required',
            'newPassword' => 'required|same:password',

        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Vui lòng nhập email hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'newPassword.required' => 'Vui lòng xác nhận mật khẩu.',
            'newPassword.same' => 'Mật khẩu và Xác nhận mật khẩu không khớp.',
        ];
    }
}
