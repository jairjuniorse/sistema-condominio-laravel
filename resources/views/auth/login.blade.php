<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Condomínio</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="login-container">
        <h2>LOGIN SISTEMA CONDOMÍNIO</h2>
        
        <form id="loginForm">
            <label>Unidade (ex: D201):</label>
            <input type="text" id="unidade" name="unidade" required>
            
            <label>Senha:</label>
            <input type="password" id="senha" name="senha" required>
            
            <button type="submit">Entrar</button>
        </form>

        <div id="message" class="message">
            <!-- Mensagens aparecerão aqui -->
        </div>

        <div class="test-info">
            <strong>Credenciais para teste:</strong><br>
            Síndico: SINDICO / admin123<br>
            Morador: D201 / 1234
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const unidade = document.getElementById('unidade').value;
            const senha = document.getElementById('senha').value;
            const messageDiv = document.getElementById('message');
            
            messageDiv.textContent = '';
            messageDiv.className = 'message';
            
            // VALIDAÇÃO LOCAL SIMPLES
            const credentials = {
                'SINDICO': 'admin123',
                'D201': '1234'
            };
            
            // Normaliza para maiúsculas
            const normalizedUnidade = unidade.toUpperCase().trim();
            
            // Verifica credenciais
            if (credentials[normalizedUnidade] === senha) {
                messageDiv.className = 'message success';
                messageDiv.textContent = '✅ Login realizado com sucesso! Redirecionando...';
                
                // NÃO SALVA NADA NO STORAGE - isso causa loop
                // Redireciona diretamente sem verificação
                setTimeout(() => {
                    window.location.href = '/projeto/public/dashboard';
                }, 1500);
                
            } else {
                messageDiv.className = 'message error';
                messageDiv.textContent = '❌ Unidade ou senha incorretos!';
            }
        });

        // REMOVIDA toda verificação de "já está logado"
        // Isso evita o loop de redirecionamento
        
        console.log('Página de login carregada - sem verificações automáticas');
    </script>
</body>
</html>