<?php

namespace Database\Factories;

use App\Models\ClaseRecurrente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClaseRecurrenteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClaseRecurrente::class;

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
        'dia_semana' => $this->faker->word,
        'hora' => $this->faker->word,
        'duracion' => $this->faker->randomDigitNotNull,
        'cupo_maximo' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
