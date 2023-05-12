<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'task_name' => $this->faker->word(),
            'deadline' => $this->faker->dateTimeBetween('now', '+1 year'),
            'status' => '0',
            'project_id' => mt_rand(1,8),
            'user_id' => 1,
        ];
    }
}
