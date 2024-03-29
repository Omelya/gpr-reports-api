<?php

namespace App\Services\Report;

use Illuminate\Database\Eloquent\Collection;
use JsonException;

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

    public function getReports(string $type): array
    {
        switch ($type) {
            case 'ОР':
                $this->createReportByWorkType('ОР', 'Оперативне реагування');
                break;
            case 'ГР':
                $this->createReportByWorkType('ГР', 'Гуманітарне розмінування');
                break;
            case 'ТО':
                $this->createReportByWorkType('ТО', 'Технічне обстеження');
                break;
            default:
                $this->createReportByWorkType('ОР', 'Оперативне реагування');
                $this->createReportByWorkType('ГР', 'Гуманітарне розмінування');
                $this->createReportByWorkType('ТО', 'Технічне обстеження');
        }

//        $this->createReportForRiskEducation('НР', 'Навчання ризикам'); TODO

        return $this->reports;
    }

    /**
     * @throws JsonException
     */
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

    /**
     * @throws JsonException
     */
    private function countAmmunitionByTypes(string $item): array
    {
        $ammunition = [];

        for ($i = 0; $i < $this->involvements->count(); $i++) {
            $workType = substr($this->involvements[$i]->report_code, 0, 4);

            if ($workType === $item) {
                $ammunitionDecode = $this->ammunitionDecode($this->involvements[$i]->ammunition);
                foreach ($ammunitionDecode as $type => $number) {
                    $type = str_replace('_', ' ', $type);

                    foreach ($this->ammunitionTypes as $ammunitionType) {
                        $ammunition[$ammunitionType] = $ammunition[$ammunitionType] ?? 0;

                        $this->checkAmmunitionType($ammunitionType, $type)
                            && $ammunition[$ammunitionType]+= $number;
                    }
                }
            }
        }

        $ammunition['Всього ВНП'] = 0;

        foreach ($ammunition as $type => $number) {
            if ($type === 'Набої') {
                continue;
            }

            $ammunition['Всього ВНП'] += $number;
        }

        return $ammunition;
    }

    /**
     * @throws JsonException
     */
    private function ammunitionDecode(string $ammunition)
    {
        return json_decode($ammunition, false, 512, JSON_THROW_ON_ERROR);
    }

    private function checkAmmunitionType(string $ammunitionType, string $type): bool
    {
        return (bool)preg_match("/$ammunitionType/ui", $type);
    }
}
