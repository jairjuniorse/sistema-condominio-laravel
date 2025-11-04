<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Síndico - Sistema Condomínio</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <!-- Header -->
        <div class="admin-header">
            <div class="header-left">
                <h1><i class="fas fa-user-shield"></i> Dashboard do Síndico</h1>
                <span class="user-info">Bem-vindo, Síndico</span>
            </div>
            <div class="header-actions">
                <!-- BOTÃO ADICIONADO: Cadastrar Novo Morador -->
                <button onclick="window.location.href='/admin/unidades/cadastrar'" class="btn-primary">
                    <i class="fas fa-user-plus"></i> Cadastrar Novo Morador
                </button>
                <button onclick="window.location.href='/dashboard'" class="btn-outline">
                    <i class="fas fa-eye"></i> Ver como Morador
                </button>
                <button onclick="logout()" class="btn-secondary">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </button>
            </div>
        </div>

        <!-- Cards de Estatísticas -->
        <div class="stats-grid">
            <div class="stat-card total-units">
                <div class="stat-icon">
                    <i class="fas fa-building"></i>
                </div>
                <div class="stat-info">
                    <h3>Total de Unidades</h3>
                    <span class="stat-number" id="totalUnits">--</span>
                    <span class="stat-change" id="totalChange">Carregando...</span>
                </div>
            </div>

            <div class="stat-card active-units">
                <div class="stat-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="stat-info">
                    <h3>Unidades Ativas</h3>
                    <span class="stat-number" id="activeUnits">--</span>
                    <span class="stat-change" id="activeChange">Carregando...</span>
                </div>
            </div>

            <div class="stat-card pending-issues">
                <div class="stat-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stat-info">
                    <h3>Ocorrências Pendentes</h3>
                    <span class="stat-number" id="pendingIssues">8</span>
                    <span class="stat-change">-3 esta semana</span>
                </div>
            </div>

            <div class="stat-card financial-status">
                <div class="stat-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                    <h3>Situação Financeira</h3>
                    <span class="stat-number" id="financialStatus">98%</span>
                    <span class="stat-change">Inadimplência: 2%</span>
                </div>
            </div>
        </div>

        <!-- Ações Rápidas -->
        <div class="quick-actions-section">
            <h2><i class="fas fa-bolt"></i> Gestão de Unidades - CRUD Completo</h2>
            <div class="actions-grid">
                <!-- LISTAR UNIDADES -->
                <div class="action-card" onclick="window.location.href='/admin/unidades'">
                    <div class="action-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <h4>Listar Unidades</h4>
                    <p>Visualize e gerencie todas as unidades do condomínio</p>
                    <span class="action-badge" id="unitsCountBadge">-- unidades</span>
                </div>

                <!-- CADASTRAR UNIDADE -->
                <div class="action-card highlight" onclick="window.location.href='/admin/unidades/cadastrar'">
                    <div class="action-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h4>Cadastrar Nova Unidade</h4>
                    <p>Adicione um novo morador e unidade ao sistema</p>
                    <span class="action-badge highlight">CREATE</span>
                </div>

                <!-- EDITAR UNIDADE -->
                <div class="action-card" onclick="window.location.href='/admin/unidades'">
                    <div class="action-icon">
                        <i class="fas fa-edit"></i>
                    </div>
                    <h4>Editar Unidades</h4>
                    <p>Atualize informações das unidades existentes</p>
                    <span class="action-badge">UPDATE</span>
                </div>

                <!-- VISUALIZAR DETALHES -->
                <div class="action-card" onclick="window.location.href='/admin/unidades'">
                    <div class="action-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h4>Visualizar Detalhes</h4>
                    <p>Veja informações completas de cada unidade</p>
                    <span class="action-badge">READ</span>
                </div>

                <!-- EXCLUIR UNIDADE -->
                <div class="action-card" onclick="window.location.href='/admin/unidades'">
                    <div class="action-icon">
                        <i class="fas fa-trash"></i>
                    </div>
                    <h4>Excluir Unidades</h4>
                    <p>Remova unidades do sistema quando necessário</p>
                    <span class="action-badge">DELETE</span>
                </div>

                <!-- RELATÓRIOS -->
                <div class="action-card" onclick="showComingSoon('Relatórios')">
                    <div class="action-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h4>Relatórios</h4>
                    <p>Gerar relatórios financeiros e de gestão</p>
                    <span class="action-badge">Em breve</span>
                </div>
            </div>
        </div>

        <!-- Últimas Unidades Cadastradas -->
        <div class="recent-activities">
            <div class="activities-header">
                <h2><i class="fas fa-clock"></i> Últimas Unidades Cadastradas</h2>
                <button class="btn-outline" onclick="loadUnits()">
                    <i class="fas fa-sync-alt"></i> Atualizar
                </button>
            </div>
            <div class="activities-list" id="recentUnitsList">
                <div class="activity-item">
                    <div class="activity-icon info">
                        <i class="fas fa-sync fa-spin"></i>
                    </div>
                    <div class="activity-content">
                        <p><strong>Carregando unidades...</strong></p>
                        <span class="activity-time">Aguarde</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- CRUD Status -->
        <div class="quick-actions-section">
            <h2><i class="fas fa-check-circle"></i> Status do CRUD - Gestão de Unidades</h2>
            <div class="crud-status">
                <div class="status-item completed">
                    <i class="fas fa-check-circle"></i>
                    <span>CREATE - Cadastrar Unidades</span>
                </div>
                <div class="status-item completed">
                    <i class="fas fa-check-circle"></i>
                    <span>READ - Listar Unidades</span>
                </div>
                <div class="status-item completed">
                    <i class="fas fa-check-circle"></i>
                    <span>UPDATE - Editar Unidades</span>
                </div>
                <div class="status-item completed">
                    <i class="fas fa-check-circle"></i>
                    <span>DELETE - Excluir Unidades</span>
                </div>
                <div class="status-item completed">
                    <i class="fas fa-check-circle"></i>
                    <span>VIEW - Visualizar Detalhes</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Carrega estatísticas ao iniciar
        document.addEventListener('DOMContentLoaded', function() {
            loadStatistics();
            loadUnits();
            console.log('Dashboard admin carregado - CRUD Completo');
        });

        // Carrega estatísticas da API
        function loadStatistics() {
            fetch('/api/unidades')
                .then(response => response.json())
                .then(unidades => {
                    const totalUnidades = unidades.length;
                    const unidadesAtivas = unidades.filter(u => u.status === 'Ativo').length;
                    const percentualAtivas = totalUnidades > 0 ? Math.round((unidadesAtivas / totalUnidades) * 100) : 0;
                    
                    // Atualiza estatísticas
                    document.getElementById('totalUnits').textContent = totalUnidades;
                    document.getElementById('activeUnits').textContent = unidadesAtivas;
                    document.getElementById('totalChange').textContent = `${totalUnidades} no total`;
                    document.getElementById('activeChange').textContent = `${percentualAtivas}% ativas`;
                    document.getElementById('unitsCountBadge').textContent = `${totalUnidades} unidades`;
                })
                .catch(error => {
                    console.error('Erro ao carregar estatísticas:', error);
                    document.getElementById('totalUnits').textContent = '4';
                    document.getElementById('activeUnits').textContent = '3';
                    document.getElementById('unitsCountBadge').textContent = '4 unidades';
                });
        }

        // Carrega unidades recentes
        function loadUnits() {
            fetch('/api/unidades')
                .then(response => response.json())
                .then(unidades => {
                    const recentContainer = document.getElementById('recentUnitsList');
                    const unidadesRecentes = unidades.slice(0, 5); // Últimas 5 unidades
                    
                    if (unidadesRecentes.length > 0) {
                        recentContainer.innerHTML = '';
                        unidadesRecentes.forEach(unidade => {
                            const statusClass = unidade.status === 'Ativo' ? 'success' : 'warning';
                            const statusIcon = unidade.status === 'Ativo' ? 'fa-check-circle' : 'fa-exclamation-circle';
                            
                            const item = `
                                <div class="activity-item" onclick="viewUnitDetails(${unidade.id})" style="cursor: pointer;">
                                    <div class="activity-icon ${statusClass}">
                                        <i class="fas ${statusIcon}"></i>
                                    </div>
                                    <div class="activity-content">
                                        <p><strong>${unidade.unidade}</strong> - ${unidade.proprietario}</p>
                                        <span class="activity-time">${unidade.email} • ${unidade.status}</span>
                                    </div>
                                    <div class="activity-actions">
                                        <button onclick="event.stopPropagation(); editUnit(${unidade.id})" class="btn-edit-small" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="event.stopPropagation(); viewUnit(${unidade.id})" class="btn-view-small" title="Ver detalhes">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                </div>
                            `;
                            recentContainer.innerHTML += item;
                        });
                    } else {
                        recentContainer.innerHTML = `
                            <div class="activity-item">
                                <div class="activity-icon info">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div class="activity-content">
                                    <p><strong>Nenhuma unidade cadastrada</strong></p>
                                    <span class="activity-time">Clique em "Cadastrar Nova Unidade" para começar</span>
                                </div>
                            </div>
                        `;
                    }
                })
                .catch(error => {
                    console.error('Erro ao carregar unidades:', error);
                    document.getElementById('recentUnitsList').innerHTML = `
                        <div class="activity-item">
                            <div class="activity-icon danger">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="activity-content">
                                <p><strong>Erro ao carregar unidades</strong></p>
                                <span class="activity-time">Tente novamente mais tarde</span>
                            </div>
                        </div>
                    `;
                });
        }

        // Funções de navegação para o CRUD
        function viewUnitDetails(id) {
            window.location.href = `/admin/unidades/visualizar/${id}`;
        }

        function editUnit(id) {
            window.location.href = `/admin/unidades/editar/${id}`;
        }

        function viewUnit(id) {
            window.location.href = `/admin/unidades/visualizar/${id}`;
        }

        // Mostra mensagem para funcionalidades em desenvolvimento
        function showComingSoon(feature) {
            alert(`🎯 ${feature} - Em desenvolvimento!\n\nEsta funcionalidade estará disponível em breve.`);
        }

        // Função de logout
        function logout() {
            sessionStorage.removeItem('loggedIn');
            sessionStorage.removeItem('userType');
            sessionStorage.removeItem('userUnit');
            window.location.href = '/login';
        }

        // Verificação de autenticação para admin
        if (sessionStorage.getItem('loggedIn') !== 'true' || sessionStorage.getItem('userType') !== 'admin') {
            console.warn('Acesso não autorizado! Redirecionando para login...');
            window.location.href = '/login';
        }
    </script>

    <style>
        /* Estilos adicionais para o CRUD */
        .crud-status {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 20px;
        }

        .status-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #27ae60;
        }

        .status-item.completed {
            border-left-color: #27ae60;
        }

        .status-item.completed i {
            color: #27ae60;
        }

        .status-item span {
            font-weight: 600;
            color: #2c3e50;
        }

        .activity-actions {
            display: flex;
            gap: 8px;
        }

        .btn-edit-small, .btn-view-small {
            background: none;
            border: none;
            padding: 8px;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-edit-small {
            color: #f39c12;
        }

        .btn-edit-small:hover {
            background: #f39c12;
            color: white;
        }

        .btn-view-small {
            color: #3498db;
        }

        .btn-view-small:hover {
            background: #3498db;
            color: white;
        }

        .activity-item {
            transition: all 0.3s ease;
        }

        .activity-item:hover {
            background: #e3f2fd !important;
            transform: translateX(5px);
        }
    </style>
</body>
</html>