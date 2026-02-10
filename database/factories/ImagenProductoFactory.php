<?php

namespace Database\Factories;

use App\Models\ImagenProducto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImagenProductoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ImagenProducto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'producto_id' => $this->faker->randomDigitNotNull,
        'url' => $this->faker->word,
        'es_portada' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
