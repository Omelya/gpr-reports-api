<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return boolean
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules(): array
    {
        return [
            'data.type'                => [
                'required',
                Rule::in('users'),
            ],
            'data.attributes.username' => 'required|email',
            'data.attributes.password' => 'required|min:8',
        ];
    }
}
