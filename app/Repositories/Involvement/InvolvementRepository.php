<?php

namespace App\Repositories\Involvement;

use App\Models\Involvement;
use App\Repositories\BaseRepository;
use App\Services\Involvement\DTO\InvolvementDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class InvolvementRepository extends BaseRepository
{
    public function create(InvolvementDTO $involvementDTO)
    {
        return $this
            ->query()
            ->create([
                'act_code' => $involvementDTO->getActCode(),
                'report_code' => $involvementDTO->getReportCode(),
                'date_notification' => $involvementDTO->getDateNotification(),
                'date_received' => $involvementDTO->getDataReceived(),
                'start_date' => $involvementDTO->getStartDate(),
                'end_date' => $involvementDTO->getEndDate(),
                'task_type' => $involvementDTO->getTaskType(),
                'work_status' => $involvementDTO->getWorkStatus(),
                'place_execution' => $involvementDTO->getPlaceExecution(),
                'coordinates' => json_encode($involvementDTO->getCoordinates()),
                'examined' => $involvementDTO->getExamined(),
                'persons' => json_encode($involvementDTO->getPersons()),
                'ammunition' => json_encode($involvementDTO->getAmmunition()),
                'all_ammunition' => $involvementDTO->getAllAmmunition(),
                'tnt' => $involvementDTO->getTnt(),
                'detonator' => $involvementDTO->getDetonator()
            ]);
    }

    public function getAllInvolvement()
    {
        return $this
            ->query()
            ->select([
                'id',
                'act_code',
                'report_code',
                'date_notification',
                'task_type',
                'place_execution',
                'examined',
                'ammunition'
            ])
            ->get();
    }

    public function removeInvolvement(string $id)
    {
        return $this
            ->query()
            ->where('id', $id)
            ->delete();
    }

    public function getModel(): Involvement
    {
        return new Involvement();
    }
}
