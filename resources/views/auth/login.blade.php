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
        // LIMPA TUDO ao carregar a página - PARA O LOOP
        sessionStorage.clear();
        localStorage.clear();
        console.log('🔄 Storage limpo - página recarregada');

        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const unidade = document.getElementById('unidade').value;
            const senha = document.getElementById('senha').value;
            const messageDiv = document.getElementById('message');
            
            messageDiv.textContent = '';
            messageDiv.className = 'message';
            
            // VALIDAÇÃO DIRETA - SEM STORAGE
            if ((unidade.toUpperCase() === 'D201' && senha === '1234') || 
                (unidade.toUpperCase() === 'SINDICO' && senha === 'admin123')) {
                
                messageDiv.className = 'message success';
                messageDiv.textContent = '✅ Login OK! Redirecionando...';
                
                // REDIRECIONAMENTO DIRETO - PARA ROTAS NORMAIS
                setTimeout(() => {
                    // Salva APENAS o necessário
                    sessionStorage.setItem('loggedIn', 'true');
                    sessionStorage.setItem('userType', unidade.toUpperCase() === 'SINDICO' ? 'admin' : 'morador');
                    sessionStorage.setItem('userUnit', unidade.toUpperCase());
                    
                    console.log('Redirecionando para:', unidade.toUpperCase());
                    
                    if (unidade.toUpperCase() === 'SINDICO') {
                        // Síndico vai para dashboard admin NORMAL
                        window.location.href = '/admin/dashboard';
                    } else {
                        // Morador vai para dashboard NORMAL
                        window.location.href = '/dashboard';
                    }
                }, 1000);
                
            } else {
                messageDiv.className = 'message error';
                messageDiv.textContent = '❌ Credenciais inválidas!';
            }
        });

        // NENHUMA verificação automática - evita loops
        console.log('✅ Login carregado - sem verificações automáticas');
    </script>
</body>
</html>