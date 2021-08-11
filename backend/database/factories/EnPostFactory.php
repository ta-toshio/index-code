<?php

namespace Database\Factories;

use App\Models\EnPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EnPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'body' => $this->faker->paragraph(),
            'category' => $this->faker->country,
            'type' => $this->faker->city,
        ];
    }
}
