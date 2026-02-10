<?php

namespace Database\Factories;

use App\Models\StockManilla;
use Illuminate\Database\Eloquent\Factories\Factory;

class StockManillaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StockManilla::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'manilla_id' => $this->faker->word,
        'cantidad_actual' => $this->faker->randomDigitNotNull,
        'cantidad_anterior' => $this->faker->randomDigitNotNull,
        'cantidad' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
