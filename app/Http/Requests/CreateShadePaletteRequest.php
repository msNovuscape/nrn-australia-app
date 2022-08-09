<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateShadePaletteRequest extends FormRequest
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
        $shade_id = $this->request->all()['formData']['shade_id'];
        $page_no = $this->request->all()['formData']['page_no'];
        return [
            $shade_id => 'required',
            $page_no => 'required'
        ];
    }

    public function messages()
    {
        return [
            'shade_id.required' => 'Shade Card field is required'
        ];
    }
}
