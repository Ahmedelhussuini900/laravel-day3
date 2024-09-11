<?php
namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'posted_by' => User::inRandomOrder()->first()->id, // Assuming a User model exists
            'image' => $this->faker->imageUrl(640, 480, 'posts', true), // Dummy image URL
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
