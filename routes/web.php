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
// ROTAS PROTEGIDAS - REQUEREM AUTENTICAÇÃO
// =============================================
Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Troca de senha no primeiro acesso
    Route::get('/change-password', [AuthController::class, 'showChangePassword'])->name('change.password');
    Route::post('/change-password', [AuthController::class, 'changePassword'])->name('change.password.post');
    
    // Logs de acesso (apenas Admin pode ver)
    Route::middleware(['admin'])->group(function () {
        Route::get('/access-logs', [AuthController::class, 'accessLogs'])->name('access.logs');
        Route::get('/access-logs/export', [AuthController::class, 'exportLogs'])->name('access.logs.export');
    });
    
    // Futuras rotas para cada tipo de usuário
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::get('/users', function () {
            return view('admin.users');
        })->name('admin.users');
        
        Route::get('/permissions', function () {
            return view('admin.permissions');
        })->name('admin.permissions');
        
        Route::get('/reports', function () {
            return view('admin.reports');
        })->name('admin.reports');
    });
    
    Route::prefix('syndicate')->middleware(['syndicate'])->group(function () {
        Route::get('/units', function () {
            return view('syndicate.units');
        })->name('syndicate.units');
        
        Route::get('/reports', function () {
            return view('syndicate.reports');
        })->name('syndicate.reports');
    });
    
    Route::prefix('doorman')->middleware(['doorman'])->group(function () {
        Route::get('/access-control', function () {
            return view('doorman.access-control');
        })->name('doorman.access-control');
        
        Route::get('/visitors', function () {
            return view('doorman.visitors');
        })->name('doorman.visitors');
        
        Route::get('/check-expirations', function () {
            return view('doorman.expirations');
        })->name('doorman.expirations');
    });
    
    Route::prefix('owner')->middleware(['owner'])->group(function () {
        Route::get('/profile', function () {
            return view('owner.profile');
        })->name('owner.profile');
        
        Route::get('/visitors', function () {
            return view('owner.visitors');
        })->name('owner.visitors');
        
        Route::get('/tenants', function () {
            return view('owner.tenants');
        })->name('owner.tenants');
        
        Route::get('/dependents', function () {
            return view('owner.dependents');
        })->name('owner.dependents');
    });
});

// Rota fallback - para URLs não encontradas
Route::fallback(function () {
    return redirect()->route('login.form');
});