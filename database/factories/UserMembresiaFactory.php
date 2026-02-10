<?php

namespace Database\Factories;

use App\Models\UserMembresia;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserMembresiaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserMembresia::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomDigitNotNull,
        'membresia_id' => $this->faker->randomDigitNotNull,
        'fecha_inicio' => $this->faker->word,
        'fecha_vencimiento' => $this->faker->word,
        'estado' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
