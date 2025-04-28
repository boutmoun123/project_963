<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('media', function (Blueprint $table) {
            $table->id('idmedia');
            $table->string('med_name', 45);
            $table->tinyInteger('med_type');
            $table->string('med_content', 45);
            $table->foreignId('admin_idadmin')->constrained('admins', 'idadmin');
            $table->foreignId('languages_idlanguages')->constrained('languages', 'idlanguages');
            $table->timestamps();
        });
    } 
 
    public function down(): void {
        Schema::dropIfExists('media');
    }
};
