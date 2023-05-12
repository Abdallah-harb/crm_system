<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{

    protected $model = Project::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_name' => $this->faker->unique()->word(),
            'description' => $this->faker->sentence(),
            'deadline' => $this->faker->dateTimeBetween('now', '+1 year'),
            'user_id' => 1,
            'client_id' => mt_rand(1,8),
            'status' => 'open',
        ];
    }
}
