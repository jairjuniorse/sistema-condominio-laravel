<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

// Rotas Públicas - Autenticação
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Recuperação de senha
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Rotas Protegidas - Requer autenticação
Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Dashboard principal
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
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
        // Rotas específicas do Admin
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
        // Rotas específicas do Síndico
        Route::get('/units', function () {
            return view('syndicate.units');
        })->name('syndicate.units');
        
        Route::get('/reports', function () {
            return view('syndicate.reports');
        })->name('syndicate.reports');
    });
    
    Route::prefix('doorman')->middleware(['doorman'])->group(function () {
        // Rotas específicas do Porteiro
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
        // Rotas específicas do Proprietário
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
    return redirect()->route('login');
});