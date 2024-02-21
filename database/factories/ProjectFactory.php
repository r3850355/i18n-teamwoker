<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'sn' => substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 9),
            'name' => fake()->name(),
            'description' => fake()->text()
        ];
    }
}
