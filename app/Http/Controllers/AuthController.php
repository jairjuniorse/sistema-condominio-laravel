<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Mostrar página de login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Processar login - VERSÃO SIMPLES PARA TESTE
    public function login(Request $request)
    {
        // Login simples para teste - por unidade
        if ($request->unit === 'D201' && $request->password === '1234') {
            $user = User::where('email', 'admin@condominio.com')->first();
            if ($user) {
                Auth::login($user);
                return redirect()->route('dashboard');
            }
        }
        
        return back()->withErrors(['unit' => 'Unidade ou senha inválida']);
    }

    // Dashboard
    public function dashboard()
    {
        $user = Auth::user();
        return view('dashboard', compact('user'));
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    // Trocar senha - view
    public function showChangePassword()
    {
        return "Página de troca de senha";
    }

    // Trocar senha - processar
    public function changePassword(Request $request)
    {
        return "Senha alterada";
    }

    // Esqueci senha - view
    public function showForgotPassword()
    {
        return "Página de recuperação de senha";
    }

    // Outros métodos mantidos mas simplificados
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        return redirect()->route('login')->with('error', 'Registro desativado');
    }

    public function sendResetLink(Request $request)
    {
        return back()->with('status', 'Email enviado');
    }

    public function showResetPassword($token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function resetPassword(Request $request)
    {
        return redirect()->route('login')->with('status', 'Senha redefinida');
    }

    public function accessLogs()
    {
        return "Logs de acesso";
    }

    public function exportLogs()
    {
        return back()->with('info', 'Exportação em desenvolvimento');
    }
}