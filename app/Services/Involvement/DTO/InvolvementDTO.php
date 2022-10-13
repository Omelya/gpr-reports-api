<?php

namespace App\Services\Involvement\DTO;

class InvolvementDTO
{
    private string $actCode;

    private string $reportCode;

    private string $dateNotification;

    private string $dataReceived;

    private string $startDate;

    private string $endDate;

    private string $taskType;

    private  string $workStatus;

    private string $placeExecution;

    private array $coordinates;

    private float|int $examined;

    private array $persons;

    private array $ammunition;

    private int $allAmmunition;

    private int $tnt;

    private int $detonator;

    public function __construct(
        string $actCode,
        string $reportCode,
        string $dateNotification,
        string $dataReceived,
        string $startDate,
        string $endDate,
        string $taskType,
        string $workStatus,
        string $placeExecution,
        array $coordinates,
        float|int $examined,
        array $persons,
        array $ammunition,
        string $allAmmunition,
        int $tnt,
        int $detonator
    ) {
        $this->actCode = $actCode;
        $this->reportCode = $reportCode;
        $this->dateNotification = $dateNotification;
        $this->dataReceived = $dataReceived;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->taskType = $taskType;
        $this->workStatus = $workStatus;
        $this->placeExecution = $placeExecution;
        $this->coordinates = $coordinates;
        $this->examined = $examined;
        $this->persons = $persons;
        $this->ammunition = $ammunition;
        $this->allAmmunition = $allAmmunition;
        $this->tnt = $tnt;
        $this->detonator = $detonator;
    }

    /**
     * @return string
     */
    public function getActCode(): string
    {
        return $this->actCode;
    }

    /**
     * @return string
     */
    public function getReportCode(): string
    {
        return $this->reportCode;
    }

    /**
     * @return string
     */
    public function getDateNotification(): string
    {
        return $this->dateNotification;
    }

    /**
     * @return string
     */
    public function getDataReceived(): string
    {
        return $this->dataReceived;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }

    /**
     * @return string
     */
    public function getTaskType(): string
    {
        return $this->taskType;
    }

    /**
     * @return string
     */
    public function getWorkStatus(): string
    {
        return $this->workStatus;
    }

    /**
     * @return string
     */
    public function getPlaceExecution(): string
    {
        return $this->placeExecution;
    }

    /**
     * @return array
     */
    public function getCoordinates(): array
    {
        return $this->coordinates;
    }

    /**
     * @return float|int
     */
    public function getExamined(): float|int
    {
        return $this->examined;
    }

    /**
     * @return array
     */
    public function getPersons(): array
    {
        return $this->persons;
    }

    /**
     * @return array
     */
    public function getAmmunition(): array
    {
        return $this->ammunition;
    }

    /**
     * @return int|string
     */
    public function getAllAmmunition(): int|string
    {
        return $this->allAmmunition;
    }

    /**
     * @return int
     */
    public function getTnt(): int
    {
        return $this->tnt;
    }

    /**
     * @return int
     */
    public function getDetonator(): int
    {
        return $this->detonator;
    }
}
