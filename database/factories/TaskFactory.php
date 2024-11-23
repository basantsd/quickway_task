<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'title'=>fake()->text(50),
            'description'=>fake()->realTextBetween(200,700),
            'due_date'=>fake()->date(),
            'status'=>fake()->randomElement(['pending','completed']),
        ];
    }
}
