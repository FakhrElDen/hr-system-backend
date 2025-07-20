<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
            'name'      => ['required', 'string', 'max:100'],
            'email'     => ['required', 'email', 'max:255', 'unique:employees,email'],
            'phone'     => ['nullable', 'string', 'max:15'],
            'position'  => ['required', 'string'],
            'salary'    => ['required', 'numeric', 'min:0'],
            'hired_at'  => ['required', 'date'],
            'status'    => ['required', 'in:0,1'],
            'photo'     => ['nullable', 'image'],
        ];
    }
}
