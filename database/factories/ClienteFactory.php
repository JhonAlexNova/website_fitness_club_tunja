<?php

namespace Database\Factories;

use App\Models\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Cliente::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'fecha_inscripcion' => $this->faker->word,
        'talla' => $this->faker->word,
        'correo' => $this->faker->word,
        'perimetro_abdominal' => $this->faker->word,
        'porcentaje_grasa' => $this->faker->word,
        'porcentaje_musculo' => $this->faker->word,
        'observaciones' => $this->faker->text,
        'tipo' => $this->faker->word,
        'foto_perfil' => $this->faker->word,
        'username' => $this->faker->word,
        'primer_nombre' => $this->faker->word,
        'segundo_nombre' => $this->faker->word,
        'primer_apellido' => $this->faker->word,
        'segundo_apellido' => $this->faker->word,
        'celular' => $this->faker->word,
        'estado' => $this->faker->word,
        'email' => $this->faker->word,
        'documento' => $this->faker->word,
        'email_verified_at' => $this->faker->date('Y-m-d H:i:s'),
        'deleted_at' => $this->faker->date('Y-m-d H:i:s'),
        'password' => $this->faker->word,
        'remember_token' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
