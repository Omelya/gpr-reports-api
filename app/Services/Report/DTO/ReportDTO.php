<?php

namespace App\Services\Report\DTO;

class ReportDTO
{
    private string $dateFrom;
    private string $dateTo;
    private string $reportsType;

    public function __construct(string $dateFrom, string $dateTo, string $reportsType)
    {
        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
        $this->reportsType = $reportsType;
    }

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
