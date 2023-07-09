<?php

namespace App\Http\Requests;

use App\Rules\Cidr;
use Illuminate\Foundation\Http\FormRequest;

class RoaCheckRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'prefix' => [
                'required',
                new Cidr()
            ],
            'as' => 'nullable|integer'
        ];
    }

    public function messages(): array
    {
        return [
            'as.integer' => 'Enter an AS Number without AS prefix e.g 63515',
            'body.required' => 'A message is required',
        ];
    }
}
