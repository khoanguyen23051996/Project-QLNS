<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentStoreRequest extends FormRequest
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
            'name' => 'required|unique:department,name|max:255',
            'departmentid' => 'required|unique:department,departmentid|max:5|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên bộ phận...!',
            'name.max' => 'Tên tối đa 255 kí tự...!',
            'name.unique' => 'Bộ phận này đã tồn tại...!',
            'departmentid.required' => 'Bạn chưa nhập mã bộ phận...!',
            'departmentid.unique' => 'Mã bộ phận này đã tồn tại...!',
            'departmentid.max' => 'Mã bộ phận tối đa 5 kí tự...!',
            'departmentid.min' => 'Mã bộ phận ít nhất 3 kí tự...!',
        ];
    }
}
