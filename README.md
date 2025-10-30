# Sistema de Gestão de Condomínio

## 📋 Sobre o Projeto
Sistema de gestão condominial desenvolvido em Laravel com áreas diferenciadas para síndicos, moradores e administradores.

## 🚀 Funcionalidades Implementadas

### ✅ Correções Realizadas
- **Correção da Rota `admin.unidades.store`**: Resolvido o erro `RouteNotFoundException` no cadastro de unidades
- **Redirecionamento Pós-Cadastro**: Após cadastrar uma unidade, o sistema redireciona automaticamente para o dashboard
- **Sistema de Mensagens Flash**: Mensagens de sucesso são exibidas após operações bem-sucedidas

### 🔧 Rotas Principais
- **Dashboard Síndico**: `/admin/dashboard`
- **Gestão de Unidades**: `/admin/unidades`
- **Cadastro de Unidades**: `/admin/unidades/cadastrar`
- **Processamento de Cadastro**: `/admin/unidades/store` (POST)

### 🛠 Tecnologias
- Laravel 10.x
- PHP 8.1+
- MySQL
- Bootstrap 5
- JavaScript

## 📦 Instalação

```bash
# Clone o repositório
git clone [url-do-repositorio]

# Instale as dependências
composer install

# Configure o ambiente
cp .env.example .env
php artisan key:generate

# Configure o banco de dados no .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nome_do_banco
DB_USERNAME=usuario
DB_PASSWORD=senha

# Execute as migrações
php artisan migrate

# Inicie o servidor
php artisan serve

### Passo a Passo

1. **Clone o repositório**
   ```bash
   git clone https://github.com/jairjuniorse/sistema-condominio-laravel.git
   cd sistema-condominio-laravel