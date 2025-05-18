<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        try {
            $admin = Admin::create([
                'name' => 'boutmoun',
                'password' => Hash::make('boutmoun562004')
            ]);
            
            Log::info('Admin created successfully with ID: ' . $admin->id);
        } catch (\Exception $e) {
            Log::error('Failed to create Admin: ' . $e->getMessage());
            throw $e;
        }
    }
}