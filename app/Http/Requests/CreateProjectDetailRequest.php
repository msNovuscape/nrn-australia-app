<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProjectDetailRequest extends FormRequest
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
            'product_id' => 'required',
            'employee_id' => 'required',
            'contract_id' => 'required',
            'project_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Category field is required',
            'product_id.required' => 'Product field is required',
            'employee_id.required' => 'Product leader is required',
            'contract_id.required' => 'Contract Type field is required',
        ];
    }
}
