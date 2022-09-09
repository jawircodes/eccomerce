<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BannerFactory extends Factory
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
            'description'=> $this->faker->unique()->text,
            'photo' => $this->faker->imageUrl('60', '60'),
            'condition'=> $this->faker->randomElement(['banner','promo']),
            'status' => $this->faker->randomElement(['active','inactive'])
            
        ];
    }
}
