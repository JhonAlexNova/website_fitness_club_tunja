<?php

namespace Database\Factories;

use App\Models\HistorialProducto;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistorialProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HistorialProducto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'producto_id' => $this->faker->randomDigitNotNull,
        'cantidad' => $this->faker->word,
        'cantidad_anterior' => $this->faker->word,
        'cantidad_actual' => $this->faker->word,
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
