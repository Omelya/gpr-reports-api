<?php

namespace Tests\Feature;

use App\Models\Involvement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class InvolvementTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

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

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_involvement(): void
    {
        $data = Involvement::factory()->count(3)->create();

        $response = $this->getJson('api/all-involvement?filter[order]=id');

        $response
            ->assertOk()
            ->assertJson([
                'data' => [
                    'type' => 'report',
                    'attributes' => [
                        [
                            'id' => $data[0]->id,
                            'act_code' => $data[0]->act_code,
                            'report_code' => $data[0]->report_code,
                            'date_notification' => $data[0]->date_notification,
                            'task_type' => $data[0]->task_type,
                            'place_execution' => $data[0]->place_execution,
                            'examined' => $data[0]->examined
                        ],
                        [
                            'id' => $data[1]->id,
                            'act_code' => $data[1]->act_code,
                            'report_code' => $data[1]->report_code,
                            'date_notification' => $data[1]->date_notification,
                            'task_type' => $data[1]->task_type,
                            'place_execution' => $data[1]->place_execution,
                            'examined' => $data[1]->examined
                        ],
                        [
                            'id' => $data[2]->id,
                            'act_code' => $data[2]->act_code,
                            'report_code' => $data[2]->report_code,
                            'date_notification' => $data[2]->date_notification,
                            'task_type' => $data[2]->task_type,
                            'place_execution' => $data[2]->place_execution,
                            'examined' => $data[2]->examined
                        ]
                    ]
                ]
            ]);

        $this->assertDatabaseCount('involvements', 3);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_involvement(): void
    {
        $data = Involvement::factory()->create();

        $response = $this->getJson('api/involvement/' . $data->id);

        $response
            ->assertOk()
            ->assertJson([
                'data' => [
                    'type' => 'involvement',
                    'attributes' => [
                        'act_code' => $data->act_code,
                        'report_code' => $data->report_code,
                        'date_notification' => $data->date_notification,
                        'date_received' => $data->date_received,
                        'start_date' => $data->start_date,
                        'end_date' => $data->end_date,
                        'task_type' => $data->task_type,
                        'work_status' => $data->work_status,
                        'place_execution' => $data->place_execution,
                        'examined' => $data->examined,
                        'all_ammunition' => $data->all_ammunition,
                        'tnt' => $data->tnt,
                        'detonator' => $data->detonator
                    ]
                ]
            ]);

        $this->assertDatabaseCount('involvements', 1);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_involvement(): void
    {
        $data = Involvement::factory()->create();

        $response = $this->deleteJson('api/involvement/' . $data->id);

        $response
            ->assertNoContent();

        $this->assertDatabaseCount('involvements', 0);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_patch_involvement(): void
    {
        $data = Involvement::factory()->create();

        $response = $this->patchJson('api/involvement/' . $data->id,
            ['data' => [
                'type' => 'report',
                'attributes' => [
                    'act_code' => $data->act_code,
                    'report_code' => $data->report_code,
                    'date_notification' => '2022-12-12',
                    'date_received' => '2022-12-12 01:21',
                    'start_date' => '2022-12-12 01:21',
                    'end_date' => '2022-12-12 01:21',
                    'task_type' => '2022-12-12 01:21',
                    'work_status' => $data->work_status,
                    'place_execution' => $data->place_execution,
                    'coordinates' => json_decode($data->coordinates),
                    'examined' => 0.93,
                    'persons' => json_decode($data->persons),
                    'ammunition' => json_decode($data->ammunition),
                    'all_ammunition' => $data->all_ammunition,
                    'tnt' => 21,
                    'detonator' => 22
                    ]
                ]
            ]
        );

        $response
            ->assertOk()
            ->assertJson([
                'data' => [
                    'update' => true
                ]
            ]);

        $this->assertDatabaseCount('involvements', 1);
    }
}
