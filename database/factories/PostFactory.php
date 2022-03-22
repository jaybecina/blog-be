<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * 
     * run:
     * Post::factory()->count(50)->create()
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text,
            'description' => $this->faker->paragraph,
            'updated_at' => NULL
        ];
    }
}
