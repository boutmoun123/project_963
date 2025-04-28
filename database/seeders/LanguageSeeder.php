<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;
use App\Models\Admin;

class LanguageSeeder extends Seeder
{
    public function run()
    {
        $admin = Admin::first();
        
        Language::create([
            'language_package' => 'en',
            'lang_name' => 'English',
            'lang_type' => 1,
            'admin_idadmin' => $admin->idadmin,
        ]);
    }
}
