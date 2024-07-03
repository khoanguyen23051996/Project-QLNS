<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PositionUpdateRequest extends FormRequest
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
        $id = $this->route('positionid');
        return [
            'name' => 'required|unique:positions,name,' . $id . ',id|max:255',
            'code' => 'required|unique:positions,code,' . $id . ',id|max:10|min:3',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập Tên bộ phận...!',
            'name.max' => 'Tên tối đa 255 kí tự...!',
            'name.unique' => 'Tên bộ phận này đã tồn tại...!',
            'code.unique' => 'Mã chức vụ đã tồn tại...!',
            'code.max' => 'Mã chức vụ tối đa 10 kí tự...!',
            'code.min' => 'Mã chức vụ ít nhất 3 kí tự...!',
        ];
    }
}
