<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcademicSessionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'training_id'       => 'required',
            'child_id'          => 'required',
            'trainer_id'        => 'required',
            'date'              => 'required',
            'actual_duration'   => 'required',
            'achivement_id'     => 'required',
            'status'            => 'required',
        ];
    }
}
