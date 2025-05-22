<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageSeeder extends Seeder
{
    public function run(): void
    {
        Language::create([
            'name' => 'English',
            'code' => 'en',
            'type' => 1,
            'admin_idadmin'=>1
        ]);

        Language::create([
            'name' => 'Arabic',
            'code' => 'ar',
            'type' => 1,
            'admin_idadmin'=>1
        ]);
    }
}
