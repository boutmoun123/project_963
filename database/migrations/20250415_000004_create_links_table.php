<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('links', function (Blueprint $table) {
            $table->id('idlinks');
            $table->string('link_name', 45);
            $table->string('link_http', 90);
            $table->foreignId('admin_idadmin')->constrained('admins', 'idadmin');
            $table->foreignId('languages_idlanguages')->constrained('languages', 'idlanguages');
            $table->foreignId('media_idmedia')->constrained('media', 'idmedia');
            $table->foreignId('socials_idsocials')->constrained('socials', 'idsocials');
            $table->timestamps();
        });
    } 
 
    public function down(): void {
        Schema::dropIfExists('links');
    }
};
