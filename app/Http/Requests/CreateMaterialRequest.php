<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMaterialRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'unit_id' => 'required',
            'name' => 'required',
            'code' => 'required',
            'brand_name' => 'required',
            'manufacture_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Category field is required',
            'unit_id.required' => 'Unit field is required',
            'manufacture_id.required' => 'Manufacture field is required'
        ];
    }

}
