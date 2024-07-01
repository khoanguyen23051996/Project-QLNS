<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UserUpdateRequest extends FormRequest
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
            'email' => ['required', 'email', Rule::unique('users')->ignore(request()->id)],
            'password' => [
                'nullable', 
                'confirmed', 
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'position' => 'required',
        ];
    }

    public function messages()
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
            'position.required' => 'Bạn chưa phân quyền...!',
        ];
    }
}
