<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tasks>
 */
class TaskFactory extends Factory
{

     protected $model = \App\Models\Task::class;
    /**
     * Define the model's default state
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'priority' => $this->faker->randomElement(['baixa', 'media', 'alta']),
            'category' => $this->faker->randomElement(['pessoal', 'trabalho', 'estudos', 'casa', 'saude']),
        ];
    }
}
