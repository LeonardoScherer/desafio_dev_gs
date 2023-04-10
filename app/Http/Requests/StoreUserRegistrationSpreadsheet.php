<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRegistrationSpreadsheet extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|file|mimes:csv,xlsx|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'file.required' => trans('messages.Please select a file to upload.'),
            'file.mimes' => trans('messages.Only CSV and XLSX file types are allowed.')
        ];
    }
}
