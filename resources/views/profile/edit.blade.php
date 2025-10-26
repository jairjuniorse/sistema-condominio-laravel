<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil - Sistema Condomínio</title>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
    <div class="profile-container">
        <div class="header">
            <button onclick="window.location.href='/projeto/public/perfil'" class="back-btn">
                ← Cancelar
            </button>
            <h1>Editar Perfil</h1>
            <button onclick="saveProfile()" class="save-btn">
                Salvar Alterações
            </button>
        </div>

        <div class="profile-content">
            <form id="profileForm" class="edit-form">
                <div class="form-section">
                    <h3>👤 Dados Pessoais</h3>
                    
                    <div class="form-group">
                        <label for="responsible">Nome do Responsável:</label>
                        <input type="text" id="responsible" name="responsible" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Telefone:</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                </div>

                <div class="form-section">
                    <h3>🏠 Dados da Unidade</h3>
                    
                    <div class="form-group">
                        <label for="unit">Unidade:</label>
                        <input type="text" id="unit" name="unit" value="D201" disabled>
                        <small class="help-text">A unidade não pode ser alterada</small>
                    </div>
                    
                    <div class="form-group">
                        <label for="userType">Tipo de Morador:</label>
                        <select id="userType" name="userType" required>
                            <option value="Proprietário">Proprietário</option>
                            <option value="Locatário">Locatário</option>
                            <option value="Cônjuge">Cônjuge</option>
                            <option value="Dependente">Dependente</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Salvar perfil - Agora salva no localStorage
        function saveProfile() {
            // Pega os valores do formulário
            const userData = {
                responsible: document.getElementById('responsible').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                userType: document.getElementById('userType').value,
                unit: 'D201', // Fixo, não pode mudar
                status: 'Ativo',
                entryDate: '15/03/2022'
            };
            
            // Validação básica
            if (!userData.responsible || !userData.email || !userData.phone) {
                alert('❌ Por favor, preencha todos os campos obrigatórios!');
                return;
            }
            
            // SALVA no localStorage
            localStorage.setItem('userProfile', JSON.stringify(userData));
            
            alert('✅ Perfil atualizado com sucesso!\n\nOs dados foram salvos.');
            
            // Redireciona para a página de visualização
            setTimeout(() => {
                window.location.href = '/projeto/public/perfil';
            }, 1000);
        }

        // Carrega dados salvos ao abrir a página
        function loadSavedData() {
            const savedData = localStorage.getItem('userProfile');
            if (savedData) {
                const userData = JSON.parse(savedData);
                document.getElementById('responsible').value = userData.responsible;
                document.getElementById('email').value = userData.email;
                document.getElementById('phone').value = userData.phone;
                document.getElementById('userType').value = userData.userType;
            } else {
                // Dados padrão se não tiver salvos
                document.getElementById('responsible').value = 'Jair Adão da Cunha Junior';
                document.getElementById('email').value = 'jairjuniorse@gmail.com';
                document.getElementById('phone').value = '(34) 86802-8837';
                document.getElementById('userType').value = 'Proprietário';
            }
        }

        // Carrega dados quando a página abre
        loadSavedData();
        
        console.log('Página de edição carregada - localStorage ativo');
    </script>
</body>
</html>