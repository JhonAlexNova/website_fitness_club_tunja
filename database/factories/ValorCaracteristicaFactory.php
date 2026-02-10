<?php

namespace Database\Factories;

use App\Models\ValorCaracteristica;
use Illuminate\Database\Eloquent\Factories\Factory;

class ValorCaracteristicaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ValorCaracteristica::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'caracteristica_id' => $this->faker->randomDigitNotNull,
        'valor' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
