<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'photo'=>$this->faker->imageUrl(),
            'department'=>$this->faker->jobTitle(),
            'info'=>$this->faker->text(100),
        ];
    }
}
