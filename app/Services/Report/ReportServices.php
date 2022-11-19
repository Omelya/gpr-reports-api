<?php

namespace App\Services\Report;

use Illuminate\Database\Eloquent\Collection;

class ReportServices
{
    private Collection $involvements;
    private array $reports;

    public function setInvolvements(Collection $involvements): static
    {
        $this->involvements = $involvements;

        return $this;
    }

    public function getReports(): array
    {
        return $this->reports;
    }

    public function createReportByPromptResponse()
    {
        $completedApplications = $this->getNumberCompletedApplications();
        $numberEngagements = $this->getNumberEngagements();
        $territorySurveyed = $this->getTerritorySurveyed();

        return $this->reports['Оперативне реагування'] = [
            'Виконано заявок' => $completedApplications,
            'Проведено залучень' => $numberEngagements,
            'Обстежено території' => $territorySurveyed
        ];
    }

    private function getNumberCompletedApplications(): int
    {
        $numberCompletedApplications = 0;

        for ($i = 0; $i < $this->involvements->count(); $i++) {
            $workType = substr($this->involvements[$i]->report_code, 0, 4);

            if ($workType === 'ОР' && $this->involvements[$i]->work_status === 'done') {
                $numberCompletedApplications++;
            }
        }

        return $numberCompletedApplications;
    }

    private function getNumberEngagements(): int
    {
        $numberEngagements = 0;

        for ($i = 0; $i < $this->involvements->count(); $i++) {
            $workType = substr($this->involvements[$i]->report_code, 0, 4);

            if ($workType === 'ОР') {
                $numberEngagements++;
            }
        }

        return $numberEngagements;
    }

    private function getTerritorySurveyed()
    {
        $examined = 0;

        for ($i = 0; $i < $this->involvements->count(); $i++) {
            $workType = substr($this->involvements[$i]->report_code, 0, 4);

            if ($workType === 'ОР') {
                $examined = $examined + $this->involvements[$i]->examined;
            }
        }

        return $examined;
    }
}
