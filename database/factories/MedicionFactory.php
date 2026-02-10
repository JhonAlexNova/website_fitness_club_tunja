<?php

namespace Database\Factories;

use App\Models\Medicion;
use Illuminate\Database\Eloquent\Factories\Factory;

class MedicionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Medicion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'fecha_medicion' => $this->faker->date('Y-m-d H:i:s'),
        'peso' => $this->faker->word,
        'talla' => $this->faker->word,
        'grasa' => $this->faker->word,
        'musculo' => $this->faker->word,
        'perimetro_abdominal' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
