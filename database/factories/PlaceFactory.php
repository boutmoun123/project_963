<?php

namespace Database\Factories;

use App\Models\Place;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    protected $model = Place::class;

    public function definition()
    {
        return [
            'name' => $this->faker->city, // أو موقع سياحي معروف
            'description' => $this->faker->paragraph,
            'location' => $this->faker->address, // يمكنك تخصيصه لاحقًا حسب قاعدة البيانات
        ];
    }
}
