<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\category;
use App\Models\User;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->text(200);
        $slug =  Str::slug($title);
        $description = $this->faker->realText();
        $excerpt = Str::limit($description,100);
        $category_id = category::all()->random()->id;
        $user_id = User::all()->random()->id;
        return [
            'title' => $title,
            'slug'  => $slug,
            'description' => $description,
            'excerpt' => $excerpt,
            'category_id' => $category_id,
            'user_id' => $user_id,
            'is_publish' => 1
        ];
    }
}
