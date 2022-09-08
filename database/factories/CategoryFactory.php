<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        return [
            'title' => $this->faker->word,
            'slug' => $this->faker->unique()->slug,
            'summary' => $this->faker->sentence(3, true),
            'photo' => $this->faker->imageUrl(100, 100),
            'is_parent' => true,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
