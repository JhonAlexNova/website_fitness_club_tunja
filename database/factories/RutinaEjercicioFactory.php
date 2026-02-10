<?php

namespace Database\Factories;

use App\Models\RutinaEjercicio;
use Illuminate\Database\Eloquent\Factories\Factory;

class RutinaEjercicioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RutinaEjercicio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id_rutina' => $this->faker->randomDigitNotNull,
        'id_ejercicio' => $this->faker->randomDigitNotNull,
        'repeticiones' => $this->faker->randomDigitNotNull,
        'series' => $this->faker->randomDigitNotNull,
        'descanso_segundos' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
