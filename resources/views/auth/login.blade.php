<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistema Condomínio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: bold;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            width: 100%;
            padding: 0.75rem;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
        }
        button:hover {
            background-color: #0056b3;
        }
        .test-info {
            margin-top: 1rem;
            padding: 1rem;
            background-color: #f8f9fa;
            border-radius: 4px;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>LOGIN SISTEMA CONDOMÍNIO</h2>
        
        <!-- MUDANÇA AQUI: método GET temporário para testar -->
        <form method="GET" action="/dashboard">
            <!-- REMOVIDO: @csrf (não precisa para GET) -->
            
            <label>Unidade (ex: D201):</label>
            <input type="text" name="unidade" required>
            
            <label>Senha:</label>
            <input type="password" name="password" required>
            
            <button type="submit">Entrar</button>
        </form>

        <div class="test-info">
            <strong>Teste:</strong><br>
            Unidade: D201<br>
            Senha: 1234
        </div>
    </div>
</body>
</html>