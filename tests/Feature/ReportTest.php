<?php

namespace Tests\Feature;

use App\Models\Involvement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Collection;
use Tests\TestCase;

class ReportTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_report_OP(): void
    {
        $data = Involvement::factory()->count(10)->create();
        $completedApplications = $this->getCountedNumberParams('ОР', 'done', $data);
        $territorySurveyed = $this->getCountedNumberParams('ОР', 'all', $data, 'examined');
        $tnt = $this->getCountedNumberParams('ОР', 'all', $data, 'tnt');
        $detonators = $this->getCountedNumberParams('ОР', 'all', $data, 'detonator');
        $dateTo = (new \DateTime('now'))->format('Y-m-d');

        $response = $this->getJson(
            'api/report?filter[reports_type]=ОР&filter[date_from]=1900-01-01&filter[date_to]=' . $dateTo
        );

        $response
            ->assertOk()
            ->assertJson([
                'Оперативне реагування' => [
                    'Виконано заявок' => $completedApplications,
                    'Проведено залучень' => 10,
                    'Обстежено території' => $territorySurveyed,
                    'Виявлені ВНП' => [
                        'Артилерійський снаряд' => 20
                    ],
                    'Використано тротилу' => $tnt,
                    'Використано детонаторів' => $detonators
                ]
            ]);
    }

    private function getCountedNumberParams(
        string $type,
        string $workStatus,
        Collection $involvements,
        string $params = ''
    ): int|float {
        $number = 0;
        $status = true;

        for ($i = 0; $i < $involvements->count(); $i++) {
            $workType = substr($involvements[$i]->report_code, 0, 4);

            if ($workStatus === 'done') {
                $status = $involvements[$i]->work_status === 'done' ?? false;
            }

            if ($workType === $type && $status) {
                $params === ''
                    ? $number++
                    : $number += $involvements[$i]->{$params};
            }
        }

        return $number;
    }
}
