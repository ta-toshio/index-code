<?php

namespace Database\Factories;

use App\Models\JaPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class JaPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JaPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'body' => $this->faker->realText(),
            'category' => $this->faker->prefecture,
            'type' => $this->faker->city,
        ];
    }
}
