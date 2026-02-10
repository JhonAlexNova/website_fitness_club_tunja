<?php

namespace Database\Factories;

use App\Models\PagoMembresia;
use Illuminate\Database\Eloquent\Factories\Factory;

class PagoMembresiaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PagoMembresia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_membresia_id' => $this->faker->randomDigitNotNull,
        'monto' => $this->faker->word,
        'fecha_pago' => $this->faker->date('Y-m-d H:i:s'),
        'metodo_pago' => $this->faker->word,
        'estado' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
