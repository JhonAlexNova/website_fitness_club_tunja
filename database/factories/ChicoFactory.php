<?php

namespace Database\Factories;

use App\Models\Chico;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChicoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Chico::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'empleado_id' => $this->faker->randomDigitNotNull,
        'cantidad' => $this->faker->word,
        'valor' => $this->faker->word,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
