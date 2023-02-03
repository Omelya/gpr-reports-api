<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsersRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'data.type' => [
                'required',
                Rule::in('users')
            ],
            'data.attributes.username' => 'required|email',
            'data.attributes.password' => 'required|string|confirmed|min:8',
            'data.attributes.first_name' => 'required|string',
            'data.attributes.last_name' => 'required|string',
            'data.attributes.father_name' => 'required|string',
            'data.attributes.birthday' => 'required|string|date_format:Y-m-d',
            'data.attributes.position' => 'required|string',
            'data.attributes.rank' => 'required|string',
        ];
    }
}
