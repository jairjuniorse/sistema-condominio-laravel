<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unidades - Sistema Condomínio</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background: #f4f4f4; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; }
        .units-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin: 20px 0; }
        .unit-card { border: 1px solid #ddd; padding: 15px; border-radius: 8px; }
        .unit-vago { background: #f8f9fa; }
        .unit-ocupado { background: #d4edda; }
        .unit-reformando { background: #fff3cd; }
        .unit-code { font-weight: bold; font-size: 1.2em; }
        .header { background: #007bff; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏢 Unidades do Condomínio</h1>
            <p>Total de {{ $units->count() }} unidades cadastradas</p>
        </div>

        <div style="margin-bottom: 20px;">
            <a href="/dashboard" style="background: #6c757d; color: white; padding: 10px 15px; text-decoration: none; border-radius: 4px;">← Voltar ao Dashboard</a>
        </div>
        
        <div class="units-grid">
            @foreach($units as $unit)
            <div class="unit-card unit-{{ $unit->status }}">
                <div class="unit-code">{{ $unit->code }}</div>
                <div>Bloco: {{ $unit->block }}</div>
                <div>Quartos: {{ $unit->rooms }}</div>
                <div>Área: {{ $unit->area }}m²</div>
                <div>Status: 
                    <span style="color: 
                        {{ $unit->status == 'vago' ? '#6c757d' : 
                           ($unit->status == 'ocupado' ? '#28a745' : '#ffc107') }}; font-weight: bold;">
                        {{ ucfirst($unit->status) }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
        
        <div style="margin-top: 20px; padding: 15px; background: #e9ecef; border-radius: 4px;">
            <strong>Resumo:</strong> 
            {{ $units->where('status', 'vago')->count() }} vagos | 
            {{ $units->where('status', 'ocupado')->count() }} ocupados | 
            {{ $units->where('status', 'reformando')->count() }} em reforma
        </div>
    </div>
</body>
</html>