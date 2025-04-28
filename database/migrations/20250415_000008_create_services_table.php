<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('services', function (Blueprint $table) {
            $table->id('idservices');
            $table->string('ser_name', 45);
            $table->foreignId('admin_idadmin')->constrained('admins', 'idadmin');
            $table->foreignId('languages_idlanguages')->constrained('languages', 'idlanguages');
            $table->foreignId('media_idmedia')->constrained('media', 'idmedia');
            $table->foreignId('links_idlinks')->constrained('links', 'idlinks');
            $table->foreignId('places_idplaces')->constrained('places', 'idplaces');
            $table->foreignId('cities_idcities')->constrained('cities', 'idcities');
            $table->timestamps();
        }); 
    }

    public function down(): void {
        Schema::dropIfExists('services');
    }
};
