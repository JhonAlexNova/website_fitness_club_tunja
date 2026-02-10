<?php

namespace Database\Factories;

use App\Models\ManillaEntrada;
use Illuminate\Database\Eloquent\Factories\Factory;

class ManillaEntradaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ManillaEntrada::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'precio_full' => $this->faker->word,
        'precio_reducido' => $this->faker->word,
        'hora_corte' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
