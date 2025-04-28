<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('way', function (Blueprint $table) {
            $table->id('idway');
            $table->string('name');
            $table->decimal('horizontal', 10, 7);  // 10 digits, 7 after decimal
            $table->decimal('vertical', 10, 7); // نفس الشيء
            $table->string('address')->nullable();
            $table->foreignId('admin_idadmin')->constrained('admins', 'idadmin');
            $table->foreignId('languages_idlanguages')->constrained('languages', 'idlanguages');
            $table->foreignId('socials_idsocials')->constrained('socials', 'idsocials');
            $table->foreignId('places_idplaces')->constrained('places', 'idplaces');
            $table->foreignId('services_idservices')->constrained('services', 'idservices');
            $table->foreignId('links_idlinks')->constrained('links', 'idlinks');
             $table->foreignId('cities_idcities')->constrained('cities', 'idcities');
            $table->string('way_add', 90);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('way');
    }
};
