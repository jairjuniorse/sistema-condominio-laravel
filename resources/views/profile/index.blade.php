<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Perfil - Sistema Condomínio</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
    <div class="profile-container">
        <div class="header">
            <button onclick="window.location.href='/projeto/public/dashboard'" class="back-btn">
                ← Voltar para Dashboard
            </button>
            <h1>Meu Perfil</h1>
            <button onclick="window.location.href='/projeto/public/perfil/editar'" class="edit-btn">
                Editar Perfil
            </button>
        </div>

        <div class="profile-content">
            <div class="profile-card">
                <div class="profile-header">
                    <div class="avatar" id="userAvatar">D</div>
                    <h2>Dados da Unidade <span id="unitNumberDisplay">D201</span></h2>
                </div>

                <div class="profile-info">
                    <div class="info-group">
                        <label>Unidade:</label>
                        <span id="unitNumber">D201</span>
                    </div>
                    
                    <div class="info-group">
                        <label>Responsável:</label>
                        <span id="responsibleName">Jair Adão da Cunha Junior</span>
                    </div>
                    
                    <div class="info-group">
                        <label>Email:</label>
                        <span id="userEmail">jairjuniorse@gmail.com</span>
                    </div>
                    
                    <div class="info-group">
                        <label>Telefone:</label>
                        <span id="userPhone">(34) 86802-8837</span>
                    </div>
                    
                    <div class="info-group">
                        <label>Tipo:</label>
                        <span id="userType" class="badge owner">Proprietário</span>
                    </div>
                    
                    <div class="info-group">
                        <label>Status:</label>
                        <span id="unitStatus" class="badge active">Ativo</span>
                    </div>
                    
                    <div class="info-group">
                        <label>Data de Entrada:</label>
                        <span id="entryDate">15/03/2022</span>
                    </div>
                </div>
            </div>

            <div class="additional-cards">
                <div class="info-card">
                    <h3>📊 Dados Financeiros</h3>
                    <div class="info-group">
                        <label>Situação:</label>
                        <span class="badge financial-good">Em dia</span>
                    </div>
                    <div class="info-group">
                        <label>Próximo Vencimento:</label>
                        <span>05/12/2024</span>
                    </div>
                </div>

                <div class="info-card">
                    <h3>👥 Moradores</h3>
                    <div class="residents-list">
                        <div class="resident">
                            <strong id="mainResident">Jair Adão da Cunha Junior</strong> - <span id="mainResidentType">Proprietário</span>
                        </div>
                        <div class="resident">
                            <strong>Maria Silva</strong> - Cônjuge
                        </div>
                        <div class="resident">
                            <strong>Pedro Silva</strong> - Filho
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <h3>🚗 Veículos</h3>
                    <div class="vehicles-list">
                        <div class="vehicle">
                            <strong>ABC-1234</strong> - Honda Civic - Prata
                        </div>
                        <div class="vehicle">
                            <strong>XYZ-5678</strong> - Fiat Uno - Branco
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Carrega dados do usuário do localStorage
        function loadUserData() {
            // Tenta carregar dados salvos
            const savedData = localStorage.getItem('userProfile');
            
            if (savedData) {
                // Usa dados salvos
                const userData = JSON.parse(savedData);
                document.getElementById('unitNumber').textContent = userData.unit;
                document.getElementById('unitNumberDisplay').textContent = userData.unit;
                document.getElementById('responsibleName').textContent = userData.responsible;
                document.getElementById('userEmail').textContent = userData.email;
                document.getElementById('userPhone').textContent = userData.phone;
                document.getElementById('userType').textContent = userData.userType;
                document.getElementById('unitStatus').textContent = userData.status;
                document.getElementById('entryDate').textContent = userData.entryDate;
                
                // Atualiza avatar com primeira letra do nome
                document.getElementById('userAvatar').textContent = userData.responsible.charAt(0);
                
                // Atualiza morador principal
                document.getElementById('mainResident').textContent = userData.responsible;
                document.getElementById('mainResidentType').textContent = userData.userType;
                
                console.log('✅ Dados carregados do localStorage:', userData);
            } else {
                // Dados padrão se não tiver salvos
                const defaultData = {
                    unit: 'D201',
                    responsible: 'Jair Adão da Cunha Junior',
                    email: 'jairjuniorse@gmail.com',
                    phone: '(34) 86802-8837',
                    userType: 'Proprietário',
                    status: 'Ativo',
                    entryDate: '15/03/2022'
                };
                
                document.getElementById('unitNumber').textContent = defaultData.unit;
                document.getElementById('unitNumberDisplay').textContent = defaultData.unit;
                document.getElementById('responsibleName').textContent = defaultData.responsible;
                document.getElementById('userEmail').textContent = defaultData.email;
                document.getElementById('userPhone').textContent = defaultData.phone;
                document.getElementById('userType').textContent = defaultData.userType;
                document.getElementById('unitStatus').textContent = defaultData.status;
                document.getElementById('entryDate').textContent = defaultData.entryDate;
                document.getElementById('userAvatar').textContent = defaultData.responsible.charAt(0);
                document.getElementById('mainResident').textContent = defaultData.responsible;
                document.getElementById('mainResidentType').textContent = defaultData.userType;
                
                console.log('ℹ️ Usando dados padrão');
            }
        }

        // Função para limpar dados (útil para testes)
        function clearProfileData() {
            localStorage.removeItem('userProfile');
            alert('Dados limpos! Recarregando...');
            location.reload();
        }

        // Carrega dados quando a página abre
        loadUserData();
        
        // Debug: mostra dados salvos no console
        console.log('📊 Dados atuais no localStorage:', localStorage.getItem('userProfile'));
        
        // Adiciona botão de limpar dados no console para testes
        console.log('💡 Para limpar dados, digite: clearProfileData()');
    </script>
</body>
</html>