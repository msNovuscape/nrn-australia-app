<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMemberRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'dob' => 'required',
            'residential_address' => 'required',
            'suburb' => 'required',
            'state_id' => 'required',
            'country_id' => 'required',
            'postcode' => 'required',
            'mobile_number' => 'required',
            'email' => 'required',
            'gender_id' => 'required',
            'region_id' => 'required',
            'membership_type_id' => 'required',
            'payment_slip' => 'required',
            'bank_name' => 'required',
            'payment_date' => 'required',
            'account_name' => 'required',
            'amount' => 'required',


        ];
    }

}
