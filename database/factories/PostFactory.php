<?php

namespace Eclipse\World\Factories;

use Eclipse\World\Models\Country;
use Eclipse\World\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            'code' => $this->faker->word(),
            'name' => $this->faker->name(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'country_id' => Country::factory(),
        ];
    }
}
