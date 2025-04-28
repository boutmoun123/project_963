<?php

namespace Database\Factories;

use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

class MediaFactory extends Factory
{
    protected $model = Media::class;

    public function definition()
    {
        return [
            'title' => $this->faker->word, // مثال لعنوان الوسيلة
            'description' => $this->faker->sentence, // مثال لوصف الوسيلة
            'type' => $this->faker->randomElement(['image', 'video', 'text','virtual_tour']), // نوع الوسيلة
        ];
    }
}
