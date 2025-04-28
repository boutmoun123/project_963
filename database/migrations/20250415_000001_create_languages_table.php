You said:
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('languages', function (Blueprint $table) {
            $table->id('idlanguages');
            $table->string('language_package')->nullable();
            $table->foreignId('admin_idadmin')->constrained('admins', 'idadmin');
            $table->string('lang_name', 45);
            $table->tinyInteger('lang_type');
            $table->timestamps();
        });
    } 
 
    public function down(): void {
        Schema::dropIfExists('languages');
    }
};