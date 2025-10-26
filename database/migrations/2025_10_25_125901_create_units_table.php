<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // A001, A002, etc.
            $table->string('block'); // A, B, C, D, E
            $table->string('number'); // 001, 002, etc.
            $table->string('type')->default('Apartamento');
            $table->integer('rooms')->default(2);
            $table->decimal('area', 8, 2)->nullable();
            $table->enum('status', ['vago', 'ocupado', 'reformando'])->default('vago');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('units');
    }
};