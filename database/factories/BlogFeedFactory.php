<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BlogFeed>
 */
class BlogFeedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'response' =>  json_encode([
                "status" => "ok",
                "count" => 1,
                "articles" =>
                [
                    [
                        "id" => 12,
                        "title" => $this->faker->sentence(),
                        "description" => $this->faker->paragraph(),
                        "publishedAt" => $this->faker->dateTime()
                    ]
                ]

            ]),
            'status' => 'processed',
        ];
    }
}
