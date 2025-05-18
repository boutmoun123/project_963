<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Remove from way table
        Schema::table('way', function (Blueprint $table) {
            if (Schema::hasColumn('way', 'admin_idadmin')) {
                $table->dropForeign(['admin_idadmin']);
                $table->dropColumn('admin_idadmin');
            }
        });

        // Remove from media table
        Schema::table('media', function (Blueprint $table) {
            if (Schema::hasColumn('media', 'admin_idadmin')) {
                $table->dropForeign(['admin_idadmin']);
                $table->dropColumn('admin_idadmin');
            }
        });

        // Remove from links table
        Schema::table('links', function (Blueprint $table) {
            if (Schema::hasColumn('links', 'admin_idadmin')) {
                $table->dropForeign(['admin_idadmin']);
                $table->dropColumn('admin_idadmin');
            }
        });

        // Remove from services table
        Schema::table('services', function (Blueprint $table) {
            if (Schema::hasColumn('services', 'admin_idadmin')) {
                $table->dropForeign(['admin_idadmin']);
                $table->dropColumn('admin_idadmin');
            }
        });
    }

    public function down()
    {
        // Re-add to way table
        Schema::table('way', function (Blueprint $table) {
            $table->foreignId('admin_idadmin')->constrained('admins', 'idadmin');
        });

        // Re-add to media table
        Schema::table('media', function (Blueprint $table) {
            $table->foreignId('admin_idadmin')->constrained('admins', 'idadmin');
        });

        // Re-add to links table
        Schema::table('links', function (Blueprint $table) {
            $table->foreignId('admin_idadmin')->constrained('admins', 'idadmin');
        });

        // Re-add to services table
        Schema::table('services', function (Blueprint $table) {
            $table->foreignId('admin_idadmin')->constrained('admins', 'idadmin');
        });
    }
}; 