<?php

namespace Database\Factories;

use App\Models\TrasladoProducto;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrasladoProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TrasladoProducto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'negocio_origen_id' => $this->faker->word,
        'negocio_destino_id' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
