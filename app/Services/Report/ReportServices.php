<?php

namespace App\Services\Report;

use Illuminate\Database\Eloquent\Collection;

class ReportServices
{
    private Collection $involvements;
    private array $reports;
    private array $ammunitionTypes = [
        'Протипіхотна міна',
        'Протитанкова міна',
        'Міна пастка',
        'Реактивний снаряд',
        'Артилерійський снаряд',
        'Мінометна міна',
        'Граната',
        'Авіаційна бомба',
        'Касетний боєприпас',
        'Касетний елемент',
        'Торпеди',
        'Підривник',
        'Набої',
        'Вибухова речовина',
        'Інші ВНП'
    ];

    public function setInvolvements(Collection $involvements): static
    {
        $this->involvements = $involvements;

        return $this;
    }

    public function getReports(): array
    {
        $this->createReportByWorkType('ОР', 'Оперативне реагування');
        $this->createReportByWorkType('ГР', 'Гуманітарне розмінування');
        $this->createReportByWorkType('ТО', 'Технічне розмінування');
//        $this->createReportForRiskEducation('НР', 'Навчання ризикам'); TODO

        return $this->reports;
    }

    public function createReportByWorkType(string $type, string $name): array
    {
        $completedApplications = $this->getCountedNumberParams($type, 'done');
        $numberEngagements = $this->getCountedNumberParams($type, 'all');
        $territorySurveyed = $this->getCountedNumberParams($type, 'all', 'examined');
        $ammunition = $this->countAmmunitionByTypes($type);
        $tnt = $this->getCountedNumberParams($type, 'all', 'tnt');
        $detonators = $this->getCountedNumberParams($type, 'all', 'detonator');

        return $this->reports[$name] = [
            'Виконано заявок' => $completedApplications,
            'Проведено залучень' => $numberEngagements,
            'Обстежено території' => $territorySurveyed,
            'Виявлені ВНП' => $ammunition,
            'Використано тротилу' => $tnt,
            'Використано детонаторів' => $detonators
        ];
    }

    public function createReportForRiskEducation(string $type, string $name): array
    {
        $numberLesson = $this->getCountedNumberParams($type, 'all');
        $numberPeople = $this->getCountedNumberParams($type, 'all', 'peoples');

        return $this->reports[$name] = [
            'Кількість навчань' => $numberLesson,
            'Охоплено осіб' => $numberPeople
        ];
    }

    private function getCountedNumberParams(string $type, string $workStatus, string $params = ''): int|float
    {
        $number = 0;
        $status = true;

        for ($i = 0; $i < $this->involvements->count(); $i++) {
            $workType = substr($this->involvements[$i]->report_code, 0, 4);

            if ($workStatus === 'done') {
                $status = $this->involvements[$i]->work_status === 'done' ?? false;
            }

            if ($workType === $type && $status) {
                $params === ''
                    ? $number++
                    : $number += $this->involvements[$i]->{$params};
            }
        }

        return $number;
    }

    private function countAmmunitionByTypes(string $item): array
    {
        $ammunition = [];

        for ($i = 0; $i < $this->involvements->count(); $i++) {
            $workType = substr($this->involvements[$i]->report_code, 0, 4);

            if ($workType === $item) {
                foreach (json_decode($this->involvements[$i]->ammunition) as $type => $number) {
                    $type = str_replace('_', ' ' , $type);

                    foreach($this->ammunitionTypes as $ammunitionType) {
                        $ammunition[$ammunitionType] = $ammunition[$ammunitionType] ?? 0;

                        if (preg_match("/$ammunitionType/ui", $type)) {
                            $ammunition[$ammunitionType]+= $number;
                        }
                    }
                }
            }
        }

        $ammunition['Всього ВНП'] = 0;

        foreach ($ammunition as $type => $number) {
            if ($type === 'набої') {
                continue;
            }

            $ammunition['Всього ВНП'] += $number;
        }

        return $ammunition;
    }
}
