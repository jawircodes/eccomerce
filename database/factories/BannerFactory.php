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
            'title' => $this->faker->name(),
            'slug' => $this->faker->unique()->name(),
            'description'=>$this->faker->text,
            'photo'=>$this->faker->imageUrl('68','68'),
            'condition'=>$this->faker->randomElement(['banner','promo']),
            'status'=>$this->faker->randomElement(['active','inactive']),
        ];
    }
}
