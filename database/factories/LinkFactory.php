<?php

namespace Database\Factories;

use App\Models\Link;
use Illuminate\Database\Eloquent\Factories\Factory;

class LinkFactory extends Factory
{
    protected $model = Link::class;

    public function definition()
    {
        return [
            'url' => $this->faker->url, // مثال لعنوان URL
            'description' => $this->faker->sentence, // مثال لوصف الرابط

        ];
    }
}
