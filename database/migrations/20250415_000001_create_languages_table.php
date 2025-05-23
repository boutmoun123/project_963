<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('languages', function (Blueprint $table) {
            $table->id('idlanguages');
            $table->string('name');
            $table->string('code');
            $table->foreignId('admin_idadmin')->constrained('admins', 'idadmin');
            $table->timestamps();
        });
    } 
 
    public function down(): void {
        Schema::dropIfExists('languages');
    }
};