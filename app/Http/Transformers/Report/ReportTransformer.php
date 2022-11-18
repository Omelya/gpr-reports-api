<?php

namespace App\Http\Transformers\Report;

use App\Services\Report\DTO\ReportDTO;

class ReportTransformer
{
    /**
     * @throws \Exception
     */
    public function transform(string $dateFrom, string $dateTo): ReportDTO
    {
        $from = (new \DateTime($dateFrom))->format('Y-m-d H:i:s');
        $to = (new \DateTime($dateTo))->format('Y-m-d H:i:s');

        return new ReportDTO(
            $from,
            $to
        );
    }
}
