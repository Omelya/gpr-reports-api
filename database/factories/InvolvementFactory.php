<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Involvement>
 */
class InvolvementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'act_code' => 'ОР-08-2022/' . fake()->unique()->numberBetween(1, 1000),
            'report_code' => 'ОР-08-2022/' . fake()->unique()->numberBetween(1, 1000),
            'date_notification' => fake()->date(),
            'date_received' => fake()->date('Y-m-d h:i:s'),
            'start_date' => fake()->date('Y-m-d h:i:s'),
            'end_date' => fake()->date('Y-m-d h:i:s'),
            'task_type' => fake()->randomElement([
                'оперативне реагування на виявлені ВНП',
                'технічне обстеження території',
                'очищення (розмінування) території',
                'роботи на догововірній основі'
            ]),
            'work_status' => fake()->randomElement([
                'done',
                'is_performed',
                'execution_suspended'
            ]),
            'place_execution' => fake()->address,
            'coordinates' => json_encode([
                'N' => fake()->randomFloat(5, 1, 179),
                'E' => fake()->randomFloat(5, 1, 179)
            ]),
            'examined' => fake()->randomFloat(2, 0, 100),
            'persons' => json_encode([
                'Владислав Омеляненко',
                'Микита Гуцол',
                'Максим Ротний',
                'Юра Мовнар',
                'Дмитро Митро'
            ]),
            'ammunition' => json_encode([
                'артилерійський снаряд 152 мм' => 2
            ]),
            'all_ammunition' => 1,
            'tnt' => fake()->randomFloat(1, 0, 100),
            'detonator' => fake()->randomDigitNotNull
        ];
    }
}
