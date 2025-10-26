<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema Condomínio</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
            <h1>Sistema de Gestão Condominial</h1>
            <div>
                <button onclick="window.location.href='/projeto/public/perfil'" style="background: #3498db; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer; margin-right: 10px;">
                    Meu Perfil
                </button>
                <button onclick="logout()" style="background: #e74c3c; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">
                    Sair
                </button>
            </div>
        </div>

        <div class="welcome-section">
            <h2>Bem-vindo!</h2>
            <p><strong>Unidade:</strong> D201</p>
            <p><strong>Tipo:</strong> Morador</p>
        </div>

        <div class="unit-info">
            <h3>Minha Unidade</h3>
            <p><strong>Unidade D201</strong></p>
            <p>Status: <span class="status-active">Ativo</span></p>
        </div>

        <div class="occurrences">
            <h3>Ocorrências</h3>
            <p>Registrar e acompanhar problemas</p>
            <p>0 pendências</p>
        </div>

        <div class="financial">
            <h3>Financeiro</h3>
            <p>Controle de taxas condominiais</p>
            <p class="financial-good">Em dia</p>
        </div>
    </div>

    <script>
        function logout() {
            // Limpa TUDO
            localStorage.clear();
            sessionStorage.clear();
            window.location.href = '/projeto/public/login';
        }

        console.log('✅ Dashboard carregado com sucesso!');
        // SEM verificação de autenticação - isso causa o loop
    </script>
</body>
</html>