<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('services', function (Blueprint $table) {
            $table->id('idservices');
            $table->string('ser_name', 45);
            $table->tinyInteger('ser_type');
            $table->string('ser_photo')->nullable();
            $table->text('description');
            $table->foreignId('admin_idadmin')->nullable()->constrained('admins', 'idadmin');
            $table->foreignId('languages_idlanguages')->constrained('languages', 'idlanguages');
            $table->foreignId('categories_idcategories')->constrained('categories', 'idcategories');
            $table->foreignId('cities_idcities')->constrained('cities', 'idcities');
           
            $table->timestamps();
        }); 
    }

    public function down(): void {
        Schema::dropIfExists('services');
    }
};
            // $table->foreignId('media_idmedia')->constrained('media', 'idmedia');
            // $table->foreignId('links_idlinks')->constrained('links', 'idlinks');
            // $table->foreignId('places_idplaces')->constrained('places', 'idplaces');