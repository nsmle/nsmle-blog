<?php

namespace Database\Factories;

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
            'title' => $this->faker->sentence(mt_rand(2, 8)),
            'slug' => $this->faker->unique()->slug(2),
            'summary' => $this->faker->paragraph(),
            'content' => collect($this->faker->paragraphs(mt_rand(10, 20)))
                        ->implode('\n'),
            'user_id' => mt_rand(1, 13),
            'category_id' => mt_rand(1, 14),
            'published' => mt_rand(0,1),
            'published_at' => $this->faker->dateTimeInInterval('-1 week', '+3 days'),
            'created_at' => $this->faker->dateTimeInInterval('-1 week', '+3 days'),
            'updated_at' => $this->faker->dateTimeInInterval('-1 week', '+3 days')
        ];
    }
}
