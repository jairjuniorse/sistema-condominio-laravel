const express = require('express');
const cors = require('cors');
require('dotenv').config();

// Importar rotas
const authRoutes = require('./routes/authRoutes');
const unidadesRoutes = require('./routes/unidadesRoutes');

// Importar database e models
const sequelize = require('./config/database');
require('./models/Unidade');

const app = express();
const PORT = process.env.PORT || 8000;

// Middlewares
app.use(cors());
app.use(express.json());

// Log de requisições
app.use((req, res, next) => {
  console.log(`${new Date().toISOString()} - ${req.method} ${req.path}`);
  next();
});

// Rotas
app.use('/auth', authRoutes);
app.use('/unidades', unidadesRoutes);

// Rota de saúde/status
app.get('/health', (req, res) => {
  res.json({ 
    status: 'OK', 
    message: 'Servidor do condomínio rodando',
    timestamp: new Date().toISOString()
  });
});

// Rota padrão
app.get('/', (req, res) => {
  res.json({ 
    message: 'Bem-vindo ao Sistema de Condomínio',
    version: '1.0.0',
    endpoints: {
      auth: '/auth',
      unidades: '/unidades',
      health: '/health'
    }
  });
});

// Middleware de erro 404 (CORRIGIDO)
app.use((req, res) => {
  res.status(404).json({
    success: false,
    message: 'Rota não encontrada'
  });
});

// Middleware de tratamento de erros
app.use((error, req, res, next) => {
  console.error('Erro não tratado:', error);
  res.status(500).json({
    success: false,
    message: 'Erro interno do servidor'
  });
});

// Iniciar servidor
async function startServer() {
  try {
    // Sincronizar banco de dados
    await sequelize.sync({ force: false });
    console.log('✅ Banco de dados sincronizado');
    
    app.listen(PORT, () => {
      console.log(`🚀 Servidor rodando na porta ${PORT}`);
      console.log(`📊 Health check: http://localhost:${PORT}/health`);
      console.log(`🔐 Sistema de autenticação: http://localhost:${PORT}/auth`);
      console.log(`🏢 Gestão de unidades: http://localhost:${PORT}/unidades`);
    });
  } catch (error) {
    console.error('❌ Erro ao iniciar servidor:', error);
    process.exit(1);
  }
}

startServer();