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
            'data.attributes.act_code' => 'required|string|min:12',
            'data.attributes.report_code' => 'required|string|min:12',
            'data.attributes.date_notification' => 'required|string|date_format:Y-m-d',
            'data.attributes.date_received' => 'required|string|date_format:Y-m-d h:i',
            'data.attributes.start_date' => 'required|string|date_format:Y-m-d h:i',
            'data.attributes.end_date' => 'required|string|date_format:Y-m-d h:i',
            'data.attributes.task_type' => 'required|string',
            'data.attributes.work_status' => [
                'required',
                'string',
                Rule::in(['done', 'is_performed', 'execution_suspended'])
            ],
            'data.attributes.place_execution' => 'required|string',
            'data.attributes.coordinates' => 'required|array|size:2',
            'data.attributes.coordinates.N' => 'required|numeric',
            'data.attributes.coordinates.E' => 'required|numeric',
            'data.attributes.examined' => 'required|numeric',
            'data.attributes.persons' => 'required|array|size:1',
            'data.attributes.persons.*' => 'required|string',
            'data.attributes.ammunition' => 'array',
            'data.attributes.ammunition.*' => 'required_with:data.attributes.ammunitions',
            'data.attributes.all_ammunition' => 'required_with:data.attributes.ammunitions|integer|min:1',
            'data.attributes.tnt' => 'required|numeric',
            'data.attributes.detonator' => 'required|integer'
        ];
    }
}
