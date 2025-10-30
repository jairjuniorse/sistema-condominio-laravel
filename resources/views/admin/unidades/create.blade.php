<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Unidade - Sistema Condomínio</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <!-- Header -->
        <div class="admin-header">
            <div class="header-left">
                <button onclick="window.location.href='/admin/dashboard'" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Voltar para Dashboard
                </button>
                <h1><i class="fas fa-user-plus"></i> Cadastrar Nova Unidade</h1>
            </div>
            <div class="header-actions">
                <button onclick="window.location.href='/admin/unidades'" class="btn-outline">
                    <i class="fas fa-list"></i> Ver Unidades
                </button>
            </div>
        </div>

        <!-- Formulário de Cadastro -->
        <div class="form-container">
            <form id="cadastroForm" class="cadastro-form" method="POST" action="{{ route('admin.unidades.store') }}">
                @csrf
                
                <!-- Dados da Unidade -->
                <div class="form-section">
                    <h3><i class="fas fa-building"></i> Dados da Unidade</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="bloco">Bloco *</label>
                            <select id="bloco" name="bloco" required>
                                <option value="">Selecione o bloco...</option>
                                <option value="A">Bloco A</option>
                                <option value="B">Bloco B</option>
                                <option value="C">Bloco C</option>
                                <option value="D">Bloco D</option>
                                <option value="E">Bloco E</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="unidade">Número da Unidade *</label>
                            <input type="text" id="unidade" name="unidade" required 
                                   placeholder="Ex: 101, 205, 302" pattern="[0-9]{3}" 
                                   title="Apenas números (ex: 101, 205)">
                            <small class="help-text">Apenas números (ex: 101, 205, 302)</small>
                        </div>
                    </div>
                </div>

                <!-- Dados do Proprietário -->
                <div class="form-section">
                    <h3><i class="fas fa-user"></i> Dados do Proprietário</h3>
                    
                    <div class="form-group">
                        <label for="proprietario">Nome Completo *</label>
                        <input type="text" id="proprietario" name="proprietario" required 
                               placeholder="Nome completo do proprietário">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="cpf">CPF *</label>
                            <input type="text" id="cpf" name="cpf" required 
                                   placeholder="000.000.000-00" maxlength="14">
                        </div>
                        
                        <div class="form-group">
                            <label for="rg">RG</label>
                            <input type="text" id="rg" name="rg" 
                                   placeholder="Número do RG">
                        </div>
                    </div>
                </div>

                <!-- Contato -->
                <div class="form-section">
                    <h3><i class="fas fa-address-card"></i> Informações de Contato</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" required 
                                   placeholder="email@exemplo.com">
                        </div>
                        
                        <div class="form-group">
                            <label for="telefone">Telefone *</label>
                            <input type="tel" id="telefone" name="telefone" required 
                                   placeholder="(11) 99999-9999" maxlength="15">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="whatsapp">WhatsApp</label>
                        <input type="tel" id="whatsapp" name="whatsapp" 
                               placeholder="(11) 99999-9999" maxlength="15">
                        <small class="help-text">Caso seja diferente do telefone principal</small>
                    </div>
                </div>

                <!-- Informações Adicionais -->
                <div class="form-section">
                    <h3><i class="fas fa-home"></i> Informações Adicionais</h3>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="tipo_morador">Tipo de Morador *</label>
                            <select id="tipo_morador" name="tipo_morador" required>
                                <option value="">Selecione o tipo...</option>
                                <option value="Proprietário">Proprietário</option>
                                <option value="Locatário">Locatário</option>
                                <option value="Usufrutuário">Usufrutuário</option>
                                <option value="Outro">Outro</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="data_entrada">Data de Entrada *</label>
                            <input type="date" id="data_entrada" name="data_entrada" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="observacoes">Observações</label>
                        <textarea id="observacoes" name="observacoes" rows="4" 
                                  placeholder="Observações adicionais sobre o morador ou unidade..."></textarea>
                    </div>
                </div>

                <!-- Ações do Formulário -->
                <div class="form-actions">
                    <button type="button" onclick="window.location.href='/admin/dashboard'" class="btn-cancel">
                        <i class="fas fa-times"></i> Cancelar
                    </button>
                    <button type="submit" class="btn-primary">
                        <i class="fas fa-save"></i> Cadastrar Unidade
                    </button>
                </div>
            </form>
        </div>

        <!-- Mensagem de sucesso -->
        @if(session('success'))
        <div class="success-message" style="display: flex;">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        @endif
    </div>

    <script>
        // Verificação de autenticação - DEVE SER O PRIMEIRO SCRIPT
        if (sessionStorage.getItem('loggedIn') !== 'true' || sessionStorage.getItem('userType') !== 'admin') {
            console.warn('Acesso não autorizado! Redirecionando para login...');
            window.location.href = '/login';
        }

        // Máscaras para os campos
        function aplicarMascaraCPF(input) {
            let value = input.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2')
                           .replace(/(\d{3})(\d)/, '$1.$2')
                           .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
            }
            input.value = value;
        }

        function aplicarMascaraTelefone(input) {
            let value = input.value.replace(/\D/g, '');
            if (value.length === 11) {
                value = value.replace(/(\d{2})(\d)/, '($1) $2')
                           .replace(/(\d{5})(\d)/, '$1-$2');
            } else if (value.length === 10) {
                value = value.replace(/(\d{2})(\d)/, '($1) $2')
                           .replace(/(\d{4})(\d)/, '$1-$2');
            }
            input.value = value;
        }

        // Aplicar máscaras
        document.getElementById('cpf').addEventListener('input', function(e) {
            aplicarMascaraCPF(e.target);
        });

        document.getElementById('telefone').addEventListener('input', function(e) {
            aplicarMascaraTelefone(e.target);
        });

        document.getElementById('whatsapp').addEventListener('input', function(e) {
            aplicarMascaraTelefone(e.target);
        });

        // Validação do formulário
        document.getElementById('cadastroForm').addEventListener('submit', function(e) {
            const bloco = document.getElementById('bloco').value;
            const unidade = document.getElementById('unidade').value;
            const cpf = document.getElementById('cpf').value;
            
            if (!bloco) {
                e.preventDefault();
                alert('Por favor, selecione o bloco.');
                return;
            }
            
            if (!unidade || !/^\d{3}$/.test(unidade)) {
                e.preventDefault();
                alert('Por favor, informe um número de unidade válido (3 dígitos).');
                return;
            }
            
            if (cpf.replace(/\D/g, '').length !== 11) {
                e.preventDefault();
                alert('Por favor, informe um CPF válido (11 dígitos).');
                return;
            }
            
            // Mostrar loading
            const btnSubmit = document.querySelector('button[type="submit"]');
            btnSubmit.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Cadastrando...';
            btnSubmit.disabled = true;
        });

        // Preencher data atual como padrão
        document.addEventListener('DOMContentLoaded', function() {
            const hoje = new Date().toISOString().split('T')[0];
            document.getElementById('data_entrada').value = hoje;
        });

        // Efeitos visuais nos campos
        document.querySelectorAll('.form-group input, .form-group select, .form-group textarea').forEach(element => {
            element.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-2px)';
            });
            
            element.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });

        console.log('Página de cadastro carregada com sucesso!');
    </script>
</body>
</html>