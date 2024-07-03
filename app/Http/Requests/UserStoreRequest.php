<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

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
            'code' => 'required|min:5|max:10',
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:5|max:255',
            'role' => 'required|in:0,1,2',
            'dob' => 'required|date',
            'address' => 'required',
            'phone' => 'required|max:15',
            'status' => 'required|in:-1,1',
            'image' => 'required',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bạn chưa nhập Họ Tên...!',
            'name.min' => 'Tên tối thiểu 5 kí tự...!',
            'name.max' => 'Tên tối đa 255 kí tự...!',
            'email.required' => 'Bạn chưa nhập Email...!',
            'email.email' => 'Bạn chưa nhập đúng định dạng Email...!',
            'email.unique' => 'Email này đã tồn tại...!',
            'password.required' => 'Bạn chưa nhập Password...!',
            'password.confirmed' => 'Password và Confirm Password không khớp...!',
            'position.required' => 'Bạn chưa phân quyền...!',
            'position.in' => 'Phân quyền không chính xác.',
        ];
    }   
}
