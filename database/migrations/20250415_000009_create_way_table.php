<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('way', function (Blueprint $table) {
            $table->id('idway');
            $table->string('name', 100);
            $table->tinyInteger('way_type');
            $table->decimal('horizontal', 10, 7);  // 10 digits, 7 after decimal
            $table->decimal('vertical', 10, 7);    // 10 digits, 7 after decimal
            $table->string('address', 255);
            $table->foreignId('admin_idadmin')->constrained('admins', 'idadmin');
            $table->foreignId('languages_idlanguages')->constrained('languages', 'idlanguages');
            $table->foreignId('categories_idcategories')->constrained('categories', 'idcategories');
            $table->foreignId('cities_idcities')->constrained('cities', 'idcities');
            $table->foreignId('places_idplaces')->constrained('places', 'idplaces');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('way');
    }
};
