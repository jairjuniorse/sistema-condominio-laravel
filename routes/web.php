<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UnitController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rota para a página de login personalizada
Route::get('/login', function () {
    return view('auth.login');
})->name('login.form');

// Rotas Públicas
Route::get('/', function () {
    return redirect()->route('login.form');
})->name('login');

// =============================================
// ROTAS ABSOLUTAS PARA TESTE (GARANTIDAS)
// =============================================
Route::get('/entrar-como-sindico', function () {
    return "🎉 SÍNDICO - Login funcionou! <br><a href='/login'>Voltar</a>";
});

Route::get('/entrar-como-morador', function () {
    return "🎉 MORADOR - Login funcionou! <br><a href='/login'>Voltar</a>";
});

// =============================================
// ROTAS PÚBLICAS (SEM AUTENTICAÇÃO)
// =============================================

// Dashboard principal (FORA DO MIDDLEWARE)
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Rotas de perfil (FORA DO MIDDLEWARE)
Route::get('/perfil', function () {
    return view('profile.index');
})->name('profile.index');

Route::get('/perfil/editar', function () {
    return view('profile.edit');
})->name('profile.edit');

Route::post('/perfil/atualizar', function () {
    return response()->json([
        'success' => true,
        'message' => 'Dados atualizados com sucesso!'
    ]);
})->name('profile.update');

// Recuperação de senha
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Rotas para unidades
Route::get('/unidades', [UnitController::class, 'index'])->name('units.index');

// =============================================
// ROTAS PARA A ÁREA DO SÍNDICO
// =============================================
Route::prefix('admin')->group(function () {
    // Dashboard do Síndico
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    // Gestão de Unidades - Listagem
    Route::get('/unidades', function () {
        return view('admin.unidades.index');
    })->name('admin.unidades.index');
    
    // Cadastro de Nova Unidade
    Route::get('/unidades/cadastrar', function () {
        return view('admin.unidades.create');
    })->name('admin.unidades.create');
    
    // ROTA ATUALIZADA: Processar cadastro e redirecionar para dashboard
    Route::post('/unidades/store', function () {
        // Aqui você pode adicionar a lógica para salvar no banco de dados
        
        // Redireciona para o dashboard com mensagem de sucesso
        return redirect()->route('admin.dashboard')->with('success', 'Unidade cadastrada com sucesso!');
    })->name('admin.unidades.store');
    
    // Edição de Unidade
    Route::get('/unidades/editar/{id}', function ($id) {
        return view('admin.unidades.edit', ['id' => $id]);
    })->name('admin.unidades.edit');
    
    // Visualização de Unidade
    Route::get('/unidades/visualizar/{id}', function ($id) {
        return view('admin.unidades.show', ['id' => $id]);
    })->name('admin.unidades.show');
});

// =============================================
// API PARA GESTÃO DE UNIDADES (SÍNDICO)
// =============================================
Route::prefix('api')->group(function () {
    // Listar todas as unidades
    Route::get('/unidades', function () {
        return response()->json([
            ['id' => 1, 'unidade' => 'D201', 'proprietario' => 'João Silva', 'email' => 'joao@email.com', 'telefone' => '(11) 9999-9999', 'status' => 'Ativo'],
            ['id' => 2, 'unidade' => 'A101', 'proprietario' => 'Maria Santos', 'email' => 'maria@email.com', 'telefone' => '(11) 8888-8888', 'status' => 'Ativo'],
            ['id' => 3, 'unidade' => 'B205', 'proprietario' => 'Pedro Costa', 'email' => 'pedro@email.com', 'telefone' => '(11) 7777-7777', 'status' => 'Inativo'],
            ['id' => 4, 'unidade' => 'C302', 'proprietario' => 'Ana Oliveira', 'email' => 'ana@email.com', 'telefone' => '(11) 6666-6666', 'status' => 'Ativo'],
        ]);
    });
    
    // Buscar unidade específica
    Route::get('/unidades/{id}', function ($id) {
        $units = [
            1 => ['id' => 1, 'unidade' => 'D201', 'proprietario' => 'João Silva', 'email' => 'joao@email.com', 'telefone' => '(11) 9999-9999', 'status' => 'Ativo', 'tipo' => 'Proprietário', 'data_entrada' => '2023-01-15'],
            2 => ['id' => 2, 'unidade' => 'A101', 'proprietario' => 'Maria Santos', 'email' => 'maria@email.com', 'telefone' => '(11) 8888-8888', 'status' => 'Ativo', 'tipo' => 'Proprietário', 'data_entrada' => '2023-02-20'],
        ];
        
        return response()->json($units[$id] ?? ['error' => 'Unidade não encontrada']);
    });
    
    // Cadastrar nova unidade
    Route::post('/unidades', function () {
        return response()->json([
            'success' => true, 
            'message' => 'Unidade cadastrada com sucesso!',
            'data' => [
                'id' => rand(5, 1000),
                'unidade' => request('unidade'),
                'proprietario' => request('proprietario'),
                'email' => request('email'),
                'telefone' => request('telefone'),
                'status' => 'Ativo'
            ]
        ]);
    });
    
    // Atualizar unidade
    Route::put('/unidades/{id}', function ($id) {
        return response()->json([
            'success' => true, 
            'message' => 'Unidade atualizada com sucesso!',
            'data' => [
                'id' => $id,
                'unidade' => request('unidade'),
                'proprietario' => request('proprietario'),
                'email' => request('email'),
                'telefone' => request('telefone'),
                'status' => request('status')
            ]
        ]);
    });
    
    // Excluir unidade
    Route::delete('/unidades/{id}', function ($id) {
        return response()->json([
            'success' => true, 
            'message' => 'Unidade excluída com sucesso!'
        ]);
    });
});

// =============================================
// ROTAS PROTEGIDAS - REQUEREM AUTENTICAÇÃO (COMENTADAS TEMPORARIAMENTE)
// =============================================
// Route::middleware(['auth'])->group(function () {
    // Logout
    // Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Troca de senha no primeiro acesso
    // Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('change.password');
    // Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change.password.post');
    
    // Logs de acesso (apenas Admin pode ver)
    // Route::middleware(['admin'])->group(function () {
    //     Route::get('/access-logs', [AuthController::class, 'accessLogs'])->name('access.logs');
    //     Route::get('/access-logs/export', [AuthController::class, 'exportLogs'])->name('access.logs.export');
    // });
    
    // Futuras rotas para cada tipo de usuário
    // Route::prefix('admin')->middleware(['admin'])->group(function () {
    //     Route::get('/users', function () {
    //         return view('admin.users');
    //     })->name('admin.users');
        
    //     Route::get('/permissions', function () {
    //         return view('admin.permissions');
    //     })->name('admin.permissions');
        
    //     Route::get('/reports', function () {
    //         return view('admin.reports');
    //     })->name('admin.reports');
    // });
    
    // Route::prefix('syndicate')->middleware(['syndicate'])->group(function () {
    //     Route::get('/units', function () {
    //         return view('syndicate.units');
    //     })->name('syndicate.units');
        
    //     Route::get('/reports', function () {
    //         return view('syndicate.reports');
    //     })->name('syndicate.reports');
    // });
    
    // Route::prefix('doorman')->middleware(['doorman'])->group(function () {
    //     Route::get('/access-control', function () {
    //         return view('doorman.access-control');
    //     })->name('doorman.access-control');
        
    //     Route::get('/visitors', function () {
    //         return view('doorman.visitors');
    //     })->name('doorman.visitors');
        
    //     Route::get('/check-expirations', function () {
    //         return view('doorman.expirations');
    //     })->name('doorman.expirations');
    // });
    
    // Route::prefix('owner')->middleware(['owner'])->group(function () {
    //     Route::get('/profile', function () {
    //         return view('owner.profile');
    //     })->name('owner.profile');
        
    //     Route::get('/visitors', function () {
    //         return view('owner.visitors');
    //     })->name('owner.visitors');
        
    //     Route::get('/tenants', function () {
    //         return view('owner.tenants');
    //     })->name('owner.tenants');
        
    //     Route::get('/dependents', function () {
    //         return view('owner.dependents');
    //     })->name('owner.dependents');
    // });
// });

// =============================================
// ROTAS TEMPORÁRIAS PARA TESTE (SEM MIDDLEWARE)
// =============================================
Route::get('/teste-admin', function () {
    return view('admin.dashboard');
})->name('teste.admin');

Route::get('/teste-morador', function () {
    return view('dashboard');
})->name('teste.morador');

// Rota fallback - para URLs não encontradas
Route::fallback(function () {
    return redirect()->route('login.form');
});