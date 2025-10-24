<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Sistema Condomínio</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .container { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); width: 300px; }
        input { width: 100%; padding: 10px; margin: 5px 0; border: 1px solid #ddd; border-radius: 4px; }
        button { width: 100%; padding: 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h2>📝 Registro - Sistema Condomínio</h2>
        
        @if(session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="/register">
            @csrf
            <input type="text" name="name" placeholder="Nome completo" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="text" name="unit" placeholder="Unidade (ex: D201)" required>
            <input type="password" name="password" placeholder="Senha" required>
            <input type="password" name="password_confirmation" placeholder="Confirmar senha" required>
            <button type="submit">Registrar</button>
        </form>
        
        <p style="text-align: center; margin-top: 15px;">
            <a href="/login" style="color: #007bff;">← Voltar para login</a>
        </p>
    </div>
</body>
</html>