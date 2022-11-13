<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InvolvementsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => 'involvement',
            'attributes' => [
                'act_code' => $this->act_code,
                'report_code' => $this->report_code,
                'date_notification' => $this->date_notification,
                'date_received' => $this->date_received,
                'start_date' => $this->start_date,
                'end_date' => $this->end_date,
                'task_type' => $this->task_type,
                'work_status' => $this->work_status,
                'place_execution' => $this->place_execution,
                'coordinates' => $this->coordinates,
                'examined' => $this->examined,
                'persons' => $this->persons,
                'ammunition' => $this->ammunition,
                'all_ammunition' => $this->all_ammunition,
                'tnt' => $this->tnt,
                'detonator' => $this->detonator
            ]
        ];
    }
}
