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
            'code' => 'required|unique:users,code|min:5|max:10',
            'name' => 'required|min:5|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:5|max:255',
            'role' => 'required|in:0,1,2',
            'dob' => 'required|date',
            'address' => 'required',
            'phone' => 'required|min:5|max:15',
            'status' => 'required|in:-1,1',
            'department_id' => 'required|exists:departments,id',
            'position_id' => 'required|exists:positions,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'Bạn chưa nhập dữ liệu...!',
            'image.minmes' => 'Định dạng không đúng',
            'code.required' => 'Bạn chưa nhập mã nhân viên...!',
            'code.min' => 'Mã nhân viên tối thiểu 5 kí tự...!',
            'code.max' => 'Mã nhân viên tối đa 5 kí tự...!',
            'code.unique' => 'Mã nhân viên đã tồn tại...!',
            'name.required' => 'Bạn chưa nhập Họ Tên...!',
            'name.min' => 'Tên tối thiểu 5 kí tự...!',
            'name.max' => 'Tên tối đa 255 kí tự...!',
            'email.required' => 'Bạn chưa nhập Email...!',
            'email.email' => 'Bạn chưa nhập đúng định dạng Email...!',
            'email.unique' => 'Email này đã tồn tại...!',
            'password.required' => 'Bạn chưa nhập Password...!',
            'password.confirmed' => 'Password và Confirm Password không khớp...!',
            'password.min' => 'Tối đa 255 kí tự',
            'password.max' => 'Tối thiểu 5 kí tự',
            'role.required' => 'Bạn chưa phân quyền...!',
            'role.in' => 'Phân quyền không chính xác.',
            'dob.required' => 'Bạn chưa chọn dữ liệu...!',
            'dob.date' => 'Lỗi ngày',
            'address.required' => 'Bạn chưa nhập dữ liệu...!',
            'phone.required' => 'Bạn chưa nhập dữ liệu...!',
            'phone.max' => 'Số điện thoại tối đa 15 kí tự...!',
            'phone.min' => 'Số điện thoại tối thiểu 5 kí tự...!',
            'status.required' => 'Bạn chưa chọn dữ liệu...!',
            'status.in' => 'Trạng thái không chính xác...!',
            'department_id.required' => 'Bạn chưa chọn phòng ban...!',
            'department_id.exists' => 'Lỗi!',
            'position_id.required' => 'Bạn chưa chọn chức vụ...!',
            'position_id.exists' => 'Lỗi',
        ];
    }   
}
