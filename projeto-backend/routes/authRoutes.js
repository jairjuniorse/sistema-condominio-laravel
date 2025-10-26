const express = require('express');
const jwt = require('jsonwebtoken');
const Unidade = require('../models/Unidade');
const { JWT_SECRET } = require('../middleware/authMiddleware');

const router = express.Router();

// Rota de login
router.post('/login', async (req, res) => {
  try {
    const { unidade, senha } = req.body;

    console.log('Tentativa de login:', { unidade, senha });

    // Validar entrada
    if (!unidade || !senha) {
      return res.status(400).json({ 
        success: false, 
        message: 'Unidade e senha são obrigatórios' 
      });
    }

    // Buscar unidade no banco de dados
    const unidadeData = await Unidade.findOne({ 
      where: { numero: unidade.toUpperCase().trim() } 
    });

    console.log('Unidade encontrada:', unidadeData ? 'Sim' : 'Não');

    if (!unidadeData) {
      return res.status(401).json({ 
        success: false, 
        message: 'Unidade ou senha inválidos' 
      });
    }

    // Verificar senha
    const isSenhaValida = await unidadeData.validarSenha(senha);
    console.log('Senha válida:', isSenhaValida);
    
    if (!isSenhaValida) {
      return res.status(401).json({ 
        success: false, 
        message: 'Unidade ou senha inválidos' 
      });
    }

    // Gerar token JWT
    const token = jwt.sign(
      { 
        id: unidadeData.id,
        unidade: unidadeData.numero,
        isAdmin: unidadeData.isAdmin
      },
      JWT_SECRET,
      { expiresIn: '24h' }
    );

    res.json({
      success: true,
      message: 'Login realizado com sucesso',
      token,
      unidade: {
        id: unidadeData.id,
        numero: unidadeData.numero,
        isAdmin: unidadeData.isAdmin,
        proprietario: unidadeData.proprietario
      }
    });

  } catch (error) {
    console.error('Erro no login:', error);
    res.status(500).json({ 
      success: false, 
      message: 'Erro interno do servidor' 
    });
  }
});

// Rota para verificar token
router.get('/verify', async (req, res) => {
  try {
    const token = req.header('Authorization')?.replace('Bearer ', '');
    
    if (!token) {
      return res.json({ valid: false });
    }

    const decoded = jwt.verify(token, JWT_SECRET);
    
    // Verificar se a unidade ainda existe
    const unidade = await Unidade.findByPk(decoded.id, {
      attributes: { exclude: ['senha'] }
    });
    
    if (!unidade) {
      return res.json({ valid: false });
    }

    res.json({ 
      valid: true, 
      unidade: {
        id: unidade.id,
        numero: unidade.numero,
        isAdmin: unidade.isAdmin,
        proprietario: unidade.proprietario
      }
    });
  } catch (error) {
    res.json({ valid: false });
  }
});

module.exports = router;