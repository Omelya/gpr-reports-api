<?php

namespace App\Http\Transformers\Involvement;

use App\Services\Involvement\DTO\InvolvementDTO;
use Illuminate\Http\Request;

class InvolvementTransformer
{
    public function transform(Request $request)
    {
        return new InvolvementDTO(
            $request->json('data.attributes.act_code'),
            $request->json('data.attributes.report_code'),
            $request->json('data.attributes.date_notification'),
            $request->json('data.attributes.date_received'),
            $request->json('data.attributes.start_date'),
            $request->json('data.attributes.end_date'),
            $request->json('data.attributes.task_type'),
            $request->json('data.attributes.work_status'),
            $request->json('data.attributes.place_execution'),
            $request->json('data.attributes.coordinates'),
            $request->json('data.attributes.examined'),
            $request->json('data.attributes.persons'),
            $request->json('data.attributes.ammunition'),
            $request->json('data.attributes.all_ammunition'),
            $request->json('data.attributes.tnt'),
            $request->json('data.attributes.detonator')
        );
    }
}
