<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('categories', function (Blueprint $table) {
            $table->id('idcategories');
            $table->string('cat_name', 45);
            $table->string('cat_photo');
            $table->text('description');
            $table->tinyInteger('cat_type');
            $table->foreignId('languages_idlanguages')->constrained('languages', 'idlanguages');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('categories');
    }
};
             // $table->foreignId('media_idmedia')->constrained('media', 'idmedia');
            // $table->foreignId('links_idlinks')->constrained('links', 'idlinks');