<?php

namespace App\Services\Report\DTO;

class ReportDTO
{
    public function __construct(
        private string $dateFrom,
        private string $dateTo,
        private string $reportsType,
    ){}

    public function getDateFrom(): string
    {
        return $this->dateFrom;
    }

    public function getDateTo(): string
    {
        return $this->dateTo;
    }

    public function getReportsType(): string
    {
        return $this->reportsType;
    }
}
