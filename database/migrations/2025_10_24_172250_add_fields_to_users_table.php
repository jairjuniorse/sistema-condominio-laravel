<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Dados pessoais
            $table->string('cpf')->unique()->nullable();
            $table->string('rg')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            
            // Dados do condomínio
            $table->string('block')->nullable(); // Bloco (A, B, C, D)
            $table->string('apartment')->nullable(); // Número do apto (101, 201)
            
            // Controle de permissões (Admin pode alterar via painel)
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_syndicate')->default(false);
            $table->boolean('is_doorman')->default(false);
            $table->enum('user_type', [
                'admin', 
                'syndicate', 
                'doorman', 
                'owner'
            ])->default('owner');
            
            // Código do funcionário (para porteiros - P001, P002, etc.)
            $table->string('employee_code')->nullable()->unique();
            
            // Controle de acesso e segurança
            $table->date('expiration_date')->nullable(); // Para cadastros temporários feitos por proprietários
            $table->boolean('first_login')->default(true); // Forçar troca de senha no primeiro acesso
            $table->boolean('active')->default(true); // Usuário ativo/inativo
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'cpf', 'rg', 'address', 'phone', 'whatsapp',
                'block', 'apartment', 
                'is_admin', 'is_syndicate', 'is_doorman', 'user_type',
                'employee_code', 'expiration_date', 'first_login', 'active'
            ]);
        });
    }
};