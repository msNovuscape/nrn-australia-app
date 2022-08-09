<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EquipmentRequest extends FormRequest
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
            'manufacture_id' => 'required',
            'variant' => 'required',
            'model_no' => 'required',
            'date_of_used' => 'required',
            'expected_life' => 'required',
            'purchase_amount' => 'required',
//            'operating_cost' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Category field is required',
            'manufacture_id.required' => 'Manufacture field is required'
        ];
    }
}
