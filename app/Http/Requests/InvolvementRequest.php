<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class InvolvementRequest extends FormRequest
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
                Rule::in('report')
            ],
            'data.attribute.act_code' => 'required|string|min:12',
            'data.attributes.report_code' => 'required|string|min:12',
            'data.attributes.date_notification' => 'required|string|date',
            'data.attributes.date_received' => 'required|string|date',
            'data.attributes.start_date' => 'required|string|date',
            'date.attributes.end_date' => 'required|string|date',
            'data.attributes.task_type' => 'required|string',

        ];
    }
}
