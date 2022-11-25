<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReportRequest extends FormRequest
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
            'filter.date_from' => 'required|string|date_format:Y-m-d',
            'filter.date_to' => 'required|string|date_format:Y-m-d',
            'filter.reports_type' => [
                'string',
                Rule::in(['all', 'ОР', 'ГР', 'ТО'])
            ]
        ];
    }
}
