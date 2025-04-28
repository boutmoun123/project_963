<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create([
            'cat_name' => 'Sample Category',
            'cat_type' => 1,
            'languages_idlanguages' => 1,
            'admin_idadmin' => 1,
            'media_idmedia' => 1,
            'links_idlinks' => 1
        ]);
    }
}
