<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Unidade - Sistema Condomínio</title>
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
                <h1><i class="fas fa-edit"></i> Editar Unidade</h1>
            </div>
        </div>

        <!-- Formulário de Edição -->
        <div class="form-container">
            <form id="editarForm" class="cadastro-form">
                @csrf
                @method('PUT')
                
                <!-- Dados da Unidade -->
                <div class="form-section">
                    <h3><i class="fas fa-building"></i> Dados da Unidade</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="unidade">Número da Unidade *</label>
                            <input type="text" id="unidade" name="unidade" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="proprietario">Proprietário *</label>
                            <input type="text" id="proprietario" name="proprietario" required>
                        </div>
                    </div>
                </div>

                <!-- Contato -->
                <div class="form-section">
                    <h3><i class="fas fa-address-book"></i> Contato</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="telefone">Telefone *</label>
                            <input type="text" id="telefone" name="telefone" required>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="form-section">
                    <h3><i class="fas fa-cog"></i> Configurações</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="tipo">Tipo</label>
                            <select id="tipo" name="tipo">
                                <option value="Proprietário">Proprietário</option>
                                <option value="Inquilino">Inquilino</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status">
                                <option value="Ativo">Ativo</option>
                                <option value="Inativo">Inativo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Botões -->
                <div class="form-actions">
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i> Atualizar Unidade
                    </button>
                    <button type="button" onclick="window.location.href='/admin/unidades'" class="btn-secondary">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const unidadeId = {{ $id }};

        // Carregar dados da unidade
        fetch(`/api/unidades/${unidadeId}`)
            .then(response => response.json())
            .then(unidade => {
                if (!unidade.error) {
                    document.getElementById('unidade').value = unidade.unidade || '';
                    document.getElementById('proprietario').value = unidade.proprietario || '';
                    document.getElementById('email').value = unidade.email || '';
                    document.getElementById('telefone').value = unidade.telefone || '';
                    document.getElementById('tipo').value = unidade.tipo || 'Proprietário';
                    document.getElementById('status').value = unidade.status || 'Ativo';
                } else {
                    alert('Erro ao carregar unidade: ' + unidade.error);
                    window.location.href = '/admin/unidades';
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('Erro ao carregar dados da unidade');
            });

        // Enviar formulário de edição
        document.getElementById('editarForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                unidade: document.getElementById('unidade').value,
                proprietario: document.getElementById('proprietario').value,
                email: document.getElementById('email').value,
                telefone: document.getElementById('telefone').value,
                tipo: document.getElementById('tipo').value,
                status: document.getElementById('status').value
            };

            fetch(`/api/unidades/${unidadeId}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('✅ ' + data.message);
                    window.location.href = '/admin/unidades';
                } else {
                    alert('❌ Erro ao atualizar unidade');
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                alert('❌ Erro ao atualizar unidade');
            });
        });

        console.log('Página de edição carregada para unidade ID:', unidadeId);
    </script>
</body>
</html>