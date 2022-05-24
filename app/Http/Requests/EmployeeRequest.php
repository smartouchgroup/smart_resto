<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'email' => 'required|string|email',
            'phone' => 'required|integer|min:8|',
            'group' => 'required',
            'organizationId' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'required' => "Ce champs est obligatoire.",
            'email.unique' => "L'email entré est déjà pris.",
            "phone.unique" => "Le numéro de téléphone entré est déjà pris.",

        ];

    }
}
