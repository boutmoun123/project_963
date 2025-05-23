<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->dropColumn('link_type');
        });

        Schema::table('links', function (Blueprint $table) {
            $table->tinyInteger('link_type')->after('link_http')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('links', function (Blueprint $table) {
            $table->dropColumn('link_type');
        });

        Schema::table('links', function (Blueprint $table) {
            $table->tinyInteger('link_type')->after('link_http');
        });
    }
};
