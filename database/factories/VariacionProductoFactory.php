<?php

namespace Database\Factories;

use App\Models\VariacionProducto;
use Illuminate\Database\Eloquent\Factories\Factory;

class VariacionProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = VariacionProducto::class;

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
        'precio' => $this->faker->word,
        'stock' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
