<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('users', function (Blueprint $table) {
            $table->id('iduser');
            $table->foreignId('admin_idadmin')->constrained('admins', 'idadmin');
            $table->foreignId('languages_idlanguages')->constrained('languages', 'idlanguages');
            $table->foreignId('socials_idsocials')->constrained('socials', 'idsocials');
            $table->foreignId('way_idway')->constrained('way', 'idway');
            $table->foreignId('places_idplaces')->constrained('places', 'idplaces');
            $table->foreignId('media_idmedia')->constrained('media', 'idmedia');
            $table->foreignId('services_idservices')->constrained('services', 'idservices');
            $table->foreignId('categories_idcategories')->constrained('categories', 'idcategories');
            $table->foreignId('links_idlinks')->constrained('links', 'idlinks');
            $table->foreignId('cities_idcities')->constrained('cities', 'idcities');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('users');
    }
};
