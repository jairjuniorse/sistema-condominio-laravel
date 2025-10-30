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
                    <i class="fas fa-arrow-left"></i> Voltar
                </button>
                <h1><i class="fas fa-list"></i> Gestão de Unidades</h1>
            </div>
            <div class="header-actions">
                <button onclick="window.location.href='/admin/unidades/cadastrar'" class="btn-primary">
                    <i class="fas fa-plus"></i> Nova Unidade
                </button>
            </div>
        </div>

        <!-- Mensagem de Debug -->
        <div style="background: #fff3cd; color: #856404; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #ffeaa7;">
            <strong>Modo Desenvolvimento:</strong> Lista de unidades - Sem verificação de autenticação
        </div>

        <!-- Tabela de Unidades -->
        <div class="table-container">
            <table class="units-table">
                <thead>
                    <tr>
                        <th>Unidade</th>
                        <th>Proprietário</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody id="unitsTableBody">
                    <tr>
                        <td>D201</td>
                        <td>João Silva</td>
                        <td>joao@email.com</td>
                        <td>(11) 9999-9999</td>
                        <td><span class="status-badge ativo">Ativo</span></td>
                        <td class="actions">
                            <button onclick="editarUnidade(1)" class="btn-edit" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="excluirUnidade(1, 'D201')" class="btn-delete" title="Excluir">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>A101</td>
                        <td>Maria Santos</td>
                        <td>maria@email.com</td>
                        <td>(11) 8888-8888</td>
                        <td><span class="status-badge ativo">Ativo</span></td>
                        <td class="actions">
                            <button onclick="editarUnidade(2)" class="btn-edit" title="Editar">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="excluirUnidade(2, 'A101')" class="btn-delete" title="Excluir">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // DEBUG: Mostra sessionStorage atual
        console.log('SessionStorage atual:', {
            loggedIn: sessionStorage.getItem('loggedIn'),
            userType: sessionStorage.getItem('userType'),
            userUnit: sessionStorage.getItem('userUnit')
        });

        function editarUnidade(id) {
            alert(`📝 Editando unidade ID: ${id}\n\nEm desenvolvimento...`);
            // window.location.href = `/admin/unidades/editar/${id}`;
        }

        function excluirUnidade(id, unidade) {
            if (confirm(`❌ Tem certeza que deseja excluir a unidade ${unidade}?`)) {
                alert(`🗑️ Unidade ${unidade} excluída com sucesso! (Simulação)`);
                // Aqui viria a chamada API para exclusão
            }
        }

        console.log('Lista de unidades carregada - modo desenvolvimento');
    </script>
</body>
</html>