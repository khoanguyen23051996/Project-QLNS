<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffStoreReqest extends FormRequest
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
            'employeeid' => 'required|unique:staff,employeeid|max:5|min:3',
            'name' => 'required|max:255',
            'phone' => 'required|max:15',
            'dob' => 'required',
            'address' => 'required',
            'status' => 'required',
            'image' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên nhân viên...!',
            'name.max' => 'Tên tối đa 255 kí tự...!',
            'employeeid.required' => 'Bạn chưa nhập mã nhân viên...!',
            'employeeid.unique' => 'Mã nhân viên này đã tồn tại...!',
            'employeeid.max' => 'Mã nhân viên tối đa 5 kí tự...!',
            'departmentid.min' => 'Mã nhân viên ít nhất 3 kí tự...!',
            'phone.required' => 'Bạn chưa nhập SĐT...!',
            'phone.max' => 'SĐT tối đa 15 kí tự...!',
            'dob.required' => 'Bạn chưa nhập ngày sinh nhân viên...!',
            'address.required' => 'Bạn chưa nhập địa chỉ nhân viên...!',
            'status.required' => 'Bạn chưa nhập trạng thái nhân viên...!',
            'image.required' => 'Bạn chưa nhập hình ảnh nhân viên...!',
        ];
    }
}
