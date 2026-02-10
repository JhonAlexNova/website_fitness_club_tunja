<?php

namespace Database\Factories;

use App\Models\HistorialPrecioProducto;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistorialPrecioProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = HistorialPrecioProducto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'producto_id' => $this->faker->randomDigitNotNull,
        'precio' => $this->faker->word,
        'fecha_actualizacion' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
