<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('idcategories');
            $table->string('cat_name', 45);
            $table->tinyInteger('cat_type');
            $table->foreignId('admin_idadmin')->constrained('admins', 'idadmin');
            $table->foreignId('languages_idlanguages')->constrained('languages', 'idlanguages');
            $table->foreignId('media_idmedia')->constrained('media', 'idmedia');
            $table->foreignId('links_idlinks')->constrained('links', 'idlinks');
            $table->timestamps();
        });
    }
 
    public function down(): void {
        Schema::dropIfExists('categories');
    }
};
 