<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle,
            'description' => $this->faker->paragraphs(3, true),
            'salary' => $this->faker->numberBetween(5_000, 150_000),
            'location' => $this->faker->city,
            'category' => $this->faker->randomElement(Job::$category),
            'experience' => $this->faker->randomElement(Job::$experience)
        ];
    }
}
