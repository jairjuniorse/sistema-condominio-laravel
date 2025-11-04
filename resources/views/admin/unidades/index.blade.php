<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestão de Unidades - Sistema Condomínio</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <!-- Header -->
        <div class="admin-header">
            <div class="header-left">
                <button onclick="window.location.href='/admin/dashboard'" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Voltar ao Dashboard
                </button>
                <h1><i class="fas fa-building"></i> Gestão de Unidades</h1>
                <span class="user-info">CRUD Completo - Lista de todas as unidades</span>
            </div>
            <div class="header-actions">
                <button onclick="window.location.href='/admin/unidades/cadastrar'" class="btn-primary">
                    <i class="fas fa-plus"></i> Nova Unidade
                </button>
            </div>
        </div>

        <!-- Mensagem de Status -->
        <div class="dev-message">
            <i class="fas fa-database"></i>
            Sistema conectado à API - Dados em tempo real
        </div>

        <!-- Tabela de Unidades -->
        <div class="table-container">
            <div class="table-header">
                <div class="table-stats">
                    <span id="tableStats">Carregando unidades...</span>
                </div>
                <div class="table-actions">
                    <button onclick="loadUnits()" class="btn-outline">
                        <i class="fas fa-sync-alt"></i> Atualizar
                    </button>
                </div>
            </div>

            <table class="units-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Unidade</th>
                        <th>Proprietário</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Status</th>
                        <th width="200">Ações</th>
                    </tr>
                </thead>
                <tbody id="unitsTableBody">
                    <tr>
                        <td colspan="7" class="loading-row">
                            <i class="fas fa-spinner fa-spin"></i> Carregando unidades...
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Mensagem de sucesso -->
        <div id="successMessage" class="success-message" style="display: none;">
            <i class="fas fa-check-circle"></i>
            <span id="successText">Operação realizada com sucesso!</span>
        </div>
    </div>

    <script>
        // Carregar unidades ao iniciar
        document.addEventListener('DOMContentLoaded', function() {
            loadUnits();
        });

        // Carregar unidades da API
        function loadUnits() {
            const tbody = document.getElementById('unitsTableBody');
            tbody.innerHTML = `
                <tr>
                    <td colspan="7" class="loading-row">
                        <i class="fas fa-spinner fa-spin"></i> Carregando unidades...
                    </td>
                </tr>
            `;

            fetch('/api/unidades')
                .then(response => response.json())
                .then(unidades => {
                    tbody.innerHTML = '';
                    
                    if (unidades.length === 0) {
                        tbody.innerHTML = `
                            <tr>
                                <td colspan="7" class="no-data">
                                    <i class="fas fa-inbox"></i>
                                    Nenhuma unidade cadastrada
                                    <br>
                                    <button onclick="window.location.href='/admin/unidades/cadastrar'" class="btn-primary" style="margin-top: 10px;">
                                        <i class="fas fa-plus"></i> Cadastrar Primeira Unidade
                                    </button>
                                </td>
                            </tr>
                        `;
                        return;
                    }

                    unidades.forEach((unidade, index) => {
                        const statusClass = unidade.status === 'Ativo' ? 'status-badge ativo' : 'status-badge inativo';
                        const statusIcon = unidade.status === 'Ativo' ? 'fa-check-circle' : 'fa-times-circle';
                        
                        const row = `
                            <tr>
                                <td>${unidade.id}</td>
                                <td><strong>${unidade.unidade}</strong></td>
                                <td>${unidade.proprietario}</td>
                                <td>${unidade.email}</td>
                                <td>${unidade.telefone}</td>
                                <td>
                                    <span class="${statusClass}">
                                        <i class="fas ${statusIcon}"></i> ${unidade.status}
                                    </span>
                                </td>
                                <td class="actions">
                                    <button onclick="viewUnit(${unidade.id})" class="btn-view" title="Visualizar detalhes">
                                        <i class="fas fa-eye"></i> Ver
                                    </button>
                                    <button onclick="editUnit(${unidade.id})" class="btn-edit" title="Editar unidade">
                                        <i class="fas fa-edit"></i> Editar
                                    </button>
                                    <button onclick="deleteUnit(${unidade.id}, '${unidade.unidade}')" class="btn-delete" title="Excluir unidade">
                                        <i class="fas fa-trash"></i> Excluir
                                    </button>
                                </td>
                            </tr>
                        `;
                        tbody.innerHTML += row;
                    });

                    // Atualizar estatísticas
                    document.getElementById('tableStats').textContent = 
                        `${unidades.length} unidades encontradas • ${unidades.filter(u => u.status === 'Ativo').length} ativas`;
                })
                .catch(error => {
                    console.error('Erro ao carregar unidades:', error);
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="7" class="error-row">
                                <i class="fas fa-exclamation-triangle"></i>
                                Erro ao carregar unidades. Tente novamente.
                                <br>
                                <button onclick="loadUnits()" class="btn-outline" style="margin-top: 10px;">
                                    <i class="fas fa-sync-alt"></i> Tentar Novamente
                                </button>
                            </td>
                        </tr>
                    `;
                });
        }

        // Funções de Ação do CRUD
        function viewUnit(id) {
            window.location.href = `/admin/unidades/visualizar/${id}`;
        }

        function editUnit(id) {
            window.location.href = `/admin/unidades/editar/${id}`;
        }

        function deleteUnit(id, unidadeNumero) {
            if (confirm(`❌ Tem certeza que deseja excluir a unidade ${unidadeNumero}?\n\nEsta ação não pode ser desfeita.`)) {
                fetch(`/api/unidades/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        showSuccess(`Unidade ${unidadeNumero} excluída com sucesso!`);
                        loadUnits(); // Recarregar a lista
                    } else {
                        alert('Erro ao excluir unidade: ' + (data.message || 'Erro desconhecido'));
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Erro ao excluir unidade. Tente novamente.');
                });
            }
        }

        function showSuccess(message) {
            const successElement = document.getElementById('successMessage');
            document.getElementById('successText').textContent = message;
            successElement.style.display = 'flex';
            
            setTimeout(() => {
                successElement.style.display = 'none';
            }, 5000);
        }

        console.log('Página de gestão de unidades carregada - CRUD Completo');
    </script>

    <style>
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 0;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 25px;
            border-bottom: 1px solid #eee;
            background: #f8f9fa;
        }

        .table-stats {
            color: #666;
            font-weight: 600;
        }

        .units-table {
            width: 100%;
            border-collapse: collapse;
        }

        .units-table th {
            background: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            border-bottom: 2px solid #dee2e6;
        }

        .units-table td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            vertical-align: middle;
        }

        .units-table tr:hover {
            background: #f8f9fa;
        }

        .loading-row, .no-data, .error-row {
            text-align: center;
            padding: 40px;
            color: #666;
        }

        .loading-row i, .no-data i, .error-row i {
            font-size: 24px;
            margin-bottom: 10px;
            display: block;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .status-badge.ativo {
            background: #d4edda;
            color: #155724;
        }

        .status-badge.inativo {
            background: #f8d7da;
            color: #721c24;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-view, .btn-edit, .btn-delete {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }

        .btn-view {
            background: #17a2b8;
            color: white;
        }

        .btn-view:hover {
            background: #138496;
            transform: translateY(-1px);
        }

        .btn-edit {
            background: #ffc107;
            color: #212529;
        }

        .btn-edit:hover {
            background: #e0a800;
            transform: translateY(-1px);
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background: #c82333;
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .actions {
                flex-direction: column;
            }
            
            .btn-view, .btn-edit, .btn-delete {
                width: 100%;
                justify-content: center;
            }
            
            .table-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }
    </style>
</body>
</html>