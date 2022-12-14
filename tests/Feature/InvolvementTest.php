<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InvolvementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_involvement(): void
    {
        $data = [
            'data' => [
                'type' => 'report',
                'attributes' => [
                    'act_code' => 'ОР-08-2022/1',
                    'report_code' => 'ОР-08-2022/1',
                    'date_notification' => '2022-01-05',
                    'date_received' => '2022-01-04 11:01',
                    'start_date' => '2022-01-05 08:10',
                    'end_date' => '2022-01-05 11:10',
                    'task_type' => 'технічне обстеження території',
                    'work_status' => 'done',
                    'place_execution' => 'Закарпатська область, м. Ужгород, вул. Верещагіна, 18',
                    'coordinates' => [
                        'N' => 48.09094,
                        'E' => 23.45231
                    ],
                    'examined' => 0.01,
                    'persons' => [
                        'Владислав Омеляненко',
                        'Микита Гуцол',
                        'Максим Ротний',
                        'Юра Мовнар',
                        'Дмитро Митро'
                    ],
                    'ammunition' => [
                        'артилерійський снаряд 152 мм' => 1
                    ],
                    'all_ammunition' => 1,
                    'tnt' => 0.8,
                    'detonator' => 1
                ]
            ]
        ];

        $response = $this->postJson('api/involvement',$data);

        $response
            ->assertStatus(201)
            ->assertJson([
                'data' => [
                    'save' => true
                ]
            ]);

        $this->assertDatabaseCount('involvements', 1);
    }
}
