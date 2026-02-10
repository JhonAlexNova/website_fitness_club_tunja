<?php

namespace Database\Factories;

use App\Models\HorarioClaseUnica;
use Illuminate\Database\Eloquent\Factories\Factory;

class HorarioClaseUnicaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HorarioClaseUnica::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'clase_id' => $this->faker->randomDigitNotNull,
        'instructor_id' => $this->faker->randomDigitNotNull,
        'fecha_hora' => $this->faker->date('Y-m-d H:i:s'),
        'cupo_maximo' => $this->faker->randomDigitNotNull,
        'cupos_disponibles' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
