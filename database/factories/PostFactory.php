<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'user_id' => User::factory(App\User::class)->make()->id,
            'description' => $this->faker->paragraph(12),
            'status' => 'published'
        ];
    }
}
