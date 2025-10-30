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
                    <span class="stat-number" id="totalUnits">120</span>
                    <span class="stat-change">+2 este mês</span>
                </div>
            </div>

            <div class="stat-card active-units">
                <div class="stat-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="stat-info">
                    <h3>Unidades Ativas</h3>
                    <span class="stat-number" id="activeUnits">115</span>
                    <span class="stat-change">96% ocupação</span>
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

        <!-- Ações Rápidas (versão sem duplicação) -->
        <div class="quick-actions-section">
            <h2><i class="fas fa-bolt"></i> Ações Rápidas</h2>
            <div class="actions-grid">
                <div class="action-card" onclick="window.location.href='/admin/unidades'">
                    <div class="action-icon">
                        <i class="fas fa-list"></i>
                    </div>
                    <h4>Gestão de Unidades</h4>
                    <p>Visualize e gerencie todas as unidades do condomínio</p>
                    <span class="action-badge">120 unidades</span>
                </div>

                <!-- BOTÃO PRINCIPAL: Cadastrar Novo Morador -->
                <div class="action-card highlight" onclick="window.location.href='/admin/unidades/cadastrar'">
                    <div class="action-icon">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h4>Cadastrar Novo Morador</h4>
                    <p>Adicione um novo morador e unidade ao sistema</p>
                    <span class="action-badge highlight">Importante</span>
                </div>

                <div class="action-card" onclick="showComingSoon('Relatórios')">
                    <div class="action-icon">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <h4>Relatórios</h4>
                    <p>Gerar relatórios financeiros e de gestão</p>
                    <span class="action-badge">Em breve</span>
                </div>

                <div class="action-card" onclick="showComingSoon('Comunicações')">
                    <div class="action-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h4>Comunicações</h4>
                    <p>Envie avisos e comunicados aos moradores</p>
                    <span class="action-badge">Em breve</span>
                </div>

                <div class="action-card" onclick="showComingSoon('Financeiro')">
                    <div class="action-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <h4>Gestão Financeira</h4>
                    <p>Controle de taxas condominiais e inadimplência</p>
                    <span class="action-badge">Em breve</span>
                </div>

                <div class="action-card" onclick="showComingSoon('Ocorrências')">
                    <div class="action-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h4>Ocorrências</h4>
                    <p>Registro e acompanhamento de problemas</p>
                    <span class="action-badge">Em breve</span>
                </div>
            </div>
        </div>

        <!-- Últimas Atividades -->
        <div class="recent-activities">
            <div class="activities-header">
                <h2><i class="fas fa-history"></i> Últimas Atividades</h2>
                <button class="btn-outline" onclick="loadActivities()">
                    <i class="fas fa-sync-alt"></i> Atualizar
                </button>
            </div>
            <div class="activities-list" id="activitiesList">
                <div class="activity-item">
                    <div class="activity-icon success">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="activity-content">
                        <p><strong>Nova unidade cadastrada</strong> - A305</p>
                        <span class="activity-time">Há 2 horas</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon warning">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="activity-content">
                        <p><strong>Ocorrência registrada</strong> - Vazamento no hall</p>
                        <span class="activity-time">Há 5 horas</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon info">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="activity-content">
                        <p><strong>Dados atualizados</strong> - Unidade B102</p>
                        <span class="activity-time">Hoje às 09:30</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon success">
                        <i class="fas fa-money-bill"></i>
                    </div>
                    <div class="activity-content">
                        <p><strong>Pagamento confirmado</strong> - Unidade D201</p>
                        <span class="activity-time">Ontem às 16:45</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Carrega estatísticas ao iniciar
        document.addEventListener('DOMContentLoaded', function() {
            loadStatistics();
            console.log('Dashboard admin carregado - SessionStorage:', {
                loggedIn: sessionStorage.getItem('loggedIn'),
                userType: sessionStorage.getItem('userType'),
                userUnit: sessionStorage.getItem('userUnit')
            });
        });

        // Carrega estatísticas (simulado)
        function loadStatistics() {
            // Em uma implementação real, buscaria da API
            console.log('Carregando estatísticas...');
            
            // Simula carregamento
            setTimeout(() => {
                document.getElementById('totalUnits').textContent = '120';
                document.getElementById('activeUnits').textContent = '115';
                document.getElementById('pendingIssues').textContent = '8';
                document.getElementById('financialStatus').textContent = '98%';
            }, 500);
        }

        // Atualiza atividades
        function loadActivities() {
            const activitiesList = document.getElementById('activitiesList');
            activitiesList.innerHTML = `
                <div class="activity-item">
                    <div class="activity-icon success">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <div class="activity-content">
                        <p><strong>Atividades atualizadas</strong></p>
                        <span class="activity-time">Agora</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon info">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="activity-content">
                        <p><strong>Nova unidade cadastrada</strong> - A305</p>
                        <span class="activity-time">Há 2 horas</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon warning">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="activity-content">
                        <p><strong>Ocorrência registrada</strong> - Vazamento no hall</p>
                        <span class="activity-time">Há 5 horas</span>
                    </div>
                </div>
                <div class="activity-item">
                    <div class="activity-icon info">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div class="activity-content">
                        <p><strong>Dados atualizados</strong> - Unidade B102</p>
                        <span class="activity-time">Hoje às 09:30</span>
                    </div>
                </div>
            `;
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

        // Atualiza data e hora em tempo real
        function updateDateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            };
            // Se tiver um elemento para data/hora, atualiza
            const dateTimeElement = document.getElementById('currentDateTime');
            if (dateTimeElement) {
                dateTimeElement.textContent = now.toLocaleDateString('pt-BR', options);
            }
        }

        // Atualiza a cada minuto
        setInterval(updateDateTime, 60000);
        updateDateTime(); // Executa imediatamente
    </script>

    <script>
        // Verificação de autenticação para admin
        if (sessionStorage.getItem('loggedIn') !== 'true' || sessionStorage.getItem('userType') !== 'admin') {
            console.warn('Acesso não autorizado! Redirecionando para login...');
            window.location.href = '/login';
        }
    
        console.log('Dashboard síndico carregado com sucesso!');
    </script>
</body>
</html>