<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove a coluna unit se existir
            if (Schema::hasColumn('users', 'unit')) {
                $table->dropColumn('unit');
            }
        });

        Schema::table('users', function (Blueprint $table) {
            // Adiciona a coluna unit como string normal
            $table->string('unit')->nullable()->after('email');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('unit');
        });
    }
};