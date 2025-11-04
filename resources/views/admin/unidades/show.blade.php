<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Unidade - Sistema Condomínio</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <!-- Header -->
        <div class="admin-header">
            <div class="header-left">
                <button onclick="window.location.href='/admin/unidades'" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Voltar
                </button>
                <h1><i class="fas fa-eye"></i> Detalhes da Unidade</h1>
            </div>
            <div class="header-actions">
                <button onclick="window.location.href='/admin/unidades/editar/{{ $id }}'" class="btn-primary">
                    <i class="fas fa-edit"></i> Editar
                </button>
            </div>
        </div>

        <!-- Detalhes da Unidade -->
        <div class="details-container">
            <div class="details-card">
                <div class="details-header">
                    <h3><i class="fas fa-info-circle"></i> Informações da Unidade</h3>
                </div>
                
                <div class="details-content">
                    <div class="details-grid">
                        <div class="detail-item">
                            <label>ID da Unidade:</label>
                            <span id="detail-id">Carregando...</span>
                        </div>
                        
                        <div class="detail-item">
                            <label>Número da Unidade:</label>
                            <span id="detail-unidade">Carregando...</span>
                        </div>
                        
                        <div class="detail-item">
                            <label>Proprietário:</label>
                            <span id="detail-proprietario">Carregando...</span>
                        </div>
                        
                        <div class="detail-item">
                            <label>Email:</label>
                            <span id="detail-email">Carregando...</span>
                        </div>
                        
                        <div class="detail-item">
                            <label>Telefone:</label>
                            <span id="detail-telefone">Carregando...</span>
                        </div>
                        
                        <div class="detail-item">
                            <label>Tipo:</label>
                            <span id="detail-tipo">Carregando...</span>
                        </div>
                        
                        <div class="detail-item">
                            <label>Status:</label>
                            <span id="detail-status">Carregando...</span>
                        </div>
                        
                        <div class="detail-item">
                            <label>Data de Entrada:</label>
                            <span id="detail-data-entrada">Carregando...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const unidadeId = {{ $id }};

        // Carregar dados da unidade
        fetch(`/api/unidades/${unidadeId}`)
            .then(response => response.json())
            .then(unidade => {
                if (!unidade.error) {
                    // Preencher os detalhes
                    document.getElementById('detail-id').textContent = unidade.id || 'N/A';
                    document.getElementById('detail-unidade').textContent = unidade.unidade || 'N/A';
                    document.getElementById('detail-proprietario').textContent = unidade.proprietario || 'N/A';
                    document.getElementById('detail-email').textContent = unidade.email || 'N/A';
                    document.getElementById('detail-telefone').textContent = unidade.telefone || 'N/A';
                    document.getElementById('detail-tipo').textContent = unidade.tipo || 'N/A';
                    document.getElementById('detail-data-entrada').textContent = unidade.data_entrada || 'N/A';
                    
                    // Status com badge colorido
                    const statusElement = document.getElementById('detail-status');
                    statusElement.textContent = unidade.status || 'N/A';
                    statusElement.className = `status-badge ${(unidade.status || '').toLowerCase()}`;
                    
                } else {
                    alert('Erro ao carregar unidade: ' + unidade.error);
                    window.location.href = '/admin/unidades';
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao carregar dados da unidade');
            });

        console.log('Página de detalhes carregada para unidade ID:', unidadeId);
    </script>
</body>
</html>