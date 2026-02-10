<?php

namespace Database\Factories;

use App\Models\UserRutina;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserRutinaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserRutina::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->word,
        'id_rutina' => $this->faker->randomDigitNotNull,
        'fecha_inicio' => $this->faker->word,
        'fecha_fin' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
