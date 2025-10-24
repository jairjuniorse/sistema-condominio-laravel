<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Criar usuário Admin principal
        User::create([
            'name' => 'Administrador do Sistema',
            'email' => 'admin@condominio.com',
            'password' => Hash::make('1234'), // Senha padrão
            'cpf' => '000.000.000-00',
            'phone' => '(11) 99999-9999',
            'whatsapp' => '(11) 99999-9999',
            'block' => 'D',
            'apartment' => '201',
            'is_admin' => true,
            'user_type' => 'admin',
            'first_login' => true, // Forçar troca de senha no primeiro acesso
            'active' => true,
        ]);

        $this->command->info('✅ Usuário Admin D201 criado com sucesso!');
        $this->command->info('📧 Email: admin@condominio.com');
        $this->command->info('🔑 Senha: 1234');
    }
}