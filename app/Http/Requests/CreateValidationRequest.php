<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateValidationRequest extends FormRequest
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
            'first_name'=> 'required|alpha|max:30',
            'last_name'=> 'required|alpha|max:30',
            'title'=> 'required|max:255',
            'business_name'=> 'required|max:50',
            'type_of_operation'=> 'required|max:50',
            'distributor_name'=> 'required|max:50',
            'email'=> 'required|email|unique:entries|max:255',
            'phone_number'=> 'required|numeric|digits:10',
            'terms_and_conditions'=> 'accepted'
       ];
    }
}
