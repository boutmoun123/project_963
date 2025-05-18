<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    public function up(): void
    {
        // Create boutmoun admin if not exists
        if (!Admin::where('name', 'boutmoun')->exists()) {
            Admin::create([
                'name' => 'boutmoun',
                'password' => Hash::make('boutmoun562004')
            ]);
        }
    }

    public function down(): void
    {
        // Remove boutmoun admin if exists
        Admin::where('name', 'boutmoun')->delete();
    }
}; 