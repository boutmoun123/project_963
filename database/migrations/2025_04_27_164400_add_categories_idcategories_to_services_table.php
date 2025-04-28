<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('categories_idcategories')->nullable()->after('cities_idcities')->constrained('categories', 'idcategories');
        });
    }

    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropForeign(['categories_idcategories']);
            $table->dropColumn('categories_idcategories');
        });
    }
}; 