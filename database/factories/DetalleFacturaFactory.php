<?php

namespace Database\Factories;

use App\Models\DetalleFactura;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleFacturaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetalleFactura::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'factura_id' => $this->faker->randomDigitNotNull,
        'precio_id' => $this->faker->randomDigitNotNull,
        'producto_id' => $this->faker->randomDigitNotNull,
        'cantidad' => $this->faker->word,
        'total' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
