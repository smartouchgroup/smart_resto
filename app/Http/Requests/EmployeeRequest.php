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
        if(!in_array(auth()->user()->roleId, [1, 2, 3])) return false;
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
            'email' => 'required|string|unique:users,email',
            'confirm_email' => 'required|same:email',
            'phone' => 'required|integer|min:8|unique:users,phone',
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