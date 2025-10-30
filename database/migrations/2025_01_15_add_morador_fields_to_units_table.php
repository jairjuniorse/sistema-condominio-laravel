// database/migrations/2025_01_15_add_morador_fields_to_units_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('units', function (Blueprint $table) {
            // Dados do Proprietário/Morador
            $table->string('proprietario')->nullable()->after('number');
            $table->string('cpf')->unique()->nullable()->after('proprietario');
            $table->string('rg')->nullable()->after('cpf');
            
            // Contato
            $table->string('email')->unique()->nullable()->after('rg');
            $table->string('telefone')->nullable()->after('email');
            $table->string('whatsapp')->nullable()->after('telefone');
            
            // Informações Adicionais do Morador
            $table->enum('tipo_morador', ['Proprietário', 'Locatário', 'Usufrutuário', 'Outro'])->nullable()->after('whatsapp');
            $table->date('data_entrada')->nullable()->after('tipo_morador');
            $table->text('observacoes')->nullable()->after('data_entrada');
            
            // Login do Morador
            $table->string('senha')->nullable()->after('observacoes');
            
            // Atualizar o status para incluir mais opções
            $table->enum('status', ['vago', 'ocupado', 'reformando', 'inativo'])->default('vago')->change();
        });
    }

    public function down()
    {
        Schema::table('units', function (Blueprint $table) {
            $table->dropColumn([
                'proprietario', 'cpf', 'rg', 'email', 'telefone', 
                'whatsapp', 'tipo_morador', 'data_entrada', 
                'observacoes', 'senha'
            ]);
        });
    }
};