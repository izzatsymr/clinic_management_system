<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentStoreRequest extends FormRequest
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
            'date_time' => ['required', 'date'],
            'status' => ['required', 'in:scheduled,completed,cancelled'],
            'note' => ['required', 'max:255', 'string'],
            'patient_id' => ['required', 'exists:patients,id'],
            'user_id' => ['required', 'exists:users,id'],
        ];
    }
}
