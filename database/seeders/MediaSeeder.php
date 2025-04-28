<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        Media::create([
            'med_name' => 'Sample Media',
            'med_type' => 1,
            'med_content' => 'sample.jpg',
            'languages_idlanguages' => 1,
            'admin_idadmin' => 1
        ]);
    }
}
