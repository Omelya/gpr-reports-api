<?php

namespace App\Repositories\Involvement;

use App\Models\Involvement;
use App\Repositories\BaseRepository;
use App\Services\Involvement\DTO\InvolvementDTO;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class InvolvementRepository extends BaseRepository
{
    public function create(InvolvementDTO $involvementDTO): Model|Builder
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
                'coordinates' => json_encode($involvementDTO->getCoordinates(), JSON_THROW_ON_ERROR),
                'examined' => $involvementDTO->getExamined(),
                'persons' => json_encode($involvementDTO->getPersons(), JSON_THROW_ON_ERROR),
                'ammunition' => json_encode($involvementDTO->getAmmunition(), JSON_THROW_ON_ERROR),
                'all_ammunition' => $involvementDTO->getAllAmmunition(),
                'tnt' => $involvementDTO->getTnt(),
                'detonator' => $involvementDTO->getDetonator()
            ]);
    }

    public function getAll(string $order, string $direction): Collection|array
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
            ->orderBy($order, $direction)
            ->get();
    }

    public function remove(string $id)
    {
        return $this
            ->query()
            ->where('id', $id)
            ->delete();
    }

    public function edit(InvolvementDTO $involvementDTO, string $id): bool|int
    {
        return $this
            ->query()
            ->where('id', $id)
            ->update([
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

    public function getById(string $id): Model|null
    {
        return $this
            ->query()
            ->where('id', $id)
            ->first();
    }

    public function getAllByDate(string $dateFrom, string $dateTo): Collection
    {
        return $this
            ->query()
            ->whereBetween('date_notification', [$dateFrom, $dateTo])
            ->get();
    }

    public function getModel(): Involvement
    {
        return new Involvement();
    }
}
