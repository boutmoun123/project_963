<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_name')->nullable();   
            $table->string('platform')->nullable();       
            $table->string('device_token')->nullable();   
            $table->ipAddress('ip_address')->nullable();   
            $table->string('app_version')->nullable();    
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('devices');
    }
};
