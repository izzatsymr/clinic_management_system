<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'contact_no' => ['required', 'max:255', 'string'],
            'address' => ['required', 'max:255', 'string'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'in:male,female,other'],
            'email' => ['required', 'unique:users,email', 'email'],
            'password' => ['required'],
            'specialization' => ['required', 'max:255', 'string'],
            'schedule' => ['required', 'date'],
            'roles' => 'array',
        ];
    }
}
