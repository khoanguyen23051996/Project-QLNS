<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use TijsVerkoyen\CssToInlineStyles\Css\Rule\Rule;

class DepartmentUpdateRequest extends FormRequest
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
            'name' => 'required|unique:departments,name|max:255',
            'code' => 'required|unique:departments,code|max:10|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập Tên bộ phận...!',
            'name.max' => 'Tên tối đa 255 kí tự...!',
            'name.unique' => 'Tên bộ phận này đã tồn tại...!',
            'code.unique' => 'Mã bộ phận đã tồn tại...!',
            'code.max' => 'Mã bộ phận tối đa 10 kí tự...!',
            'code.min' => 'Mã bộ phận ít nhất 3 kí tự...!',
        ];
    }
}
