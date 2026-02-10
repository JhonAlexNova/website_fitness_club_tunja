<?php

namespace Database\Factories;

use App\Models\CaracteristicaProducto;
use Illuminate\Database\Eloquent\Factories\Factory;

class CaracteristicaProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CaracteristicaProducto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'producto_id' => $this->faker->randomDigitNotNull,
        'valor_caracteristica_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
