<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema Condomínio</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f4f4f4; }
        .header { background: #007bff; color: white; padding: 20px; }
        .container { max-width: 1200px; margin: 20px auto; padding: 20px; background: white; border-radius: 8px; }
        .menu { display: flex; gap: 10px; margin: 20px 0; }
        .menu a { padding: 10px 15px; background: #28a745; color: white; text-decoration: none; border-radius: 4px; }
        .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin: 20px 0; }
        .card { background: #f8f9fa; padding: 20px; border-radius: 8px; border-left: 4px solid #007bff; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏠 Sistema de Gestão Condominial</h1>
        <p>Dashboard Principal</p>
    </div>

    <div class="container">
        @if(session('success'))
            <div class="success">
                ✅ {{ session('success') }}
            </div>
        @endif

        <div class="menu">
            <a href="/dashboard">Home</a>
            <a href="/profile">Perfil</a>
            <a href="/change-password">Trocar Senha</a>
            <form action="/logout" method="POST" style="display: inline;">
                @csrf
                <button type="submit" style="background: #dc3545; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer;">Sair</button>
            </form>
        </div>

        <h2>Bem-vindo, {{ Auth::user()->name ?? 'Morador' }}!</h2>
        
        <div class="cards">
            <div class="card">
                <h3>👥 Unidades</h3>
                <p>Gerenciar moradores e unidades</p>
                <small>Status: Ativo</small>
            </div>
            <div class="card">
                <h3>📋 Ocorrências</h3>
                <p>Registrar e acompanhar problemas</p>
                <small>0 pendências</small>
            </div>
            <div class="card">
                <h3>💰 Financeiro</h3>
                <p>Controle de taxas condominiais</p>
                <small>Em dia</small>
            </div>
            <div class="card">
                <h3>🚗 Veículos</h3>
                <p>Cadastro de veículos</p>
                <small>2 cadastrados</small>
            </div>
        </div>

        <div style="margin-top: 30px; padding: 15px; background: #e9ecef; border-radius: 4px;">
            <h4>📊 Informações do Sistema</h4>
            <p><strong>Usuário:</strong> {{ Auth::user()->email ?? 'admin@condominio.com' }}</p>
            <p><strong>Data/Hora:</strong> {{ date('d/m/Y H:i:s') }}</p>
            <p><strong>Status:</strong> <span style="color: green;">● Online</span></p>
        </div>
    </div>
</body>
</html>