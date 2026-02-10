<?php

namespace Database\Factories;

use App\Models\Transaccion;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransaccionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaccion::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amountInCents' => $this->faker->word,
        'createdAt' => $this->faker->word,
        'currency' => $this->faker->word,
        'customerData_fullName' => $this->faker->word,
        'customerData_phoneNumber' => $this->faker->word,
        'customerEmail' => $this->faker->word,
        'id_transaction' => $this->faker->word,
        'paymentMethod_extra_brand' => $this->faker->word,
        'paymentMethod_extra_externalIdentifier' => $this->faker->word,
        'paymentMethod_extra_lastFour' => $this->faker->word,
        'paymentMethod_extra_name' => $this->faker->word,
        'paymentMethod_installments' => $this->faker->word,
        'paymentMethod_type' => $this->faker->word,
        'reference' => $this->faker->word,
        'status' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
