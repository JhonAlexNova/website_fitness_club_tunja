<?php

namespace Database\Factories;

use App\Models\IngresoPorteria;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngresoPorteriaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IngresoPorteria::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cliente_id' => $this->faker->randomDigitNotNull,
        'manilla_id' => $this->faker->randomDigitNotNull,
        'valor' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
