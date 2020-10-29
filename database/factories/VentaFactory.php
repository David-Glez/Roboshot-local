<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VentaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\Venta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total' => $this->faker->randomFloat(2, 50.0, 400.0),
            'ganancia' => $this->faker->randomFloat(2, 5.0, 40.0),
            'online' => $this->faker->boolean(10),
            'fecha' => $this->faker->dateTimeBetween('-1 week', 'now', 'America/Mexico_City'),
        ];
    }
}
