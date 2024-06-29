<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|confirmed',
            // 'password_confirmation' => 'required|min:5|confirmed',
            'position' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập Họ Tên...!',
            'name.min' => 'Tên tối thiểu 5 kí tự...!',
            'name.max' => 'Tên tối đa 255 kí tự...!',
            'email.required' => 'Bạn chưa nhập Email...!',
            'email.email' => 'Bạn chưa nhập đúng định dang Email...!',
            'email.unique' => 'Email này đã tồn tại...!',
            'password.required' => 'Bạn chưa nhập Password...!',
            'password.min' => 'Password tối thiểu 5 kí tự...!',
            'password.confirmed' => 'Password và Confirm Password không khớp...!',
            // 'password_confirmation.required' => 'Bạn chưa nhập xác nhận Password...!',
            // 'password_confirmation.min' => 'Bạn chưa nhập Password!',
            'position.required' => 'Bạn chưa phân quyền...!',
        ];
    }
}
