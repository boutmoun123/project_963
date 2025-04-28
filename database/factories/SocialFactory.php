<?php

namespace Database\Factories;

use App\Models\Social;
use Illuminate\Database\Eloquent\Factories\Factory;
namespace Database\Factories;

use App\Models\Social;
use Illuminate\Database\Eloquent\Factories\Factory;

class SocialFactory extends Factory
{
    protected $model = Social::class;

    public function definition()
    {
        return [
            'platform' => $this->faker->randomElement(['Facebook', 'Instagram', 'Twitter', 'YouTube']),
            'username' => $this->faker->userName(),
            'url' => $this->faker->url(),
        ];
    }
}
