<?php

namespace App\Http\Transformers\Report;

use App\Services\Report\DTO\ReportDTO;

class ReportTransformer
{
    /**
     * @throws \Exception
     */
    public function transform(string $dateFrom, string $dateTo, string $reportsType): ReportDTO
    {
        $from = (new \DateTime($dateFrom))->format('Y-m-d H:i:s');
        $to = (new \DateTime($dateTo))->setTime(23, 59, 59)->format('Y-m-d H:i:s');

        return new ReportDTO(
            $from,
            $to,
            $reportsType
        );
    }
}
