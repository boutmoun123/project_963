<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('socials', function (Blueprint $table) {
            $table->id('idsocials');
            $table->string('social_name', 45);
            $table->string('social_address', 90);
            $table->foreignId('languages_idlanguages')->constrained('languages', 'idlanguages');
            $table->timestamps();
        });   
    }

    public function down(): void {
        Schema::dropIfExists('socials');
    }
};
