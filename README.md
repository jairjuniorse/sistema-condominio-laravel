# 🏢 Sistema de Gestão de Unidades

Sistema web moderno para gerenciamento completo de unidades habitacionais. Desenvolvido com tecnologias web modernas e interface intuitiva.

![Status](https://img.shields.io/badge/Status-Desenvolvimento-orange)
![License](https://img.shields.io/badge/License-MIT-blue)

## ✨ Funcionalidades Principais

- 📋 **Listagem Completa** - Visualização em tabela organizada de todas as unidades
- 👁️ **Visualização de Detalhes** - Acesso rápido aos dados completos de cada unidade
- ✏️ **Edição em Tempo Real** - Interface para atualização de informações
- 🗑️ **Exclusão Segura** - Controle para remover unidades do sistema
- 📊 **Status Dinâmico** - Controle visual de unidades ativas e inativas
- 📱 **Design Responsivo** - Interface adaptável para desktop e mobile

## 🛠️ Stack Tecnológica

### Frontend
- **HTML5** - Estrutura semântica
- **CSS3** - Estilização moderna com Flexbox/Grid
- **JavaScript ES6+** - Interatividade e lógica de interface
- **Font Awesome** - Ícones profissionais

### Backend
- **Node.js** - Ambiente de execução
- **Express.js** - Framework web minimalista
- **JSON** - Armazenamento de dados (para demonstração)

## 🚀 Como Executar o Projeto

### Pré-requisitos
- Node.js 14+ instalado
- NPM ou Yarn

### Passos para Instalação

1. **Clone o repositório**
```bash
git clone https://github.com/seu-usuario/gestao-unidades.git
cd gestao-unidades
Instale as dependências

bash
npm install
Inicie o servidor

bash
npm start
Acesse a aplicação
Abra seu navegador e visite: http://localhost:3000

📁 Estrutura do Projeto
text
gestao-unidades/
├── public/                 # Arquivos estáticos
│   ├── index.html         # Página principal
│   ├── styles/
│   │   └── style.css      # Estilos CSS
│   └── scripts/
│       └── script.js      # Lógica do frontend
├── server.js              # Servidor Express
├── package.json           # Configurações e dependências
├── README.md              # Documentação
└── data/                  # Dados da aplicação
    └── unidades.json      # Base de dados em JSON
🎯 Interface do Usuário
Página Principal
Cabeçalho informativo com contagem de unidades e status

Tabela organizada com todas as unidades

Sistema de cores para status (Ativo/Inativo)

Botões de ação para cada registro

Layout
Design limpo e profissional

Cores corporativas (azul e verde)

Tipografia legível

Espaçamento adequado entre elementos

📊 Estrutura de Dados
Cada unidade possui os seguintes campos:

Campo	Tipo	Descrição
id	Number	Identificador único
unidade	String	Código da unidade (ex: D201)
proprietario	String	Nome do proprietário
email	String	E-mail de contato
telefone	String	Telefone formatado
status	String	Status (Ativo/Inativo)
🔄 Funcionalidades por Módulo
Módulo de Listagem
✅ Lista todas as unidades

✅ Filtro visual por status

✅ Contadores dinâmicos

✅ Ordenação por colunas

Módulo de Visualização
✅ Modal de detalhes

✅ Apresentação organizada dos dados

✅ Botão de fechar intuitivo

Módulo de Edição
✅ Formulário pré-preenchido

✅ Validação básica de campos

✅ Feedback visual de ações

🎨 Características do Design
Paleta de Cores: Azul corporativo (#2563eb) com tons complementares

Tipografia: Sistema sans-serif moderno

Componentes: Cards, tabelas responsivas, botões com hover effects

Ícones: Font Awesome para ações e status

📈 Status do Projeto
✅ Implementado
Estrutura HTML completa

Estilização CSS moderna

Lógica JavaScript frontend

Servidor Express básico

Interface responsiva

Navegação entre modais

🔄 Próximas Etapas
Integração com banco de dados real

Sistema de autenticação

Validações avançadas

Testes automatizados

Deploy em produção

🤝 Contribuição
Este projeto está em fase de desenvolvimento. Para contribuir:

Faça um fork do projeto

Crie uma branch para sua feature (git checkout -b feature/AmazingFeature)

Commit suas mudanças (git commit -m 'Add some AmazingFeature')

Push para a branch (git push origin feature/AmazingFeature)

Abra um Pull Request

📄 Licença
Distribuído sob licença MIT. Veja LICENSE para mais informações.

👨‍💻 Desenvolvido por
[Jair Adão da Cunha Júnior] - [jairjuniorse@gmail.com]