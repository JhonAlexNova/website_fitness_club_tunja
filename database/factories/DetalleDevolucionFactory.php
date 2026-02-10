<?php

namespace Database\Factories;

use App\Models\DetalleDevolucion;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetalleDevolucionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetalleDevolucion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->randomDigitNotNull,
        'devolucion_id' => $this->faker->randomDigitNotNull,
        'producto_id' => $this->faker->randomDigitNotNull,
        'cantidad_unidades_devolucion' => $this->faker->randomDigitNotNull,
        'valor_unit_de_cambio' => $this->faker->randomDigitNotNull,
        'total_devuelto' => $this->faker->randomDigitNotNull,
        'total_ganancia' => $this->faker->randomDigitNotNull,
        'createt_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
