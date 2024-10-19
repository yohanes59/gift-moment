<?php

namespace Database\Factories;

use App\Models\Category;
use Doctrine\Inflector\Rules\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1683812608/capstone-gits/souvenir_twffhz.jpg',
            'slug' => $this->faker->slug
        ];
    }
}